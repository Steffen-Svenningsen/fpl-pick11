<?php

use App\Models\Player;
use App\Models\PlayerStat;
use Illuminate\Support\Facades\Http;

class FPLService
{
    public function fetchPlayers() {
        $data = Http::get('https://fantasy.premierleague.com/api/bootstrap-static/')->json();
        foreach ($data['elements'] as $player) {
            Player::updateOrCreate(
                ['fpl_id' => $player['id']],
                [
                    'name' => $player['web_name'],
                    'team' => $player['team'],
                    'position' => $player['element_type'],
                    'price' => $player['now_cost'] / 10,
                ]
            );
        }
    }

    public function fetchGameweekStats($gw) {
        $data = Http::get("https://fantasy.premierleague.com/api/event/$gw/live/")->json();
        foreach ($data['elements'] as $stat) {
            PlayerStat::updateOrCreate(
                [
                    'player_id' => $stat['id'],
                    'gameweek_id' => $gw
                ],
                [
                    'points' => $stat['stats']['total_points'],
                    'goals' => $stat['stats']['goals_scored'],
                    'assists' => $stat['stats']['assists'],
                    'minutes_played' => $stat['stats']['minutes'],
                    'price' => $stat['now_cost'] / 10
                ]
            );
        }
    }
}
