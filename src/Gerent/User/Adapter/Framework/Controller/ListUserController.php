<?php

declare(strict_types=1);

namespace Gerent\User\Adapter\Framework\Controller;

use Gerent\User\Application\ListUserService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ListUserController
{
    public function __construct(
        private ListUserService $listUserService
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse(
            $this->listUserService->__invoke($request),
            JsonResponse::HTTP_OK
        );
    }
}
