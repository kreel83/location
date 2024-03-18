<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{


    public function coucou2() {
        return('coucou2');
    }

    public function index() {
        $stores = Auth::user()->stores;
        if(is_null($stores)) {
            return view('admin.profil')
                ->with('stores', $stores ?? null);
        } else {
            return view('admin.index');
        }        
    }

}
