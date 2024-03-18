<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function chercheCategorie() {
        return self::join('App\Models\Items_Attribut_link','item_id','id')
            ->join('App\Models\Attribut_link','attribut_links_id','id')
            ->join('App\Models\Categorie','parent_id','id')->where('parent_type','categorie')
            ->where('items_Attribut_links.items_id', $this->id)
            ->get('Items_Attribut_link.id');
    }

    public function collection() {
        return $this->belongsTo('App\Models\Mescollection','mescollection_id','id');
    }
}
