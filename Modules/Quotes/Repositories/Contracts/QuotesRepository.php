<?php

namespace Modules\Quotes\Repositories\Contracts;

interface QuotesRepository
{
    public function loadQuotes(?array $quotes = []);
}
