<?php


namespace App\Source\Record;


use App\Source\Common\Person;

/**
 * Class Archive
 * @package App\Source\Record
 * @method static firstOrNew(array $array)
 * @property Person person
 */
class Archive extends \Illuminate\Database\Eloquent\Model
{
    protected $fillable = [
        'personId',
        'file_type',
        'file_id'
    ];

    public function person()
    {
        return $this->belongsTo(Person::class, 'personId');
    }
}
