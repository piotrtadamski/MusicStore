<?php

namespace MusicStore\Infrastructure\Ports\Api\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route(path="", methods={"GET"})
     */
    public function show()
    {
        return JsonResponse::create([], Response::HTTP_NOT_IMPLEMENTED);
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
     * @Route(path="", methods={"POST"})
     */
    public function create()
    {
        return JsonResponse::create([], Response::HTTP_NOT_IMPLEMENTED);
    }
}