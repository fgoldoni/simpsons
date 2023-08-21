<?php

namespace App\Services\Contracts;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;

interface ServiceInterface
{
    public function get(array $data = []): PromiseInterface|Response;
}
