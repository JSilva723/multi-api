<?php

declare(strict_types=1);

namespace Shared\Http;

use Symfony\Component\HttpFoundation\Request;

interface RequestDTO
{
    public function __construct(Request $request);
}
