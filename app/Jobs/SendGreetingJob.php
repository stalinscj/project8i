<?php

namespace App\Jobs;

use App\Models\Greeting;
use App\Mail\GreetingEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendGreetingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Greeting to send.
     *
     * @var \App\Models\Greeting
     */
    protected $greeting;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Greeting $greeting)
    {
        $this->greeting = $greeting;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->greeting->to)
            ->send(new GreetingEmail($this->greeting));
    }
}
