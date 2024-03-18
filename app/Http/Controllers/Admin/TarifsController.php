<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Grille;
use App\Models\Item;
use App\Models\Mescollection;

class TarifsController extends Controller
{
    public function index($id) {
        if ($id) {
            $collection = Mescollection::find($id);
            $tarifs = Grille::where('mescollection_id', $id)->orderBy('order')->get();
        }
        return view('admin.grilles.tarifs')->with('tarifs', $tarifs)->with('collection',$collection);
    }

    public function addTarif(Request $request) {
        $item = Item::find($request->item);
        if ($item) {
            $last_tarif = Grille::where('item_id', $request->item)->orderBy('order','DESC')->first();
            $pos = ($last_tarif) ? ($last_tarif->order + 1) : 1;
            $new = new Grille();
            $new->order = $pos;
            $new->item_id = $request->item;
            $new->nb_jour = $request->nb_jour;
            $new->tarif = $request->tarif;
            $new->save();
            return 'ok';
        }
        return 'ko';
    }

    public function deleteTarif(Request $request) {
        $search = Grille::find($request->grille_id);
        $id = $search->item_id;
        if ($search) $search->delete();
        return redirect()->route('admin.tarifs',['id' => $request->id]);

    }
}
