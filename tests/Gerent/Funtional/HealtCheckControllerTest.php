<?php

declare(strict_types=1);

namespace App\Tests\Gerent\Functional;

use App\Tests\WebTestCaseBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class HealtCheckControllerTest extends WebTestCaseBase
{
    private const ENDPOINT = '/api/gerent/healt-check';

    public function testIndex(): void
    {
        self::$baseClient->request(Request::METHOD_GET, self::ENDPOINT);
        $response = self::$baseClient->getResponse();
        self::assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());
        $responseData = \json_decode($response->getContent(), true);
        self::assertArrayHasKey('status', $responseData);
        self::assertEquals('OK Gerent', $responseData['status']);
    }
}
