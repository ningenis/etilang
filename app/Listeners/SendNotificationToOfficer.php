<?php

namespace App\Listeners;

use App\Events\ViolationCreated;
use App\Notifications\ViolationCreatedOfficer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNotificationToOfficer
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
     * @param  ViolationCreated  $event
     * @return void
     */
    public function handle(ViolationCreated $event)
    {
        $violation = $event->violation;
        $user = $violation->user;
        $user->notify(new ViolationCreatedOfficer($violation));
    }
}
