<?php

namespace App\Listeners;

use App\Events\msgShownEvent;
use App\Models\Messages;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class readCheckerListener {
	
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
	 * @param  msgShownEvent $event
	 * @return void
	 */
	public function handle(msgShownEvent $event)
	{
		Messages::where('line', $event->message->line)
			->where('to', $event->user->id)
			->update(['read' => 1]);
    }
}
