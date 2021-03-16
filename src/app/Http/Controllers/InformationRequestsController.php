<?php

namespace App\Http\Controllers;

use App\Events\ExampleEvent;
use App\Source\Record\InformationRequest;
use App\Source\Record\Services\InformationRequestService;
use Illuminate\Http\Request;

class InformationRequestsController extends Controller
{
    public function listen(Request $request)
    {
        return response()->json(InformationRequestService::create($request->input()));
    }

    public function index()
    {
        return response()->json(InformationRequest::all(), 200);
    }
}
