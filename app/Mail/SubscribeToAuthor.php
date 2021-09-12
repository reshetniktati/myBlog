<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscribeToAuthor extends Mailable
{
    use Queueable, SerializesModels;

    public $author;

    public $subscriber;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($author, $subscriber)
    {
        $this->author = $author;
        $this->subscriber = $subscriber;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.subscribe-to-author');
    }
}
