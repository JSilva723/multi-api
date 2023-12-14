<?php

declare(strict_types=1);

namespace App\Tests\Gerent\Functional\Controller;

use App\Tests\WebTestCaseBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ChangePasswordControllerTest extends WebTestCaseBase
{
    private const ENDPOINT = '/api/gerent/user/%s/change-password';
    private const ID = 'e7f56a85-1ac4-40c3-8c49-0077f44b0494';
    private const PAYLOAD = [
        'current' => 'admin_test_123',
        'new' => 'admin_test_456',
    ];

    public function testChangePasswordSucces(): void
    {
        self::$baseClient->request(
            Request::METHOD_POST,
            sprintf(self::ENDPOINT, self::ID),
            [], [], [], \json_encode(self::PAYLOAD)
        );
        $response = self::$baseClient->getResponse();
        self::assertEquals(JsonResponse::HTTP_ACCEPTED, $response->getStatusCode());
        $responseData = \json_decode($response->getContent(), true);
        self::assertArrayHasKey('message', $responseData);
        self::assertEquals('Your password has been changed successfully', $responseData['message']);
    }

    public function testChangePasswordNotFound(): void
    {
        $notFuondId = substr(self::ID, 0, 35).'1';
        self::$baseClient->request(
            Request::METHOD_POST,
            sprintf(self::ENDPOINT, $notFuondId),
            [], [], [], \json_encode(self::PAYLOAD)
        );
        $response = self::$baseClient->getResponse();
        self::assertEquals(JsonResponse::HTTP_NOT_FOUND, $response->getStatusCode());
        $responseData = \json_decode($response->getContent(), true);
        self::assertEquals(sprintf('The ID [%s] not found', $notFuondId), $responseData['message']);
    }

    public function testChangePasswordBadPayload(): void
    {
        $badPayload = self::PAYLOAD;
        $badPayload['current'] = 'bad-current-password'; 
        self::$baseClient->request(
            Request::METHOD_POST,
            sprintf(self::ENDPOINT, self::ID),
            [], [], [], \json_encode($badPayload)
        );
        $response = self::$baseClient->getResponse();
        self::assertEquals(JsonResponse::HTTP_BAD_REQUEST, $response->getStatusCode());
        $responseData = \json_decode($response->getContent(), true);
        self::assertEquals('Invalid current password!', $responseData['message']);
    }
}