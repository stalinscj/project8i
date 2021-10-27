<?php

namespace Tests\Feature\GreetingController;

use Tests\TestCase;
use App\Models\Greeting;
use App\Jobs\SendGreetingJob;
use Illuminate\Support\Facades\Bus;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SendGreetingTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function users_can_access_to_send_greetings_view()
    {
        $this->get(route('greetings.create'))
            ->assertSuccessful()
            ->assertViewIs('greetings.create');
    }

    /**
     * @test
     */
    public function users_can_send_a_greeting()
    {
        Bus::fake();

        $attributes = Greeting::factory()->raw();

        $this->post(route('greetings.store'), $attributes);

        $this->assertDatabaseCount('greetings', 1);

        $this->assertDatabaseHas('greetings', $attributes);

        Bus::assertDispatched(SendGreetingJob::class);
    }
}
