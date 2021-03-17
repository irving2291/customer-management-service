<?php


namespace App\Source\Common;


use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @property int id
 */
class Person extends Model
{
    protected $fillable = [
        'name',
        'lastName',
        'gender'
    ];
}
