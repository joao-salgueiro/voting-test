<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $fillable = ['title', 'start', 'end'];

    public function options()
    {
        return $this->hasMany(Option::class); ## One poll can have many options
    }

    // protected $casts = [
    //     'start' => 'datetime',
    //     'end' => 'datetime',
    // ];
}