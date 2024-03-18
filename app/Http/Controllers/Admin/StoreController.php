<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JoursFerie;
use App\Models\Store;
use App\Models\StoreJoursFerie;
use App\Models\StoreUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Laravel\Facades\Image;

class StoreController extends Controller
{
    
    public function editCoordonnees($store_id) {
        $store = Store::find($store_id);
        $joursFeries = $store->joursFeries ?? null;
        $zones = JoursFerie::select('zone')->groupBy('zone')->get();
        $now = Carbon::now();
        // on remet a zero les dates de fermetures si dépassées...
        if($store) {

            if(!is_null($store->conges_end)) {
                $madate = new Carbon($store->conges_end);
                if($madate->lt($now)) {
                    $store->conges_start = null;
                    $store->conges_end = null;
                    $store->save();
                }
            }
        
            if(is_null($store->jours_ferie_zone)) {
                //$zones = JoursFerie::select('zone')->groupBy('zone')->get();
                $joursFeriesAnneeEnCours = null;
                $joursFeriesAnneeSuivante = null;
            } else {
                //$zones = null;
                $joursFeriesAnneeEnCours = JoursFerie::whereDate('day', '>=', $now)->where('zone', $store->jours_ferie_zone)->whereYear('day', $now->year)->get();
                $joursFeriesAnneeSuivante = JoursFerie::where('zone', $store->jours_ferie_zone)->whereYear('day', $now->year + 1)->get();
            }
        }

        return view('admin.store.edit-coordonnees')
            ->with('menuActive', 'coordonnees')
            ->with('store', $store)
            ->with('joursFeries', $joursFeries)
            ->with('joursFeriesAnneeEnCours', $joursFeriesAnneeEnCours ?? null)
            ->with('joursFeriesAnneeSuivante', $joursFeriesAnneeSuivante ?? null)
            ->with('zones', $zones);
    }

    // public function edit($store_id) {
    //     $store = Store::find($store_id);
    //     $joursFeries = $store->joursFeries ?? null;
    //     $zones = JoursFerie::select('zone')->groupBy('zone')->get();
    //     $now = Carbon::now();
    //     // on remet a zero les dates de fermetures si dépassées...
    //     if($store) {

    //         if(!is_null($store->conges_end)) {
    //             $madate = new Carbon($store->conges_end);
    //             if($madate->lt($now)) {
    //                 $store->conges_start = null;
    //                 $store->conges_end = null;
    //                 $store->save();
    //             }
    //         }
        
    //         if(is_null($store->jours_ferie_zone)) {
    //             //$zones = JoursFerie::select('zone')->groupBy('zone')->get();
    //             $joursFeriesAnneeEnCours = null;
    //             $joursFeriesAnneeSuivante = null;
    //         } else {
    //             //$zones = null;
    //             $joursFeriesAnneeEnCours = JoursFerie::whereDate('day', '>=', $now)->where('zone', $store->jours_ferie_zone)->whereYear('day', $now->year)->get();
    //             $joursFeriesAnneeSuivante = JoursFerie::where('zone', $store->jours_ferie_zone)->whereYear('day', $now->year + 1)->get();
    //         }
    //     }

    //     return view('admin.store.edit')
    //         ->with('store', $store)
    //         ->with('joursFeries', $joursFeries)
    //         ->with('joursFeriesAnneeEnCours', $joursFeriesAnneeEnCours ?? null)
    //         ->with('joursFeriesAnneeSuivante', $joursFeriesAnneeSuivante ?? null)
    //         ->with('zones', $zones);
    // }

