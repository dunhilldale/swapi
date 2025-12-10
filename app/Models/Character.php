<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Character extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'gender',
        'birth_year',
        'height',
        'mass'
    ];

    public static function getByName($name)
    {
        return Character::where('name', 'like', "%{$name}%")->take(3)->get();
    }
}
