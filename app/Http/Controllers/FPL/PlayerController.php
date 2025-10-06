<?php

namespace App\Http\Controllers\FPL;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class PlayerController extends Controller
{
    public function index()
    {
        $cacheKey = 'fpl_players';

        $data = Cache::remember($cacheKey, 60 * 60, function () {
            $response = Http::get('https://fantasy.premierleague.com/api/bootstrap-static/');

            if ($response->failed()) {
                return null;
            }

            return $response->json();
        });

        if (!$data) {
            return response()->json(['error' => 'Failed to fetch data'], 500);
        }

        $players = collect($data['elements'])->map(function ($player) use ($data) {
            return [
                'id' => $player['id'],
                'name' => $player['web_name'],
                'first_name' => $player['first_name'],
                'second_name' => $player['second_name'],
                'full_name' => $player['first_name'] . ' ' . $player['second_name'],
                'team' => collect($data['teams'])->firstWhere('id', $player['team'])['name'] ?? null,
                'position' => match ($player['element_type']) {
                    1 => 'GK',
                    2 => 'DEF',
                    3 => 'MID',
                    4 => 'FWD',
                },
                'price' => $player['now_cost'] / 10,
                'points' => $player['total_points'],
            ];
        });

        return response()->json($players->values());
    }
}
