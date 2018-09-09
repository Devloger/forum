<?php

namespace App\Listeners;

use App\Events\PostLiked;
use App\Models\Ranks;

class RankChecker
{

    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PostLiked  $event
     * @return void
     */
    public function handle(PostLiked $event)
    {
        $ranks = Ranks::orderby('minimum', 'DESC')->get();

        foreach($ranks as $rank)
        {
            if( $event->post->users->reputations->sum('value') >= $rank->minimum )
            {
                $event->post->users->rank = $rank->id;
                $event->post->users->save();
                break;
            }
        }
    }
}
