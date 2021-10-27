<?php

namespace App\Services\Contracts;


interface FetcherService
{
    /**
     * Fetch all users.
     *
     * @return array
     */
    public function fetchAllUsers(): array;

    /**
     * Fetch one user specified by id.
     *
     * @return array
     */
    public function fetchOneUser(int $id): array;
}
