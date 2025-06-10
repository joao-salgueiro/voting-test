<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = ['option_id'];

    public function option()
    {
        return $this->belongsTo(Option::class); ##Option belongs to Vote
    }
}
