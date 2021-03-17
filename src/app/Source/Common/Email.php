<?php


namespace App\Source\Common;


/**
 * Class Email
 * @package App\Source\Common
 * @property Person person
 * @property int personId
 * @method static create(array $array)
 * @method static firstOrNew(array $array)
 */
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
