<?php

namespace Modules\Quotes\Repositories\Eloquent;

use App\Repositories\RepositoryAbstract;
use Illuminate\Support\Arr;
use Modules\Quotes\Entities\Quote;
use Modules\Quotes\Repositories\Contracts\QuotesRepository;

class EloquentQuotesRepository extends RepositoryAbstract implements QuotesRepository
{
    public function model(): string
    {
        return Quote::class;
    }

    public function loadQuotes(?array $quotes = [])
    {
        return Arr::map($quotes, function (object $quote) {
            return $this->create(
                array_merge(
                    json_decode(json_encode($quote), true),
                    ['user_id' => auth()->guard('api')->user()->id]
                )
            );
        });
    }
}
