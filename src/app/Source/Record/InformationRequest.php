<?php


namespace App\Source\Record;


use App\Source\Responsibility\Delegate;

/**
 * @method static firstOrNew(array $array)
 * @method static create(array $array)
 * @property int id
 * @property Archive archive
 * @property Delegate currentDelegate
 * @property int languageId
 * @property string created_at
 */
class InformationRequest extends \Illuminate\Database\Eloquent\Model
{
    protected $fillable = ['productId', 'languageId'];
    protected $appends = ['person'];

    public function currentDelegate()
    {
        return $this->morphOne(Delegate::class, 'assignable')->where(['main' => true]);
    }

    public function archive()
    {
        return $this->morphOne(Archive::class, 'file');
    }

    public function getPersonAttribute()
    {
        return $this->archive()->first()->person;
    }

}
