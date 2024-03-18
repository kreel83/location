<?php

namespace App\Http\Controllers;

use App\Models\Attribut;
use App\Models\Attribut_link;
use App\Models\Catalogue;
use App\Models\Catalogues_Attribut_link;
use App\Models\Categorie;
use App\Models\Collections_Attribut_link;
use App\Models\Item;
use App\Models\Items_Attribut_link;
use App\Models\Mescollection;
use App\Models\Marque;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class CatalogueController extends Controller
{
    public function catalogue() {
      
        $catalogues = Catalogue::all();
        $categories = Categorie::whereNull('parent_id')->get();
        return view('admin.catalogue.liste')
            ->with('categories', $categories)
            ->with('catalogues', $catalogues);
    }

    public function new($catalogue_id, Request $request) {
        
        if ($catalogue_id != 'new')   {
            $catalogue = Catalogue::find($catalogue_id);
            $attributs_cat = Attribut_link::where('parent_id', $catalogue->categorie_id)->where('parent_type','categorie')->get();
            $attributs_produit = Attribut_link::where('parent_id', $catalogue->id)->where('parent_type','catalogue')->get();
          
        } else {

            $catalogue = new Catalogue();
            $attributs_produit = new Collection([]);
          
        }

        if ($request->categorie_id) {
            $categorie = Categorie::find($request->categorie_id);
            $attributs_cat = Attribut_link::where('parent_id', $request->categorie_id)->where('parent_type','categorie')->get();
            $categorie_id = $request->categorie_id;
        } else {
            $categorie = Categorie::find($catalogue->categorie_id);
            $categorie_id = $catalogue->categorie_id;
        }



        $categories = Categorie::whereNull('parent_id')->get();
        $marques = Marque::all();
        
        $attributs_reste = $attributs_cat->pluck('attribut_id');
        $attributs_produit_reste = $attributs_produit->pluck('attribut_id');
        $attributs_reste = $attributs_reste->merge($attributs_produit_reste);
        
        $attributs_liste = Attribut::whereNotIn('id', $attributs_reste)->get();

        
        
        
        return view('admin.catalogue.create')
            ->with('attributs_cat', $attributs_cat)
            ->with('attributs_produit', $attributs_produit)
            ->with('categorie', $categorie)
            ->with('categories', $categories)
            ->with('marques', $marques)
            ->with('attributs_liste', $attributs_liste)
            ->with('catalogue', $catalogue);
    }

    public function photos($collection_id) {
        $collection = Mescollection::find($collection_id);
        // $save_path =  public_path('storage/produits/'.Carbon::parse($collection->created_at)->format('Ym').'/'.Auth::id());
        $save_path =  'produits/'.Carbon::parse($collection->created_at)->format('Ym').'/'.Auth::id();
        $liste = Storage::disk('public')->files($save_path);

        $l = array();
        $l = [null,null,null];
        foreach ($liste as $key=>$file) {
            
            $l[$key] = asset('storage/'.$file);
        } 
        

        
        return view('admin.collections.photos')
            ->with('collection', $collection)
            ->with('liste',$l)
            ;
    }

    public function create(Request $request) {

        $attributs = $request->only('attribut');
        $p = $request->except(['_token','attribut','id']);
        // $p['user_id'] = Auth::id();
        if ($request->id) {
            $catalogue = Catalogue::find($request->id);
            $catalogue->update($p);
            $id = $catalogue->id;
        } else {
            $catalogue = new Catalogue();
            $id = $catalogue->create($p)->id;
        }
        
        



        if (isset($attributs['attribut']['categorie'])) {
            foreach ($attributs['attribut']['categorie'] as $key=>$value) {
                $link = Attribut_link::where('attribut_id', $key)->where('parent_id', $id)->where('parent_type', 'categorie')->first();            
                if (!$link) {
                    
                    $link = new Attribut_link();
                    $link->attribut_id = $key;
                    $link->parent_type = "categorie";
                    $link->parent_id = $id;
                    $link->save();

                }
                if ($value) {

                    $a = Attribut_link::find($link->id);               
                    $v = Catalogues_Attribut_link::where('attribut_link_id', $a->id)->first();
                    
                    if ($v) {
                        $v->value = $value;
                    } else {
                        $v = new Catalogues_Attribut_link();
                        $v->value = $value;
                        $v->attribut_link_id = $a->id;                              
                    }
                    $v->save();                
                }


            }            
        }
        
        
        if (isset($attributs['attribut']['catalogue'])) {
            foreach ($attributs['attribut']['catalogue'] as $key=>$value) {
                
                $link = Attribut_link::where('attribut_id', $key)->where('parent_id', $id)->where('parent_type', 'catalogue')->first();
                if (!$link) {
                    
                    $link = new Attribut_link();
                    $link->attribut_id = $key;
                    $link->parent_type = "catalogue";
                    $link->parent_id = $id;
                    
                    $link->save();
    
                }
                
                if ($value) {
                    $a = Attribut_link::find($link->id);               
                    $v = Catalogues_Attribut_link::where('attribut_link_id', $a->id)->first();
                    
                    if ($v) {
                        $v->value = $value;
                    } else {
                        $v = new Catalogues_Attribut_link();
                        $v->value = $value;
                        $v->attribut_link_id = $a->id;                              
                    }
                    $v->save();                
                }
    
    
            }
        }




       
        return redirect()->route('admin.catalogue.new',['catalogue_id' => $id]);

    }

    public function photos_save(Request $request) {
        $collection = Mescollection::find($request->collection_id);
        $liste = array_values($request->file());


        foreach ($liste[0]  as $key=>$image) {
            // $originalName = $image->getClientOriginalName();
            $originalName = $key.'.jpg';
            // $img = Image::read(public_path('storage/'.Auth::user()->pathToAsset."source_logo-$request->store_id.$extension"));
            // $image->resize(100, 50);
            // $image->save(public_path('storage/'.Auth::user()->pathToAsset."logo-$request->store_id.$extension"));
    
            $save_path =  public_path('storage/produits/'.Carbon::parse($collection->created_at)->format('Ym').'/'.Auth::id());

            // dd($save_path);
            if (!file_exists($save_path)) {
                mkdir($save_path, 666, true);
            }
            $img = Image::read($image);
            $img->scale(400,400)->toJpeg()->save($save_path."/".$originalName);



 
        }
        
        return redirect()->route('admin.collections.photos',['collection_id' => $collection->id]);



    }

    public function choixAttribut(Request $request) {
        
        if ($request->catalogue) {
            $catalogue = Catalogue::find($request->catalogue);
        } else {
            $catalogue = new Catalogue();
        }
        $attribut= Attribut::find($request->attribut);
       
        return view('admin.catalogue.attribut')->with('attribut', $attribut)->with('catalogue', $catalogue); 
        // $link = new Attribut_link();
        // $link->attribut_id = $request->attribut;
        // $link->parent_type = "produit";
        // $link->parent_id = $request->produit;
        // $link->save();
        // return "ok";
    }

    public function add_produits(Request $request) {
        $collection = Mescollection::find($request->collection);
        for ($i = 1; $i <= $request->nb; $i++) {
            $item = new Item();
            $item->mescollection_id = $collection->id;
            $item->name = $collection->name.' - '.$i;
            $item->save();

        }
        return redirect()->route('admin.collections.new',['collection_id' => $collection->id]);
    }

   
}
