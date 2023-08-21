<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class SimpsonsTest extends TestCase
{
    use RefreshDatabase;

    public function test_five_quotes(): void
    {
        $user = User::factory()->create();
    }
}
