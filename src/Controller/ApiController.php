<?php

namespace App\Controller;

use App\Service\ApiService;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController extends AbstractController {

    private ApiService $apiService;

    public function __construct() {
        $this->apiService = new ApiService();
    }

    /**
     * @throws GuzzleException
     */
    public function find($food, $page, $perPage): JsonResponse {
        $serializer = $this->apiService->getSerializer();
        $response = json_decode($this->apiService->find($food, $page, $perPage)->getBody()->getContents());
        $data = $this->apiService->getData($serializer, $response, "find");
        return new JsonResponse($data);
    }

}