    // public function save(Request $request) {
    public function saveCoordonnees(Request $request) {

        $adresse = urlencode($request['adresse1_address-search']);
        $cp = urlencode($request->cp);
        $url = "https://api-adresse.data.gouv.fr/search/?q=$adresse&postcode=$cp";
        $result = file_get_contents($url);
        $result = json_decode($result);

        if(count($result->features) > 0) {
            $latitude = $result->features[0]->geometry->coordinates[0];
            $longitude = $result->features[0]->geometry->coordinates[1];
            $code_ville = $result->features[0]->properties->citycode;
        }

        $store = Store::updateOrCreate(
            ['id' => $request->store_id],
            [
                'name' => $request->store_name,
                'adresse1' => $request['adresse1_address-search'],
                'adresse2' => $request->adresse2,
                'cp' => $request->cp,
                'ville' => $request->ville,
                'phone' => $request->store_phone,
                'email' => $request->store_email,
                'url' => $request->store_url,
                'code_ville' => $code_ville ?? null,
                'latitude' => $latitude ?? null,
                'longitude' => $longitude ?? null,
                // 'jours_ferie_zone' => $request->zone,
            ]
        );

        StoreUser::firstOrCreate(['user_id' => Auth::id(), 'store_id' => $store->id]);

        $request->session()->flash('status', 'success');
        $request->session()->flash('msg', 'Votre établissement a été mis à jour');

        return redirect()->route('admin.store.edit.coordonnees', ['store_id' => $store->id]);

    }

    public function logo(Request $request) {
        $request->validate([
            'store_id' => 'required',
            'file_upload' => 'required|mimes:gif,jpg,png|max:512',
        ]);

        // sauvegarde du logo envoyé comme original si besoin de refaire une miniature plus tard
        $extension = $request->file('file_upload')->extension();
        $request->file('file_upload')->storeAs('/public'.'/'.Auth::user()->pathToAsset, "source_logo-$request->store_id.$extension");

        // https://image.intervention.io/
        $image = Image::read(public_path('storage/'.Auth::user()->pathToAsset."source_logo-$request->store_id.$extension"));
        $image->resize(100, 50);
        $image->save(public_path('storage/'.Auth::user()->pathToAsset."logo-$request->store_id.$extension"));

        $store = Store::find($request->store_id);
        if($store) {
            $store->logo = "logo-$request->store_id.$extension";
            $store->save();
        }

        return back()->with('status', 'success')->with('msg', 'Votre logo a été mis à jour');

    }

    public function removeLogo($store_id) {
        $store = Store::find($store_id);
        if($store) {
            unlink(storage_path('app/public/'.Auth::user()->pathToAsset.$store->logo));
            unlink(storage_path('app/public/'.Auth::user()->pathToAsset.'source_'.$store->logo));
            $store->logo = null;
            $store->save();
            return back()->with('status', 'success')->with('msg', 'Le logo a été supprimé');
        }
        return back()->with('status', 'danger')->with('msg', 'Une erreur est survenue');
    }

    public function storeZone(Request $request) {
        $store = Store::find($request->store_id);
        if($store) {
            $store->jours_ferie_zone = $request->zone;
            $store->save();
            return back()->with('status', 'success')->with('msg', 'La zone a été sauvegardé');
        }
        return back()->with('status', 'danger')->with('msg', 'Une erreur est survenue');
    }

    public function storeConges(Request $request) {
        $store = Store::find($request->store_id);
        if($store) {
            $store->conges_start = $request->conges_start;
            $store->conges_end = $request->conges_end;
            $store->save();

            StoreJoursFerie::where('store_id', $request->store_id)->delete();

            if($request->jf) {
                foreach ($request->jf as $jourFerie) {
                    StoreJoursFerie::create([
                        'jours_ferie_id' => $jourFerie,
                        'store_id' => $request->store_id,
                    ]);
                }
            }

            return back()->with('status', 'success')->with('msg', 'Les jours de fermeture ont été mis à jour');
        }
        return back()->with('status', 'danger')->with('msg', 'Une erreur est survenue');
        
    }

