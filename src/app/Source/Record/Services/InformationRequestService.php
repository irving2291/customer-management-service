<?php


namespace App\Source\Record\Services;


use App\Source\Record\InformationRequest;
use App\Source\Responsibility\Services\DelegateService;

class InformationRequestService
{
    public static function create($payload)
    {
        //create person
        /** @var InformationRequest $informationRequest */
        $informationRequest = InformationRequest::firstOrNew([
            'productId' => $payload
        ]);
        if ($informationRequest->exists) {
            // add tracing
        } else {
            $informationRequest = InformationRequest::create([
                'productId' => $payload['productId'],
                'languageId' => $payload['languageId']
            ]);
            // add delegate
            DelegateService::assignDelegateInformationRequestUnderResponsibility();
        }
        return $informationRequest;
    }
}
