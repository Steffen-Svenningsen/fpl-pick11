<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gameweek extends Model
{
    protected $fillable = [
        'number', 'start_date', 'end_date', 'is_active'
    ];

    public function playerStats()
    {
        return $this->hasMany(PlayerStat::class);
    }
}
