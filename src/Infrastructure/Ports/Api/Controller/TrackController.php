<?php

namespace MusicStore\Infrastructure\Ports\Api\Controller;

use MusicStore\Application\Command\CommandBusInterface;
use MusicStore\Application\Command\Track\AddTrack;
use MusicStore\Domain\Track\TrackRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/api/track")
 */
class TrackController extends AbstractController
{
    private ResponseHeaderBag $responseHeaderBag;

    public function __construct(ResponseHeaderBag $responseHeaderBag)
    {
        $this->responseHeaderBag = $responseHeaderBag;
    }

    /**
     * @Route(path="/{trackId}", name="api_track_show", methods={"GET"})
     */
    public function show(Request $request, TrackRepositoryInterface $trackRepository)
    {
        $track = $trackRepository->get((int) $request->get('trackId'));
        return JsonResponse::create($track);
    }

    /**
     * @Route(path="", methods={"PUT"})
     */
    public function update(Request $request)
    {
        return JsonResponse::create([], Response::HTTP_NOT_IMPLEMENTED);
    }

    /**
     * @Route(path="", methods={"DELETE"})
     */
    public function remove(Request $request)
    {
        return JsonResponse::create([]);
    }

    /**
     * @Route(path="", methods={"GET"})
     */
    public function listAll(Request $request)
    {
        return JsonResponse::create([], Response::HTTP_NOT_IMPLEMENTED);
    }

    /**
     * @Route(path="", name="api_track_create", methods={"POST"})
     */
    public function create(Request $request, CommandBusInterface $commandBus)
    {
        $content = json_decode($request->getContent(), true);
        $commandBus->dispatch(new AddTrack(
            $content['title'],
            $content['url'],
            (int) $content['albumId'],
        ));

        return JsonResponse::create([],
            Response::HTTP_CREATED,
            $this->responseHeaderBag->all()
        );
    }
}