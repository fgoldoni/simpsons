<?php

namespace App\Processes\Contracts;

use Closure;

interface TaskInterface
{
    public function __invoke(ModelPayloadInterface $payload, Closure $next): mixed;
}
