<?php

namespace App\Http\Controllers\FPL;

use App\Models\Team;
use App\Models\Player;
use App\Models\Gameweek;
use Illuminate\Http\Request;
use App\Models\TeamSelection;
use App\Models\TeamPlayerSelection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'gameweek_id' => 'required|exists:gameweeks,id',
            'players' => 'required|array|size:11',
            'captain_id' => 'required|exists:players,id',
        ]);

        $user = Auth::user();

        // Ensure user has a team
        $team = Team::firstOrCreate(['user_id' => $user->id]);

        // Create TeamSelection for this gameweek
        $selection = TeamSelection::create([
            'team_id' => $team->id,
            'gameweek_id' => $request->gameweek_id,
            'captain_id' => $request->captain_id,
        ]);

        // Attach players
        foreach ($request->players as $playerId) {
            TeamPlayerSelection::create([
                'team_selection_id' => $selection->id,
                'player_id' => $playerId,
                'is_captain' => $playerId == $request->captain_id,
            ]);
        }

        return response()->json(['message' => 'Team saved successfully']);
    }

    public function show($gameweekId)
    {
        $user = Auth::user();
        $team = Team::where('user_id', $user->id)->first();

        if (!$team) {
            return response()->json(['message' => 'Team not found'], 404);
        }

        $selection = TeamSelection::with('players.player')
            ->where('team_id', $team->id)
            ->where('gameweek_id', $gameweekId)
            ->first();

        if (!$selection) {
            return response()->json(['message' => 'Selection not found'], 404);
        }

        return response()->json($selection);
    }
}
