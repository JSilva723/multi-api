<?php

declare(strict_types=1);

namespace Gerent\User\Adapter\Framework\Controller;

use Gerent\User\Application\ChangePasswordService;
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
        $id = $request->attributes->get('id');
        $data = \json_decode($request->getContent(), true);

        return new JsonResponse(
            $this->changePasswordService->__invoke($id, $data),
            JsonResponse::HTTP_ACCEPTED
        );
    }
}
