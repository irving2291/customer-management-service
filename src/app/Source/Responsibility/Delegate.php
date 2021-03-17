<?php


namespace App\Source\Responsibility;


/**
 * @property bool main
 */
class Delegate extends \Illuminate\Database\Eloquent\Model
{
    protected $fillable = [
        'employeeAssignedId',
        'employeeAssigningId',
        'obligationId',
        'assignable_type',
        'assignable_id',
        'main'
    ];
}
