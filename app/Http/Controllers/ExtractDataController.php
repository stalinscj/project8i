<?php

namespace App\Http\Controllers;

use App\Services\Contracts\FetcherService;

class ExtractDataController extends Controller
{
    /**
     * Extract data from API
     *
     * @param \App\Services\Contracts\FetcherService
     * @return void
     */
    public function __invoke(FetcherService $fetcher)
    {
        $users = $fetcher->fetchAllUsers();

        $user = $fetcher->fetchOneUser(1);

        dump($users, $user);
    }
}
