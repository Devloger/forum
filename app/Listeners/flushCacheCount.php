<?php

namespace App\Listeners;

use App\Acme\CacheHelper;
use App\Events\newTopicOrPost;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class flushCacheCount
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
     * @param  newTopicOrPost  $event
     * @return void
     */
    public function handle(newTopicOrPost $event)
    {
        CacheHelper::flushIndex();
        CacheHelper::flushSection($event->section);
    }
}
