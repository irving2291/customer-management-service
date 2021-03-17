<?php

namespace App\Http\Controllers;

use App\Events\ExampleEvent;
use App\Source\Record\InformationRequest;
use App\Source\Record\Services\InformationRequestService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class InformationRequestsController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function listen(Request $request)
    {
        $validated = $this->validate($request, [
                'email' => 'required',
                'name' => 'required',
                'lastName' => 'required',
                'productId' => 'required',
                'languageId' => 'required',
                'country' => 'required',
            ]
        );
        return response()->json(InformationRequestService::create($request->input()));
    }

    public function index()
    {
        return response()->json(InformationRequest::all(), 200);
    }
}
