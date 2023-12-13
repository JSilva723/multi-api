<?php

declare(strict_types=1);

namespace App\Tests\Gerent\Functional\Controller;

use App\Tests\WebTestCaseBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ChangePasswordControllerTest extends WebTestCaseBase
{
    private const ENDPOINT = '/api/gerent/user/%s/change-password';
    private const ID = '76159d92-0bf9-431f-acbb-5944d193226c';

    public function testChangePasswordSucces(): void
    {
        $payload = [
            'current' => 'admin_test_123',
            'new' => 'admin_test_456',
        ];
        self::$baseClient->request(Request::METHOD_POST, sprintf(self::ENDPOINT, self::ID), [], [], [], \json_encode($payload));
        $response = self::$baseClient->getResponse();
        self::assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());
        $responseData = \json_decode($response->getContent(), true);
        self::assertArrayHasKey('message', $responseData);
        self::assertEquals('Your password has been changed successfully', $responseData['message']);
    }
}