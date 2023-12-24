<?php

declare(strict_types=1);

namespace Shared\Http;

use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

class RequestBodyTransformer
{
    public function transform(Request $request)
    {
        switch ($request->headers->get('Content-Type')) {
            case 'application/json':
                $data = \json_decode($request->getContent(), true, 512, \JSON_THROW_ON_ERROR);
                $request->request = new ParameterBag($data);
                break;
            default:
                break;
        }
    }
}
