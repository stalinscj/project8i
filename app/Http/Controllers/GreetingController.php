<?php

namespace App\Http\Controllers;

use App\Models\Greeting;
use App\Jobs\SendGreetingJob;
use App\Http\Requests\GreetingRequest;

class GreetingController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('greetings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\GreetingRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(GreetingRequest $request)
    {
        $greeting = Greeting::create($request->validated());

        SendGreetingJob::dispatch($greeting);

        return view('greetings.create', ['alert' => 'Greetings sent successfully.']);
    }
}
