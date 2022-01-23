<?php

namespace MusicStore\Infrastructure\Adapters\Doctrine\EventListener;

use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;
use Doctrine\ORM\Event\PreFlushEventArgs;
use Doctrine\ORM\Events;
use MusicStore\Domain\Album\Album;
use MusicStore\Domain\Band\Band;
use MusicStore\Domain\Track\Track;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\RouterInterface;

class DomainEntityUpdate implements EventSubscriberInterface
{
    private RouterInterface $router;
    private Request $request;
    private ResponseHeaderBag $responseHeaderBag;

    public function __construct(
        RequestStack    $requestStack,
        ResponseHeaderBag $responseHeaderBag,
        RouterInterface $router
    )
    {
        $this->router = $router;
        $this->request = $requestStack->getCurrentRequest() ?? Request::createFromGlobals();
        $this->responseHeaderBag = $responseHeaderBag;
    }

    public function getSubscribedEvents()
    {
        return [
            Events::postFlush
        ];
    }

    public function postFlush(PostFlushEventArgs $args): void
    {
        if (!in_array($this->request->getMethod(), ['POST', 'PUT', 'PATCH'])) {
            return;
        }

        $location = $this->request->headers->get('Location');

        $routeParams = [
            Band::class => ['route' => 'api_band_show', 'id' => 'bandId'],
            Album::class => ['route' => 'api_album_show', 'id' => 'albumId'],
            Track::class => ['route' => 'api_track_show', 'id' => 'trackId'],
        ];

        foreach ([Album::class, Band::class, Track::class] as $class) {
            foreach ($args->getEntityManager()->getUnitOfWork()->getIdentityMap()[$class] ?? [] as $idKey => $entity) {
                $location = (!empty($location) ? $location . ', ' : '') . $this->router->generate($routeParams[$class]['route'], [
                        $routeParams[$class]['id'] => $entity->getId()
                    ]);
            }
        }

        $this->responseHeaderBag->set('Location', $location);
    }
}