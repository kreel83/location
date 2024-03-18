<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    
    function index() {
        $stores = Auth::user()->stores;
        return view('admin.profil')
        ->with('stores', $stores ?? null);
    }

    function save(Request $request) {        

        $user = User::find(Auth::id());
        $user->civilite = $request->civilite;
        $user->prenom = $request->prenom;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->save();

        return back()->with('status', 'success')->with('msg', 'Votre profil a été mis à jour');

    }

}
