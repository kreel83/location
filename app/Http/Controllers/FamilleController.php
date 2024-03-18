<?php

namespace App\Http\Controllers;

use App\Models\Famille;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FamilleController extends Controller
{
    public function index(Request $request) {
        $familles = Famille::where('user_id', Auth::id())->get();
        return view('.admin.familles.index')->with('familles', $familles);
    }
}
