<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['user_id'];

    public function selections()
    {
        return $this->hasMany(TeamSelection::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
