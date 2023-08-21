<?php

namespace App\Processes;

use App\Processes\Contracts\ModelPayloadInterface;
use App\Processes\Contracts\TaskInterface;
use Illuminate\Support\Facades\Pipeline;

abstract class AbstractProcess
{
    /**
     * @var array<int, TaskInterface>
     */
    protected array $tasks;

    public function handle(ModelPayloadInterface $payload): mixed
    {
        return Pipeline::send(
            passable: $payload,
        )->through(
            pipes: $this->tasks,
        )->thenReturn();
    }
}
