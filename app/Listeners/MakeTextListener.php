<?php

namespace App\Listeners;

use App\Event\CreatedTagEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MakeTextListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CreatedTagEvent  $event
     * @return void
     */
    public function handle(CreatedTagEvent $event)
    {
        //
        $file = sprintf("%s/%s.txt",storage_path('text'),date('Ymd-His'));
        touch($file);
        $current = file_get_contents($file);
        $current .= $event->param;
        file_put_contents($current);
;    }
}
