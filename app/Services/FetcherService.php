<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Services\Contracts\FetcherService as FetcherServiceContract;

class FetcherService implements FetcherServiceContract
{
    /**
     * Host
     *
     * @var string
     */
    protected $host;

    /**
     * Users Path
     *
     * @var string
     */
    protected $usersPath;

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct() {
        $this->loadConfig();
    }

    /**
     * Load config params
     *
     * @return $this
     */
    public function loadConfig()
    {
        $this->host      = config('services.jsonplaceholder.host');
        $this->usersPath = $this->host . '/users';

        return $this;
    }

    /**
     * Fetch all users.
     *
     * @return array
     */
    public function fetchAllUsers(): array {
        $response = Http::get($this->usersPath);

        $users = $response->ok()
            ? $response->json()
            : [];

        return $users;
    }

    /**
     * Fetch one user specified by id.
     *
     * @return array
     */
    public function fetchOneUser(int $id): array {
        $response = Http::get("$this->usersPath/$id");

        $user = $response->ok()
            ? $response->json()
            : [];

        return $user;
    }
}
