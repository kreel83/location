<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categorie;

class CategoriesController extends Controller
{
    public function index() {
        $categories = Categorie::getAllCategories();
        $cat = $categories->first();
        $attributs = $cat->attributs();
        
        return view('admin.categories.categories')
            ->with('attributs', $attributs)
            ->with('categories', $categories);
    }

    public function addCategorie(Request $request) {
        if (!$request->name) return ['status' => 'danger','message' => "Le texte n'est pas renseigné"];

        $cat = new Categorie();
        $cat->parent_id = $request->id;
        $cat->name = ucfirst($request->name);
        $cat->save();
        return ['status' => 'success','message' => "Catégorie ajoutée avec succès"];
    }
}
