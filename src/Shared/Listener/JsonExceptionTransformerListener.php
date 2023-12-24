<?php

declare(strict_types=1);

namespace Shared\Listener;

use Shared\Exception\BadRequestException;
use Shared\Exception\NotFoundException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class JsonExceptionTransformerListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        $data = [
            'class' => \get_class($exception),
            'code' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
            'message' => $exception->getMessage(),
        ];

        if ($exception instanceof HttpExceptionInterface) {
            $data['code'] = $exception->getStatusCode();
        }

        if ($exception instanceof BadRequestException) {
            $data['code'] = JsonResponse::HTTP_BAD_REQUEST;
        }

        if ($exception instanceof NotFoundException) {
            $data['code'] = JsonResponse::HTTP_NOT_FOUND;
        }

        $event->setResponse($this->prepareResponse($data));
    }

    private function prepareResponse(array $data): JsonResponse
    {
        return new JsonResponse($data, $data['code']);
    }
}
