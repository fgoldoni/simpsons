<?php

namespace App\Services;

use App\Services\Contracts\ServiceInterface;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Factory;

abstract class ServiceAbstract implements ServiceInterface
{
    protected string $baseUrl;
    public function __construct(protected readonly Factory $client)
    {
        $this->baseUrl = $this->baseUrl();
    }

    abstract protected function baseUrl(): string;

    public function get(array $data = []): PromiseInterface|\Illuminate\Http\Client\Response
    {
        return $this->client->acceptJson()->get($this->baseUrl, $data);
    }
}
