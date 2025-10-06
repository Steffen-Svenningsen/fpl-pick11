<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamSelection extends Model
{
    protected $fillable = ['team_id', 'gameweek_id', 'total_points', 'captain_id'];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function players()
    {
        return $this->hasMany(TeamPlayerSelection::class, 'team_selection_id')->with('player');
    }

    public function gameweek()
    {
        return $this->belongsTo(Gameweek::class);
    }

    public function captain()
    {
        return $this->belongsTo(Player::class, 'captain_id');
    }
}
