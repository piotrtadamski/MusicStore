<?php

namespace MusicStore\Infrastructure\Ports\Api\Controller;

use MusicStore\Application\Command\CommandBusInterface;
use MusicStore\Application\Command\Track\AddTrack;
use MusicStore\Application\Command\Track\DeleteTrack;
use MusicStore\Application\Command\Track\EditTrack;
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
     * @Route(path="/{trackId}", name="api_track_update", methods={"PUT"})
     */
    public function update(Request $request, CommandBusInterface $commandBus)
    {
        $content = json_decode($request->getContent(), true);
        $commandBus->dispatch(new EditTrack(
            (int) $request->get('trackId'),
            (int) $content['albumId'],
            $content['title'],
            $content['url'],
        ));

        return JsonResponse::create([],
            Response::HTTP_OK,
            $this->responseHeaderBag->all()
        );
    }

    /**
     * @Route(path="/{trackId}", name="api_track_delete", methods={"DELETE"})
     */
    public function remove(Request $request, CommandBusInterface $commandBus)
    {
        $commandBus->dispatch(new DeleteTrack(
            (int) $request->get('trackId')
        ));

        return JsonResponse::create([],
            Response::HTTP_OK,
            $this->responseHeaderBag->all()
        );
    }

    /**
     * @Route(path="", name="api_track_list",methods={"GET"})
     */
    public function listAll(TrackRepositoryInterface $trackRepository)
    {
        $tracks = $trackRepository->findAll();
        $count = \count($tracks);

        return JsonResponse::create(json_encode($tracks), Response::HTTP_OK, [
                'Content-Range' => sprintf('%s %d-%d/%d', 'Track', 0, $count, $count)
            ]
        );
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