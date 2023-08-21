<?php

namespace Modules\Simpsons\Processes\Tasks;

use App\Processes\Contracts\ModelPayloadInterface;
use App\Processes\Contracts\TaskInterface;
use Closure;
use Illuminate\Support\Facades\DB;
use Modules\Quotes\Repositories\Contracts\QuotesRepository;

class RemoveDatabaseFirstQuote implements TaskInterface
{
    public function __construct(private readonly QuotesRepository $quotesRepository)
    {
    }

    public function __invoke(ModelPayloadInterface $payload, Closure $next): mixed
    {
        DB::transaction(function () use (&$payload) {

            if ($payload->__get('quotes')->count() && $payload->__get('quotes')->last()) {
                $this->quotesRepository->delete($payload->__get('quotes')->last()->id);
            }
        });

        return $next($payload);
    }
}
