<?php

namespace Modules\Quotes\Entities;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quote extends Model
{
    use BelongsToUser;
    use SoftDeletes;

    protected $guarded = [];
}
