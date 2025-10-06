<?php

namespace App\Http\Controllers\FPL;

use App\Models\Gameweek;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GameweekController extends Controller
{
    public function index()
    {
        // Return all gameweeks
        return response()->json(Gameweek::orderBy('number')->get());
    }
}
