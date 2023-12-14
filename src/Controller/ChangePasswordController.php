<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\ChangePasswordService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ChangePasswordController
{
    public function __construct(
        private ChangePasswordService $changePasswordService
    ) {
    }
    
    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse(
            $this->changePasswordService->__invoke($request),
            JsonResponse::HTTP_ACCEPTED
        );
    }
}
