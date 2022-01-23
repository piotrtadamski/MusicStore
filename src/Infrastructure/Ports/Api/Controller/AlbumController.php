<?php

namespace MusicStore\Infrastructure\Ports\Api\Controller;

use MusicStore\Application\Command\Album\AddAlbum;
use MusicStore\Application\Command\Album\EditAlbum;
use MusicStore\Application\Command\CommandBusInterface;
use MusicStore\Domain\Album\AlbumRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/api/album")
 */
class AlbumController extends AbstractController
{
    private ResponseHeaderBag $responseHeaderBag;

    public function __construct(ResponseHeaderBag $responseHeaderBag)
    {
        $this->responseHeaderBag = $responseHeaderBag;
    }

    /**
     * @Route(path="/{albumId}", name="api_album_show", methods={"GET"})
     */
    public function show(Request $request, AlbumRepositoryInterface $albumRepository)
    {
        $track = $albumRepository->get((int) $request->get('albumId'));
        return JsonResponse::create($track);
    }

    /**
     * @Route(path="/{albumId}", name="api_album_update", methods={"PUT"})
     */
    public function update(Request $request, CommandBusInterface $commandBus)
    {
        $content = json_decode($request->getContent(), true);
        $commandBus->dispatch(new EditAlbum(
            (int) $request->get('albumId'),
            (int) $request->get('bandId'),
            $content['title'],
            $content['year']
        ));

        return JsonResponse::create([],
            Response::HTTP_OK,
            $this->responseHeaderBag->all()
        );
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
     * @Route(path="", name="api_album_create", methods={"POST"})
     */
    public function create(Request $request, CommandBusInterface $commandBus)
    {
        $content = json_decode($request->getContent(), true);
        $commandBus->dispatch(new AddAlbum(
            $content['title'],
            $content['year'],
            (int) $content['albumId']
        ));

        return JsonResponse::create([],
            Response::HTTP_CREATED,
            $this->responseHeaderBag->all()
        );
    }
}