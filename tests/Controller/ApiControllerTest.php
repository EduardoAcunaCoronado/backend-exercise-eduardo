<?php

namespace App\Tests\Service;

use App\Controller\ApiController;
use App\Service\ApiService;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;


/**
 * Class ApiServiceTest
 * @package App\Tests\Service
 *
 * @covers ApiController
 */
class ApiControllerTest extends TestCase {

    /**
     * @covers ApiController::find
     * @throws GuzzleException
     */
    public function testFind() {
        $apiController = new ApiController();

        $response = $apiController->find("es", 1, 1);
        $body = $response->getContent();
        $this->assertJson($body, "Content debe ser json");

    }

    /**
     * @covers ApiService::find
     * @throws GuzzleException
     */
    public function testDetails() {
        $apiController = new ApiController();

        $response = $apiController->details("es", 1, 1);
        $body = $response->getContent();
        $this->assertJson($body, "Content debe ser json");
    }

}