<?php

namespace App\Listeners;

use App\Events\NewPostAdded;
use App\Mail\NewPostNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPostAddedNotificationMail
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
     * @param  NewPostAdded  $event
     * @return void
     */
    public function handle(NewPostAdded $event)
    {
        Mail::to($event->subscriber->email)->send(
            new NewPostNotification($event->author, $event->subscriber)
        );
    }
}
