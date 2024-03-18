<?php

namespace App\Http\Controllers;

use App\Models\Citie;
use App\Models\JoursFerie;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{

    function importCities() {
        // https://geo.api.gouv.fr/decoupage-administratif/communes#advanced
        Citie::truncate();
        // génère la chaine des départements a copier-coller      
        // $s = array();
        // for($i=1; $i<=95; $i++) {
        //     $s[] = str_pad($i, 2, '0', STR_PAD_LEFT);
        // }
        // $s = implode(',', $s);
        // dd($s);
        $str = '01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,2A,2B,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,971,972,973,974,976';
        $codesPostaux = explode(',', $str);
        foreach($codesPostaux as $cp) {
            $url = "https://geo.api.gouv.fr/departements/$cp/communes";
            $result = file_get_contents($url);
            $result = json_decode($result, true);
            foreach($result as $ville) {
                Citie::create([
                    'nom' => $ville['nom'],
                    'code' => $ville['code'],
                    'code_departement' => $ville['codeDepartement'],
                    'siren' => $ville['siren'],
                    'code_epci' => $ville['codeEpci'] ?? null,
                    'code_region' => $ville['codeRegion'],
                    'code_postal' => $ville['codesPostaux'][0],
                ]);
            }
        }
    }

    // function importCities() {

    //     $file = fopen(public_path('cities.csv'), 'r');
    //     $header = fgetcsv($file);
    //     while (($row = fgetcsv($file)) !== false) {
    //        Citie::create(array_combine($header, $row)); 
    //      } 
    //     fclose($file);
    // }

    function importJoursFeries() {
        // https://api.gouv.fr/documentation/jours-feries
        $str = 'metropole,alsace-moselle,guadeloupe,guyane,la-reunion,martinique,mayotte,nouvelle-caledonie,polynesie-francaise,saint-barthelemy,saint-martin,saint-pierre-et-miquelon,wallis-et-futuna';
        $zones = explode(',', $str);
        for ($annee=2024; $annee <= 2026 ; $annee++) {
            $check = JoursFerie::whereYear('day', $annee)->first();
            if(!$check) {
                foreach($zones as $zone) {
                    $url = "https://calendrier.api.gouv.fr/jours-feries/$zone/$annee.json";
                    $result = file_get_contents($url);
                    $result = json_decode($result, true);
                    //dd($result);
                    foreach($result as $jf => $name) {
                        JoursFerie::create([
                            'zone' => $zone,
                            'day' => $jf,
                            'name' => $name,
                        ]);
                    }
                }
            }
        }
    }

}
