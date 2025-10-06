<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamPlayerSelection extends Model
{
    protected $fillable = ['team_selection_id', 'player_id', 'is_captain', 'points'];

    public function teamSelection()
    {
        return $this->belongsTo(TeamSelection::class, 'team_selection_id');
    }

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
