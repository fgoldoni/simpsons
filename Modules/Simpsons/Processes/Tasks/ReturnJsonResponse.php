<?php

namespace Modules\Simpsons\Processes\Tasks;

use App\Processes\Contracts\ModelPayloadInterface;
use App\Processes\Contracts\TaskInterface;
use App\Responsable\JsonResponse;
use Closure;
use Modules\Quotes\Transformers\QuoteResource;

class ReturnJsonResponse implements TaskInterface
{
    public function __invoke(ModelPayloadInterface $payload, Closure $next): mixed
    {
        return new JsonResponse(
            data: [
                'quotes' => QuoteResource::collection($payload->__get('quotes')),
            ],
        );
    }
}
