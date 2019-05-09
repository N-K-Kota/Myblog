<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Event\CreatedTagEvent' => [
            'App\Listeners\MakeTextListener'
        ],
        // 'App\Event\RegisteredEvent' => [
        //     'App\Listeners\CreateBlogListener'
        // ]
    ];
    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        Event::listen('event.TestEvent', function($val){
            $file = sprintf("%s/%s.txt",storage_path('text'),date('Ymd-His'));
            touch($file);
            $current = file_get_contents($file);
            $current .= $event->param;
            file_put_contents($current);
        });
        //
    }
}
