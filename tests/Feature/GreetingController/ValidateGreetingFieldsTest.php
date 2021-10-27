<?php

namespace Tests\Feature\GreetingController;

use Tests\TestCase;
use App\Models\Greeting;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ValidateGreetingFieldsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function the_to_field_is_required_to_send_a_greeting()
    {
        $attributes = Greeting::factory()->raw(['to' => '']);

        $this->post(route('greetings.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'to',
            trans('validation.required', ['attribute' => 'to'])
        );

        $this->assertDatabaseCount('greetings', 0);
    }

    /**
     * @test
     */
    public function the_to_field_must_be_a_valid_email_to_send_a_greeting()
    {
        $attributes = Greeting::factory()->raw(['to' => 'invalid-email']);

        $this->post(route('greetings.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'to',
            trans('validation.email', ['attribute' => 'to'])
        );

        $this->assertDatabaseCount('greetings', 0);
    }

    /**
     * @test
     */
    public function the_to_field_must_not_be_greater_than_100_chars_to_send_a_greeting()
    {
        $attributes = Greeting::factory()->raw(['to' => Str::random(101)]);

        $this->post(route('greetings.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'to',
            trans('validation.max.string', ['attribute' => 'to', 'max' => 100]),
            1
        );

        $this->assertDatabaseCount('greetings', 0);
    }

    /**
     * @test
     */
    public function the_message_field_is_required_to_send_a_greeting()
    {
        $attributes = Greeting::factory()->raw(['message' => '']);

        $this->post(route('greetings.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'message',
            trans('validation.required', ['attribute' => 'message'])
        );

        $this->assertDatabaseCount('greetings', 0);
    }

    /**
     * @test
     */
    public function the_message_field_must_not_be_greater_than_1000_chars_to_send_a_greeting()
    {
        $attributes = Greeting::factory()->raw(['message' => Str::random(1001)]);

        $this->post(route('greetings.store'), $attributes);

        $this->assertSessionHasErrorKeyValue(
            'message',
            trans('validation.max.string', ['attribute' => 'message', 'max' => 1000])
        );

        $this->assertDatabaseCount('greetings', 0);
    }
}
