<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Attribut;
use App\Models\Attribut_link;
use App\Models\Caracteristique;
use App\Models\Catalogue;
use App\Models\Categorie;
use App\Models\Grille;
use App\Models\Item;
use App\Models\Items_Attribut_link;
use App\Models\Marque;
use App\Models\Mescollection;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ProduitsController extends Controller
{



    public function liste_produits() {
      
        $produits = Item::whereNull('parent_id')->where('user_id', Auth::id())->get();
        $categories = Categorie::whereNull('parent_id')->get();
        return view('admin.produits.liste_produits')
            ->with('categories', $categories)
            ->with('produits', $produits);
    }

    public function show($collection_id) {
        $collection = Mescollection::find($collection_id);
        $catalogue = Catalogue::find($collection->catalogue_id);

        $categorie = Categorie::find($catalogue->categorie_id);
        $line_cat = array();
        for ($i = 0; $i <= 3; $i++) {
            $line_cat[] = $categorie->name;
            if (!$categorie->parent_id) $i=3;            
            $categorie = Categorie::find($categorie->parent_id);

        } 
       
        return view('admin.collections.show')
            
            ->with('line_cat', $line_cat)
            ->with('collection', $collection);
    }



    public function liste() {
        $collections = Mescollection::where('user_id', Auth::id())->get();
        return view('admin.produits.liste_produits')->with('collections', $collections);
    }

    public function new($produit_id, Request $request) {
        
        if ($produit_id != 'new')   {
            $produit = Item::find($produit_id);
            
          
        } else {

            $produit = new Item();
            // $attributs_produit = new Collection([]);
          
        }


        $marques = Marque::all();
        $save_path =  'produits/'.Carbon::parse($produit->created_at)->format('Ym').'/'.Auth::id();
        $liste = Storage::disk('public')->files($save_path);

        $l = array();
        $l = [null,null,null];
        foreach ($liste as $key=>$file) {            
            $l[$key] = asset('storage/'.$file);
        }     
        
        $tarifs = Grille::where('item_id', $produit->id)->orderBy('order')->get();
        $articles = Item::where('parent_id', $produit->id)->get();
        
        
        $caracteristiques = Caracteristique::where('item_id', $produit->id)->get();
        $attributs = Attribut::whereNotIn('id', $caracteristiques->pluck('attribut_id'))->get();

        $categories = Categorie::getAllCategories();


        session()->flash('onglet','home');
       
        return view('admin.produits.create')
            ->with('articles',$articles)
            ->with('categories',$categories)
            ->with('caracteristiques',$caracteristiques)
            ->with('attributs',$attributs)
            ->with('tarifs',$tarifs)
            ->with('liste',$l)
            ->with('marques', $marques)
            ->with('produit', $produit);
    }

    public function create(Request $request) {
        if ($request->item_id) {
            $item = Item::find($request->item_id);            
        } else {
            $item = new Item();
        }
        $item->name = $request->name;
        $item->reference = $request->reference;
        $item->marque_id = $request->marque_id;
        $item->description = $request->description;
        $item->save();
        return redirect()->back()->with('onglet','home');
    }

    public function photos_save(Request $request) {
        $produit = Item::find($request->produit_id);
        $liste = array_values($request->file());


        foreach ($liste[0]  as $key=>$image) {
            // $originalName = $image->getClientOriginalName();
            $originalName = $key.'.jpg';
            // $img = Image::read(public_path('storage/'.Auth::user()->pathToAsset."source_logo-$request->store_id.$extension"));
            // $image->resize(100, 50);
            // $image->save(public_path('storage/'.Auth::user()->pathToAsset."logo-$request->store_id.$extension"));
    
            $save_path =  public_path('storage/produits/'.Carbon::parse($produit->created_at)->format('Ym').'/'.Auth::id());

            // dd($save_path);
            if (!file_exists($save_path)) {
                mkdir($save_path, 666, true);
            }
            $img = Image::read($image);
            $img->scale(400,400)->toJpeg()->save($save_path."/".$originalName);

        }
        
        return back()->with('onglet','photos');



    }

    public function add_caracteristique(Request $request) {
        $produit = Item::find($request->item);
        $car = new Caracteristique();
        $car->attribut_id = $request->attribut;
        $car->item_id = $request->item;
        $car->value = $request->valeur;
        $car->save();
        $caracteristiques = Caracteristique::where('item_id', $produit->id)->get();
        $attributs = Attribut::whereNotIn('id', $caracteristiques->pluck('attribut_id'))->get();
        return view('admin.produits.include.caracteristiques')
            ->with('attributs', $attributs)
            ->with('produit', $produit)
            ->with('caracteristiques', $caracteristiques);

    }

    public function add($produit_id) {
        $produit = Item::find($produit_id);
        if ($produit_id != 'new') {

        } else {
            $coll = new Mescollection();
            $coll->catalogue_id = $catalogue_id;
            $coll->ordre = 1;
            $coll->name = $catalogue->name;
            $coll->user_id = Auth::id();
            $coll->save();
        }

        return redirect()->route('admin.collections.liste');
    }

}
