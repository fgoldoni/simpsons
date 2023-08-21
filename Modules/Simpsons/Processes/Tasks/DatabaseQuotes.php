<?php

namespace Modules\Simpsons\Processes\Tasks;

use App\Processes\Contracts\ModelPayloadInterface;
use App\Processes\Contracts\TaskInterface;
use App\Repositories\Criteria\EagerLoad;
use App\Repositories\Criteria\Limit;
use App\Repositories\Criteria\OrderBy;
use App\Repositories\Criteria\Where;
use Closure;
use Illuminate\Support\Facades\DB;
use Modules\Quotes\Repositories\Contracts\QuotesRepository;

class DatabaseQuotes implements TaskInterface
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
                new OrderBy('quotes.id', 'desc'),
                new Limit(5)
            ])->get();

            $payload->__set('quotes', $quotes);
        });

        return $next($payload);
    }
}
