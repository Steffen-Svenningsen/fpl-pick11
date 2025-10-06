<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = [
        'fpl_id', 'name', 'team', 'position', 'price'
    ];

    public function stats()
    {
        return $this->hasMany(PlayerStat::class);
    }
}
