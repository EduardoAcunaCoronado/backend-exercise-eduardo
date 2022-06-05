<?php


namespace App\Service;


use App\Model\Beer;
use Doctrine\Common\Annotations\AnnotationReader;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;
use Symfony\Component\Serializer\Serializer;

class ApiService {

    private Client $client;

    public function __construct() {
        $this->client = new Client([
            'base_uri' => "https://api.punkapi.com/v2/",
            'timeout' => 2.0
        ]);
    }

    public function getSerializer(): Serializer {

        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));

        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer($classMetadataFactory), new PropertyNormalizer(), new DateTimeNormalizer()];

        return new Serializer($normalizers, $encoders);

    }

    public function getData($serializer, $response, $group) {
        $data = [];

        foreach ($response as $item) {
            $beer = new Beer();
            $beer->setId($item->id);
            $beer->setName($item->name);
            $beer->setDescription($item->description);
            $beer->setImageUrl($item->image_url);
            $beer->setTagline($item->tagline);
            $beer->setFirstBrewed($item->first_brewed);
            $data[] = $beer;
        }

        return $serializer->normalize($data, "json", ['groups' => $group]);
    }

    /**
     * @throws GuzzleException
     */
    public function find($food, $page, $perPage): Response {
        if($food === null || $food !== ""){
            return $this->client->request('GET', 'beers?page='.$page.'&per_page='.$perPage.'&food='.$food);
        }
        else {
            return $this->client->request('GET', 'beers');
        }
    }
}