<?php

namespace Modules\Simpsons\Processes\Tasks;

use App\Processes\Contracts\ModelPayloadInterface;
use App\Processes\Contracts\TaskInterface;
use Closure;
use Illuminate\Support\Facades\DB;
use Modules\Quotes\Repositories\Contracts\QuotesRepository;
use Modules\Simpsons\Services\Contracts\SimpsonsServiceInterface;

class SimpsonsApiQuotes implements TaskInterface
{
    public function __construct(
        private readonly SimpsonsServiceInterface $simpsonsService,
        private readonly QuotesRepository $quotesRepository,
    ) {
    }

    public function __invoke(ModelPayloadInterface $payload, Closure $next): mixed
    {

        DB::transaction(function () use (&$payload) {
            $quotes = $this->simpsonsService->get([
                'count' => $payload->count,
                'character' => $payload->character
            ])->object();

            $this->quotesRepository->loadQuotes($quotes);
        });

        return $next($payload);
    }
}
