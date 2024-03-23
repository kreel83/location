<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use DOMDocument;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    
    public function index() {
        return view('front.welcome');
    }

    public function livesearch(Request $request) {
        $livesearch = Categorie::where('name', 'like', "%{$request->q}%")->get();
        $hint = "";
        foreach ($livesearch as $result) {
            if ($hint=="") {
                $hint = '<a class="res" data-categorie_id="'.$result->id.'" href="#">'.$result->name.'</a>';
            } else {
                $hint = $hint . '<br /><a class="res" data-categorie_id="'.$result->id.'" href="#">'.$result->name.'</a>';
            }
        }
        if ($hint == '') {
            $response = "Aucun résultat.";
        } else {
            $response=$hint;
        }
        echo $response;
    }

    public function search(Request $request) {
        //dd($request);
        if($request->categorie_id) {
            $categorie = Categorie::find($request->categorie_id);
            return redirect()->route('front.afficheCategorie', ['categorie_link_rewrite' => $categorie->link_rewrite]);
        }
    }

}
