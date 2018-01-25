<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [
        'job_title',
        'role',
        'practice_id',
        'description',
        'start_time',
        'end_time',
        'price',
        'is_permanent'
    ];
    protected $dates = ['start_time', 'end_time'];
    protected $casts = ['is_permanent'];

    public function setIsPermanentMutator($value)
    {
        $this->attributes['is_permanent'] = (boolean)$value;
    }

    public function getPermanent()
    {
        return self::where('is_permanent', 'true')->get();
    }
}
