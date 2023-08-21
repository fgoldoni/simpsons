<?php

/**
 * Created by PhpStorm.
 * User: goldoni
 * Date: 24.11.18
 * Time: 15:33.
 */

namespace App\Repositories\Criteria;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class isPublished.
 */
class WhereUser
{
    public function __construct()
    {
    }

    public function apply($model): Builder
    {
        return $model->role(config('app.system.users.roles.default'));
    }
}
