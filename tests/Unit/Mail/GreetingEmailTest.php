<?php

namespace Tests\Unit\Mail;

use Tests\TestCase;
use App\Models\Greeting;
use App\Mail\GreetingEmail;
use Illuminate\Contracts\Queue\ShouldQueue;

class GreetingEmailTest extends TestCase
{
    /**
     * @test
     */
    public function must_be_sent_via_queue()
    {
        $greetingEmail = new GreetingEmail(new Greeting());

        $this->assertInstanceOf(ShouldQueue::class, $greetingEmail);
    }

    /**
     * @test
     */
    public function must_contains_the_greeting_receiver_and_the_message_in_the_html()
    {
        $greeting = Greeting::factory()->make();
        
        $greetingEmail = new GreetingEmail($greeting);

        $greetingEmail->assertSeeInHtml($greeting->to);

        $greetingEmail->assertSeeInHtml($greeting->message);
    }
}
