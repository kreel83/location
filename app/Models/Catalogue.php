<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Catalogue extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getvalue($id) {
        $link = Catalogues_Attribut_link::where('catalogue_id', $this->id)->where('attribut_link_id', $id)->first();
       
        return $link ? $link->value : null;

    }

    public function already_choose() {
        $search = Mescollection::where('user_id', Auth::id())->where('catalogue_id', $this->id)->first();
        return $search ? true : false;
    }
}
