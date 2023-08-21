<?php

namespace Modules\Simpsons\Processes\Process;

use App\Processes\AbstractProcess;
use Modules\Simpsons\Processes\Tasks\CountDatabaseQuotes;
use Modules\Simpsons\Processes\Tasks\DatabaseQuotes;
use Modules\Simpsons\Processes\Tasks\RemoveDatabaseFirstQuote;
use Modules\Simpsons\Processes\Tasks\ReturnJsonResponse;
use Modules\Simpsons\Processes\Tasks\SimpsonsApiQuotes;

class SimpsonsProcess extends AbstractProcess
{
    /** @phpstan-ignore-next-line */
    protected array $tasks = [
        CountDatabaseQuotes::class,
        SimpsonsApiQuotes::class,
        DatabaseQuotes::class,
        RemoveDatabaseFirstQuote::class,
        ReturnJsonResponse::class,
    ];
}
