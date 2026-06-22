<?php


namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\LoginDevice;
use Browser;

class StoreLoginDevice
{
    public function handle(Login $event): void
    {
        $user = $event->user;

        LoginDevice::create([
            'user_id'    => $user->id,
            'ip_address' => request()->ip(),
            'device'     => Browser::deviceFamily(),
            'platform'   => Browser::platformName(),
            'browser'    => Browser::browserName(),
            'browser_version' => Browser::browserVersion(),
            'logged_in_at' => now(),
        ]);
    }
}
