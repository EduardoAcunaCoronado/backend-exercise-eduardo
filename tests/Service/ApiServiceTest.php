<?php

namespace App\Tests\Service;

use App\Service\ApiService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;


/**
 * Class ApiServiceTest
 * @package App\Tests\Service
 *
 * @covers ApiService
 */
class ApiServiceTest extends TestCase {

    /**
     * @covers ApiService::getSerializer
     */
    public function testGetSerializer() {
        $apiService = new ApiService();

        $this->assertNotEmpty($apiService->getSerializer(), "Serializer no debe estar vacío");
    }

    /**
     * @covers ApiService::getData
     * @throws GuzzleException
     */
    public function testGetData() {
        $apiService = new ApiService();

        $serializer = $apiService->getSerializer();
        $response = json_decode($apiService->find("es", "1", "1")->getBody()->getContents());
        $data = $apiService->getData($serializer, $response, "details");
        $this->assertNotEmpty($data,"Data no debe estar vacío");
        $this->assertArrayHasKey("id", $data[0], "Data debe tener el atributo id");
        $this->assertArrayHasKey("name", $data[0], "Data debe tener el atributo name");
        $this->assertArrayHasKey("description", $data[0], "Data debe tener  el atributo description");
        $this->assertArrayHasKey("imageUrl", $data[0], "Data debe tener el atributo imageUrl");
        $this->assertArrayHasKey("tagline", $data[0], "Data debe tener el atributo tagline");
        $this->assertArrayHasKey("firstBrewed", $data[0], "Data debe tener  el atributo firstBrewed");
        $this->assertArrayNotHasKey("_id", $data[0], "Data no debe tener el atributo _id");
        $this->assertArrayNotHasKey("_name", $data[0], "Data no debe tener el atributo _name");
        $this->assertArrayNotHasKey("_description", $data[0], "Data no debe tener el atributo _description");
        $this->assertArrayNotHasKey("_imageUrl", $data[0], "Data no debe tener el atributo _imageUrl");
        $this->assertArrayNotHasKey("_tagline", $data[0], "Data no debe tener el atributo _tagline");
        $this->assertArrayNotHasKey("_firstBrewed", $data[0], "Data no debe tener el atributo _firstBrewed");
    }

    /**
     * @covers ApiService::find
     */
    public function testFind() {
        $apiService = new ApiService();

        $serializer = $apiService->getSerializer();
        $response = json_decode($apiService->find("es", "1", "1")->getBody()->getContents());

        $this->assertNotEmpty($apiService->getData($serializer, $response, "details"),"Response no debe estar vacío");
        $this->assertArrayHasKey("0", $response, "Response debe tener al menos un elemento");
        $this->assertArrayNotHasKey("1", $response, "Response debe tener un solo elemento");
    }

}