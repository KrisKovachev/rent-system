<?php

namespace App\Listeners;
use App\Models\User;
use Illuminate\Auth\Events\Login;

class LastLoginListener
{
    public function handle(Login $event): void
    {
        $event->user->last_login_at = now();
        $user = $event->user;
    if ($user instanceof User) {
        $user->update(['last_login_at' => now()]);
    }
    }
}
