<?php

namespace Tests\Unit\Jobs;

use Tests\TestCase;
use App\Models\Greeting;
use App\Mail\GreetingEmail;
use App\Jobs\SendGreetingJob;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SendGreetingJobTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function must_be_processed_via_queue()
    {
        $sendGreetingJob = new SendGreetingJob(new Greeting());

        $this->assertInstanceOf(ShouldQueue::class, $sendGreetingJob);
    }

    /**
     * @test
     */
    public function a_mail_with_greetings_is_sent_when_the_job_is_dipached()
    {
        Mail::fake();

        $greeting = Greeting::factory()->create();

        SendGreetingJob::dispatch($greeting);

        Mail::assertQueued(
            GreetingEmail::class, 
            function ($greetingEmail) use ($greeting) {
                $this->assertTrue($greetingEmail->hasTo($greeting->to));
                $this->assertTrue($greetingEmail->greeting->is($greeting));

                return true;
            }
        );
    }
}
