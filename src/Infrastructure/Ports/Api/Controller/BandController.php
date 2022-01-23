<?php

namespace MusicStore\Infrastructure\Ports\Api\Controller;

use MusicStore\Application\Command\Band\AddBand;
use MusicStore\Application\Command\Band\EditBand;
use MusicStore\Application\Command\Band\DeleteBand;
use MusicStore\Application\Command\CommandBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;
use MusicStore\Domain\Band\BandRepositoryInterface;

/**
 * @Route(path="/api/band")
 */
class BandController extends AbstractController
{
    private ResponseHeaderBag $responseHeaderBag;

    public function __construct(ResponseHeaderBag $responseHeaderBag)
    {
        $this->responseHeaderBag = $responseHeaderBag;
    }

    /**
     * @Route(path="/{bandId}", name="api_band_show", methods={"GET"})
     */
    public function show(Request $request, BandRepositoryInterface $bandRepository)
    {
        $track = $bandRepository->get((int) $request->get('bandId'));
        return JsonResponse::create($track);
    }

    /**
     * @Route(path="/{bandId}", name="api_band_update", methods={"PUT"})
     */
    public function update(Request $request, CommandBusInterface $commandBus)
    {
        $content = json_decode($request->getContent(), true);
        $commandBus->dispatch(new EditBand(
            (int) $request->get('bandId'),
            $content['name']
        ));

        return JsonResponse::create([],
            Response::HTTP_OK,
            $this->responseHeaderBag->all()
        );
    }

    /**
     * @Route(path="/{bandId}", name="api_band_delete", methods={"DELETE"})
     */
    public function remove(Request $request, CommandBusInterface $commandBus)
    {
        $commandBus->dispatch(new DeleteBand(
            (int) $request->get('bandId')
        ));

        return JsonResponse::create([],
            Response::HTTP_OK,
            $this->responseHeaderBag->all()
        );
    }

    /**
     * @Route(path="", name="api_band_list",methods={"GET"})
     */
    public function listAll(BandRepositoryInterface $bandRepository)
    {
        $bands = $bandRepository->findAll();
        $count = \count($bands);

        return JsonResponse::create(json_encode($bands), Response::HTTP_OK, [
                'Content-Range' => sprintf('%s %d-%d/%d', 'Bands', 0, $count, $count)
            ]
        );
    }

    /**
     * @Route(path="", name="api_band_create", methods={"POST"})
     */
    public function create(Request $request, CommandBusInterface $commandBus)
    {
        $content = json_decode($request->getContent(), true);
        $commandBus->dispatch(new AddBand(
            $content['name']
        ));

        return JsonResponse::create([],
            Response::HTTP_CREATED,
            $this->responseHeaderBag->all()
        );
    }
}