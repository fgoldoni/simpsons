<?php

namespace Modules\Simpsons\Processes\Payload;

use App\Models\User;
use App\Processes\Contracts\ModelPayloadInterface;
use App\Processes\Payload;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Modules\Quotes\Entities\Quote;

class SimpsonPayload extends Payload implements ModelPayloadInterface
{
    public function __construct(
        public readonly User|Model|null $user,
        public readonly string|null $character = null,
        public $quotes = null,
        public Quote|Model|null $first = null,
        public int $count = 5,
    ) {
    }

    public static function make(FormRequest|Request $request): ModelPayloadInterface
    {

        return new self(
            user: $request->user(),
            character: $request->get('character'),
        );
    }
}
