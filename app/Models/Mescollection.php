<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mescollection extends Model
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

    public function getvalue($id) {
        $link = Collections_Attribut_link::where('mescollection_id', $this->id)->where('attribut_link_id', $id)->first();
        return $link ? $link->value : null;

    }

    public function catalogue() {
        return $this->belongsTo('App\Models\Catalogue');
    }
}
