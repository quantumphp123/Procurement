<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use App\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\EnquiryCreated' => [
            'App\Listeners\NotifySellersAboutEnquiry',
        ],
    ];

    public function boot(): void
    {
        //
    }
}
