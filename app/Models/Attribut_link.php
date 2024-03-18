<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribut_link extends Model
{
    use HasFactory;

    public function attribut() {
        return $this->belongsTo('App\Models\Attribut');
    }

    public function getvalue() {
        $search = Catalogues_Attribut_link::where('attribut_link_id', $this->id)->first();
        return ($search) ? $search->value : null;

        // p = Catalogues_Attribut_link::where('')
    }
}
