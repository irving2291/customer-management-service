<?php

namespace App\Http\Controllers;

use App\Events\ExampleEvent;
use App\Source\Record\Services\InformationRequestService;
use Illuminate\Http\Request;

class InformationRequestController extends Controller
{
    public function listen(Request $request)
    {
        return response()->json(InformationRequestService::create($request->input()));
    }


}
