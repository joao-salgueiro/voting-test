<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = ['poll_id', 'text'];

    public function poll()
    {
        return $this->belongsTo(Poll::class); ##Option belongs to Poll
    }

    public function votes()
    {
        return $this->hasMany(Vote::class); ##One option can have many Votes
    }
}
