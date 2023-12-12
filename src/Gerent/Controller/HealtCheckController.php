<?php

declare(strict_types=1);

namespace Gerent\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class HealtCheckController
{
    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse(
            ['status' => 'OK Gerent'],
            JsonResponse::HTTP_OK
        );
    }
}
