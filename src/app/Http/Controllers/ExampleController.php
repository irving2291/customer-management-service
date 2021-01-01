<?php

namespace App\Http\Controllers;

use App\Events\ExampleEvent;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function test()
    {
        event(new ExampleEvent('god!'));
    }
}
