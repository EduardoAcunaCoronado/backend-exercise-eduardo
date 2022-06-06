<?php

namespace App\Controller;

use App\Service\ApiService;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class ApiController
 * @package App\Controller
 */
class ApiController extends AbstractController {

    private ApiService $apiService;

    /**
     * ApiController constructor.
     */
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

    /**
     * @throws GuzzleException
     */
    public function details($food, $page, $perPage): JsonResponse {
        $serializer = $this->apiService->getSerializer();
        $response = json_decode($this->apiService->find($food, $page, $perPage)->getBody()->getContents());
        $data = $this->apiService->getData($serializer, $response, "details");
        return new JsonResponse($data);
    }

}