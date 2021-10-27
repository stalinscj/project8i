<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\FetcherService;
use Illuminate\Support\Facades\Http;
use App\Services\Contracts\FetcherService as FetcherServiceContract;

class FetcherServiceTest extends TestCase
{
    /**
     * @test
     */
    public function must_implements_fetcher_service_interface()
    {
        $fetcher = $this->createMock(FetcherService::class);

        $this->assertInstanceOf(FetcherServiceContract::class, $fetcher);
    }

    /**
     * @test
     */
    public function must_have_a_valid_config_defined()
    {
        $config = config('services.jsonplaceholder');

        $this->assertIsArray($config);

        $this->assertNotEmpty($config['host'] ?? null);

        $this->assertNotFalse(filter_var($config['host'], FILTER_VALIDATE_URL));
    }

    /**
     * @test
     */
    public function can_fetch_all_users_from_host()
    {
        $response = [
            ['email' => 'email_1@email.com'],
            ['email' => 'email_2@email.com']
        ];

        Http::fake(function ($request) use ($response) {
            return $response;
        });

        $fetcher = new FetcherService();

        $users = $fetcher->fetchAllUsers();

        $this->assertEquals($response, $users);

        Http::assertSent(function ($request) {

            $url    = config('services.jsonplaceholder.host') . '/users';
            $method = 'GET';

            $this->assertEquals($url,    $request->url());
            $this->assertEquals($method, $request->method());

            return true;
        });
    }

    /**
     * @test
     */
    public function can_fetch_a_user_from_host()
    {
        $response = ['email' => 'email@email.com'];

        Http::fake(function ($request) use ($response) {
            return $response;
        });

        $fetcher = new FetcherService();

        $user = $fetcher->fetchOneUser(1);

        $this->assertEquals($response, $user);

        Http::assertSent(function ($request) {

            $url    = config('services.jsonplaceholder.host') . '/users/1';
            $method = 'GET';

            $this->assertEquals($url,    $request->url());
            $this->assertEquals($method, $request->method());

            return true;
        });
    }
}
