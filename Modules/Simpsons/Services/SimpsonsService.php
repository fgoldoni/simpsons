<?php

namespace Modules\Simpsons\Services;

use App\Services\ServiceAbstract;
use Modules\Simpsons\Services\Contracts\SimpsonsServiceInterface;

/**
 * Class SimpsonsService.
 */
class SimpsonsService extends ServiceAbstract implements SimpsonsServiceInterface
{
    protected function baseUrl(): string
    {
        return 'https://thesimpsonsquoteapi.glitch.me/quotes';
    }
}
