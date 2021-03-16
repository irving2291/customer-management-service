<?php


namespace App\Source\Record\Services;


use App\Source\Common\Email;
use App\Source\Common\Person;
use App\Source\Record\InformationRequest;
use App\Source\Responsibility\Services\DelegateService;

class InformationRequestService
{
    public static function create($payload)
    {
        /** @var Email $email */
        $email = Email::firstOrNew([
            'email' => $payload['email']
        ]);
        if ($email->exists) {
            $email->person()->update([
                'name' => $payload['name'],
                'lastName' => $payload['lastName'],
                'gender' => $payload['gender']
            ]);
        } else {
            $person = Person::create([
                'name' => $payload['name'],
                'lastName' => $payload['lastName'],
                'gender' => $payload['gender']
            ]);
            Email::create([
                'personId' => $person->id,
                'email' => $payload['email']
            ]);
        }
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
