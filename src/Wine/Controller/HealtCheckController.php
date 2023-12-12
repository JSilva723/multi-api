<?php

declare(strict_types=1);

namespace Wine\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class HealtCheckController
{
    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse(
            ['status' => 'OK Wine'],
            JsonResponse::HTTP_OK
        );
    }
}
