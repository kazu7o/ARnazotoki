<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'nazo_first, nazo_second, nazo_third, nazo_four, nazo_five'
    ];

    public function user()
    {
        return $this->belongTo('App\User');
    }
}

