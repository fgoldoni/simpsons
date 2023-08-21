<?php

namespace Modules\Simpsons\Processes\Tasks;

use App\Processes\Contracts\ModelPayloadInterface;
use App\Processes\Contracts\TaskInterface;
use App\Repositories\Criteria\EagerLoad;
use App\Repositories\Criteria\Limit;
use App\Repositories\Criteria\Where;
use Closure;
use Illuminate\Support\Facades\DB;
use Modules\Quotes\Repositories\Contracts\QuotesRepository;

class CountDatabaseQuotes implements TaskInterface
{
    public function __construct(private readonly QuotesRepository $quotesRepository)
    {
    }

    public function __invoke(ModelPayloadInterface $payload, Closure $next): mixed
    {

        DB::transaction(function () use (&$payload) {
            $quotes = $this->quotesRepository->withCriteria([
                new EagerLoad(['user']),
                new Where('quotes.user_id', $payload->user->id),
                new Limit(4),
            ])->get();


            $payload->__set('count', 5 - $quotes->count());
        });

        return $next($payload);
    }
}
