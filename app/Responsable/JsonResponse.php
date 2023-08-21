<?php

namespace App\Responsable;

use App\Traits\SendsResponse;
use Illuminate\Contracts\Support\Responsable;
use JustSteveKing\StatusCode\Http;

class JsonResponse implements Responsable
{
    use SendsResponse;

    public function __construct(
        public readonly array $data,
        public readonly Http $status = Http::OK,
    ) {
    }
}
