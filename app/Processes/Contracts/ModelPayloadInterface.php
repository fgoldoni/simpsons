<?php

namespace App\Processes\Contracts;

use Illuminate\Foundation\Http\FormRequest;

interface ModelPayloadInterface
{
    public static function make(FormRequest $request): self;

    public function toArray(): array;
}
