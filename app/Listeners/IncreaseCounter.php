<?php

namespace App\Listeners;

use App\Events\VideoViewers;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncreaseCounter
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
     * @param  object  $event
     * @return void
     */
    public function handle(VideoViewers $event)
    {
         // video is the object from model i made it in the event
        $this->updateViews($event->video);
    }
    function updateViews($video) {
          $video->viewers = $video->viewers + 1;
          $video->save();
    }
}
