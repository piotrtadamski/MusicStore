<?php

namespace MusicStore\Infrastructure\Ports\Api\Controller;

use MusicStore\Application\Command\Album\AddAlbum;
use MusicStore\Application\Command\Album\DeleteAlbum;
use MusicStore\Application\Command\Album\EditAlbum;
use MusicStore\Application\Command\Album\PromoteAlbum;
use MusicStore\Application\Command\CommandBusInterface;
use MusicStore\Domain\Album\AlbumRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

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
     * @Route(path="/{albumId}/promote", name="api_album_promote", methods={"POST"})
     */
    public function promote(Request $request, CommandBusInterface $commandBus)
    {
        $commandBus->dispatch(new PromoteAlbum(
            (int)$request->get('albumId')
        ));

        return $this->json([
            'albumId' => (int)$request->get('albumId')
        ]);
    }

    /**
     * @Route(path="/{albumId}", name="api_album_show", methods={"GET"})
     */
    public function show(Request $request, AlbumRepositoryInterface $albumRepository, NormalizerInterface $normalizer)
    {
        $album = $albumRepository->get((int)$request->get('albumId'));
        return JsonResponse::create($normalizer->normalize($album, 'json'));
    }

    /**
     * @Route(path="/{albumId}", name="api_album_update", methods={"PUT"})
     */
    public function update(Request $request, CommandBusInterface $commandBus)
    {
        $content = json_decode($request->getContent(), true);
        $commandBus->dispatch(new EditAlbum(
            (int)$request->get('albumId'),
            (int)$content['bandId'],
            $content['title'],
            $content['year']
        ));

        return JsonResponse::create(
            $content +
            [
                'albumId' => (int)$request->get('albumId')
            ],
            Response::HTTP_OK
        );
    }

    /**
     * @Route(path="/{albumId}", name="api_album_delete", methods={"DELETE"})
     */
    public function remove(Request $request, CommandBusInterface $commandBus)
    {
        $commandBus->dispatch(new DeleteAlbum(
            (int)$request->get('albumId')
        ));

        return JsonResponse::create(
            [
                (int)$request->get('albumId')
            ],
            Response::HTTP_OK,
            $this->responseHeaderBag->all()
        );
    }

    /**
     * @Route(path="", name="api_album_list",methods={"GET"})
     */
    public function listAll(AlbumRepositoryInterface $albumRepository, NormalizerInterface $normalizer)
    {
        $albums = $albumRepository->findAll();
        $count = \count($albums);

        return JsonResponse::create($normalizer->normalize($albums, 'json'), Response::HTTP_OK, [
                'Content-Range' => sprintf('%s %d-%d/%d', 'Album', 0, $count, $count)
            ]
        );
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
            (int)$content['bandId']
        ));

        return JsonResponse::create([],
            Response::HTTP_CREATED,
            $this->responseHeaderBag->all()
        );
    }
}