    public function editConges($store_id) {
        $store = Store::find($store_id);
        $joursFeries = $store->joursFeries ?? null;
        $zones = JoursFerie::select('zone')->groupBy('zone')->get();
        $now = Carbon::now();
        // on remet a zero les dates de fermetures si dépassées...
        if($store) {

            if(!is_null($store->conges_end)) {
                $madate = new Carbon($store->conges_end);
                if($madate->lt($now)) {
                    $store->conges_start = null;
                    $store->conges_end = null;
                    $store->save();
                }
            }
        
            if(is_null($store->jours_ferie_zone)) {
                //$zones = JoursFerie::select('zone')->groupBy('zone')->get();
                $joursFeriesAnneeEnCours = null;
                $joursFeriesAnneeSuivante = null;
            } else {
                //$zones = null;
                $joursFeriesAnneeEnCours = JoursFerie::whereDate('day', '>=', $now)->where('zone', $store->jours_ferie_zone)->whereYear('day', $now->year)->get();
                $joursFeriesAnneeSuivante = JoursFerie::where('zone', $store->jours_ferie_zone)->whereYear('day', $now->year + 1)->get();
            }
        }

        return view('admin.store.edit-conges')
            ->with('menuActive', 'conges')
            ->with('store', $store)
            ->with('joursFeries', $joursFeries)
            ->with('joursFeriesAnneeEnCours', $joursFeriesAnneeEnCours ?? null)
            ->with('joursFeriesAnneeSuivante', $joursFeriesAnneeSuivante ?? null)
            ->with('zones', $zones);
    }

    public function editLogo($store_id) {
        $store = Store::find($store_id);
        return view('admin.store.edit-logo')
            ->with('menuActive', 'logo')
            ->with('store', $store);
    }

    public function editHoraires($store_id) {
        $store = Store::find($store_id);
        $jours = ['1' => 'Lundi', '2' => 'Mardi', '3' => 'Mercredi', '4' => 'Jeudi', '5' => 'Vendredi', '6' => 'Samedi', '7' => 'Dimanche'];
        $horaires = json_decode($store->horaires, true);
        //dd($horaires);
        return view('admin.store.edit-horaires')
            ->with('menuActive', 'horaires')
            ->with('jours', $jours)
            ->with('horaires', $horaires)
            ->with('store', $store);
    }

    public function storeHoraires(Request $request) {
        $store = Store::find($request->store_id);
        if($store) {
            $horaires = [
                '1' => $request->h1, 
                '2' => $request->h2, 
                '3' => $request->h3, 
                '4' => $request->h4, 
                '5' => $request->h5, 
                '6' => $request->h6, 
                '7' => $request->h7
            ];
            //dd($horaires);
            $store->horaires = $horaires;
            $store->save();
            return back()->with('status', 'success')->with('msg', 'Les horaires ont été mis à jour');
        }
        return back()->with('status', 'danger')->with('msg', 'Une erreur est survenue');
    }

    public function saveJuridique(Request $request) {
        $store = Store::find($request->store_id);
        if($store) {
            $store->siret = $request->store_siret;
            $store->naf = $request->store_naf;
            $store->date_creation = $request->store_creation;
            $store->effectif = $request->store_effectif;
            $store->save();

            $request->session()->flash('status', 'success');
            $request->session()->flash('msg', 'Les informations juridiques ont été mises à jour');

            return redirect()->route('admin.store.edit.coordonnees', ['store_id' => $store->id]);
        }
        return back()->with('status', 'danger')->with('msg', 'Une erreur est survenue');
    }

    public function editSocial($store_id) {
        $store = Store::find($store_id);
        return view('admin.store.edit-social')
            ->with('menuActive', 'social')
            ->with('store', $store);
    }

    public function storeSocial(Request $request) {
        $store = Store::find($request->store_id);
        if($store) {
            $store->instagram = $request->store_instagram;
            $store->linkedin = $request->store_linkedin;
            $store->facebook = $request->store_facebook;
            $store->pinterest = $request->store_pinterest;
            $store->save();
            return back()->with('status', 'success')->with('msg', 'Les réseaux sociaux ont été mis à jour');
        }
        return back()->with('status', 'danger')->with('msg', 'Une erreur est survenue');
    }

    public function editPhotos($store_id) {
        $store = Store::find($store_id);
        return view('admin.store.edit-photos')
            ->with('menuActive', 'photos')
            ->with('store', $store);
    }

    public function editInfos($store_id) {
        $store = Store::find($store_id);
        return view('admin.store.edit-infos')
            ->with('menuActive', 'infos')
            ->with('store', $store);
    }

    public function storeInfos(Request $request) {
        $store = Store::find($request->store_id);
        if($store) {
            $store->description = $request->store_description;
            $store->save();
            return back()->with('status', 'success')->with('msg', 'Les informations ont été mises à jour');
        }
        return back()->with('status', 'danger')->with('msg', 'Une erreur est survenue');
    }

}
