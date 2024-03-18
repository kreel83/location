<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Attribut;
use App\Models\Attribut_link;
use App\Models\Categorie;
use App\Models\Grille;
use App\Models\Item;
use App\Models\Items_Attribut_link;
use App\Models\Marque;
use App\Models\Mescollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class ProduitsController extends Controller
{
    public function show($produit_id) {
        $produit = Item::find($produit_id);
        dd($produit->collection->first());
        return view('admin.produits.show')
            
            ->with('produit', $produit);
    }



    public function liste_produits($collection_id) {
        $collection = Mescollection::find($collection_id);
        $produits = Item::where('mescollection_id', $collection_id)->get();
        return view('admin.produits.liste_produits')->with('collection', $collection)->with('produits', $produits);
    }

}
