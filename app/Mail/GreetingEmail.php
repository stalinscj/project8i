<?php

namespace App\Mail;

use App\Models\Greeting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class GreetingEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * The greeting object instance.
     *
     * @var \App\Models\Greeting
     */
    public $greeting;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Greeting $greeting)
    {
        $this->greeting = $greeting;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.greetings');
    }
}
