<?php

/**
 * Created by PhpStorm.
 * User: goldoni
 * Date: 18.11.18
 * Time: 15:17.
 */

namespace App\Repositories\Criteria;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class Where.
 */
class Where
{
    /**
     * Where constructor.
     */
    public function __construct(private readonly string $column, private readonly string|bool|int|null $value = null)
    {
    }

    public function apply($model): Builder
    {
        return $model->when($this->value, fn ($query) => $query->where($this->column, $this->value));
    }
}
