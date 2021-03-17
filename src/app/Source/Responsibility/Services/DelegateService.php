<?php


namespace App\Source\Responsibility\Services;


use App\Source\Record\InformationRequest;
use App\Source\Responsibility\Delegate;
use App\Source\Responsibility\Obligation;

class DelegateService
{
    public static function assign(
        $employeeAssignedId,
        $employeeAssigningId,
        $obligationId,
        $assignable_type,
        $assignable_id
    )
    {
        /** @var Delegate $delegate */
        $delegate = Delegate::firstOrNew([
            'employeeAssignedId' => $employeeAssignedId,
            'employeeAssigningId' => $employeeAssigningId,
            'obligationId' => $obligationId,
            'assignable_type' => $assignable_type,
            'assignable_id' => $assignable_id,
            'main' => 1
        ]);

        if (!$delegate->exists) {
            $delegate->save();
        } else {
            $delegate->update(['main' => false]);
            $delegate = Delegate::create([
                'employeeAssignedId' => $employeeAssignedId,
                'employeeAssigningId' => $employeeAssigningId,
                'obligationId' => $obligationId,
                'assignable_type' => $assignable_type,
                'assignable_id' => $assignable_id,
                'main' => true
            ]);
        }

        return $delegate;
    }

    public static function assignDelegateUnderResponsibility(
        $employeeAssignedId,
        $obligationId,
        $assignable_type,
        $assignable_id
    )
    {

        return self::assign($employeeAssignedId, auth()->user()->employee->id, $obligationId, $assignable_type, $assignable_id);
    }

    public static function assignDelegateInformationRequestUnderResponsibility(
        $employeeAssignedId,
        $assignable_id
    )
    {
        $obligation = Obligation::where(['code' => 'VNT'])->first();
        return self::assignDelegateUnderResponsibility($employeeAssignedId, $obligation->id, InformationRequest::class, $assignable_id);
    }

    public function delegateDealer()
    {
        // calendar
    }
}
