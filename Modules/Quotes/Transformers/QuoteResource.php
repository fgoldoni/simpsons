<?php

namespace Modules\Quotes\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class QuoteResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'quote' => $this->quote,
            'character' => $this->character,
            'image' => $this->image,
            'characterDirection' => $this->characterDirection,
            'user_id' => $this->user_id,
        ];
    }
}
