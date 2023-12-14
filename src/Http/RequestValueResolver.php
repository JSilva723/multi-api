<?php

declare(strict_types=1);

namespace App\Http;

use App\Http\DTO\RequestDTO;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class RequestValueResolver implements ValueResolverInterface
{
    public function __construct(
        private RequestBodyTransformer $requestBodyTransformer,
    ) {
    }

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        $reflectionClass = new \ReflectionClass($argument->getType());
        if ($reflectionClass->implementsInterface(RequestDTO::class)) {
            return true;
        }

        return false;
    }

    public function resolve(Request $request, ArgumentMetadata $argument): \Generator
    {
        $this->requestBodyTransformer->transform($request);
        $class = $argument->getType();
        yield new $class($request);
    }
}