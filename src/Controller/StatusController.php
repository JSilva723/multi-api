<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class StatusController
{
    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse(
            ['status' => 'OK beer'],
            JsonResponse::HTTP_OK
        );
    }
}