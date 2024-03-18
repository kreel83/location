<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index() {
        dd(Auth::user());
        return view('welcome');
        dd('coouco');
       
        if (Auth::user()->adresse) {

        } else {
            return view('create_user');
        }
    }
}
