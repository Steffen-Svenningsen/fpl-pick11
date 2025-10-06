<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerStat extends Model
{
    protected $fillable = [
        'player_id', 'gameweek_id', 'points', 'minutes_played', 'goals_scored', 'assists', 'clean_sheets', 'yellow_cards', 'red_cards'
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function gameweek()
    {
        return $this->belongsTo(Gameweek::class);
    }
}
