<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Practice extends Model
{
    protected $table = 'practice';

    public static $values = [
        'Acute internal medicine',
        'Allergy',
        'Audiovestibular medicine',
        'Aviation and space medicine',
        'Cardiology',
        'Clinical genetics',
        'Dermatology'
    ];
}
