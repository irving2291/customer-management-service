<?php


namespace App\Source\Common;


class Email extends \Illuminate\Database\Eloquent\Model
{
    protected $fillable = [
        'email',
        'personId'
    ];

    public function person()
    {
        return $this->belongsTo(Person::class, 'personId');
    }
}
