<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller;

use App\Tests\WebTestCaseBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ChangePasswordControllerTest extends WebTestCaseBase
{
    private const ENDPOINT = '/api/user/%s/change-password';
    private const ID = '29577df1-deb0-4fa4-9ab3-2bab1a7e3a2d';
    private const PAYLOAD = [
        'current' => 'tenant_user_pass',
        'new' => 'tenant_user_pass_new',
    ];

    public function testChangePasswordSucces(): void
    {
        self::$authenticatedClient->request(
            Request::METHOD_POST,
            sprintf(self::ENDPOINT, self::ID),
            [], [], [], \json_encode(self::PAYLOAD)
        );
        $response = self::$authenticatedClient->getResponse();
        self::assertEquals(JsonResponse::HTTP_ACCEPTED, $response->getStatusCode());
        $responseData = \json_decode($response->getContent(), true);
        self::assertArrayHasKey('message', $responseData);
        self::assertEquals('Your password has been changed successfully', $responseData['message']);
    }

    public function testChangePasswordNotFound(): void
    {
        $notFuondId = substr(self::ID, 0, 35).'1';
        self::$authenticatedClient->request(
            Request::METHOD_POST,
            sprintf(self::ENDPOINT, $notFuondId),
            [], [], [], \json_encode(self::PAYLOAD)
        );
        $response = self::$authenticatedClient->getResponse();
        self::assertEquals(JsonResponse::HTTP_NOT_FOUND, $response->getStatusCode());
        $responseData = \json_decode($response->getContent(), true);
        self::assertEquals(sprintf('The ID [%s] not found', $notFuondId), $responseData['message']);
    }

    public function testChangePasswordBadPayload(): void
    {
        $badPayload = self::PAYLOAD;
        $badPayload['current'] = 'bad-current-password';
        self::$authenticatedClient->request(
            Request::METHOD_POST,
            sprintf(self::ENDPOINT, self::ID),
            [], [], [], \json_encode($badPayload)
        );
        $response = self::$authenticatedClient->getResponse();
        self::assertEquals(JsonResponse::HTTP_BAD_REQUEST, $response->getStatusCode());
        $responseData = \json_decode($response->getContent(), true);
        self::assertEquals('Invalid current password!', $responseData['message']);
    }
}
