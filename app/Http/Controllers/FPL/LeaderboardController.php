<?php

namespace App\Http\Controllers\FPL;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TeamSelection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class LeaderboardController extends Controller
{
    public function index()
    {
        $leaderboard = User::select('users.id', 'users.name', DB::raw('SUM(team_selections.total_points) as total_score'))
            ->join('teams', 'teams.user_id', '=', 'users.id')
            ->join('team_selections', 'team_selections.team_id', '=', 'teams.id')
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('total_score')
            ->limit(10)
            ->get();

        return response()->json($leaderboard);
    }
}
