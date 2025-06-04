<?php
namespace App\Listeners;

use Illuminate\Auth\Events\Registered;

class SendEmailVerificationNotification
{
    public function handle(Registered $event)
    {
        $event->user->sendEmailVerificationNotification();
    }
}
