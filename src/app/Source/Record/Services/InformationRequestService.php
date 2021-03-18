<?php


namespace App\Source\Record\Services;


use App\Source\Common\Email;
use App\Source\Common\Person;
use App\Source\Common\Status;
use App\Source\Common\Tracing;
use App\Source\Record\Archive;
use App\Source\Record\InformationRequest;
use App\Source\Record\Rules\InformationRequestRules;
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
            $person = $email->person;
        } else {
            $person = Person::create([
                'name' => $payload['name'],
                'lastName' => $payload['lastName'],
                'gender' => $payload['gender']
            ]);
            $email->personId = $person->id;
            $email->save();
        }

        /** @var InformationRequest $informationRequest */
        $informationRequest = InformationRequest::firstOrNew([
            'productId' => $payload['productId']
        ]);

        if ($informationRequest->exists) {
            $informationRequestRules = new InformationRequestRules($informationRequest);
            if ($informationRequestRules->eval(InformationRequestRules::LIFE_LAW)) {// it's in force
                $informationRequest->languageId = $payload['languageId'];
                $informationRequest->save();
                DelegateService::assignDelegateInformationRequestUnderResponsibility(3, $informationRequest->id);
            } else {
                $status = Status::where([
                    'entity_type' => InformationRequest::class,
                    'code' => 'NRQ'
                ])->first();
                self::addTracing(
                    $informationRequest->id,
                    $status->id,
                    auth()->id(),
                    $payload['message']?:'mensaje de texto por idioma'
                );
            }
        } else {
            $informationRequest = InformationRequest::create([
                'productId' => $payload['productId'],
                'languageId' => $payload['languageId']
            ]);
            // add delegate
            DelegateService::assignDelegateInformationRequestUnderResponsibility(3, $informationRequest->id);
        }

        //dd($informationRequest->archive->person);
        /** create archive */
        /** @var Archive $archive */
        $archive = Archive::firstOrNew([
            'personId' => $person->id,
            'file_type' => InformationRequest::class,
            'file_id' => $informationRequest->id
        ]);
        if (!$archive->exists) {
            $archive->save();
        }
        return [
            'informationRequest' => $informationRequest,
            'currentDelegate' => $informationRequest->currentDelegate
        ];
    }

    public static function addTracing($informationRequestId, $statusId, $userId, $message)
    {
        Tracing::create([
            'message' => $message,
            'statusId' => $statusId,
            'userId' => $userId,
            'traceable_type' => InformationRequest::class,
            'traceable_id' => $informationRequestId
        ]);
    }
}
