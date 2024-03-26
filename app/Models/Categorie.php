<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    public function children()
    {
        return $this->hasMany(Categorie::class, 'parent_id', 'id')->orderBy('name');
    }

    public function parent()
    {
        return $this->belongsTo(Categorie::class, 'parent_id', 'id')->orderBy('name');
    }

    public static function getAllCategories()
    {
        return Categorie::with('children')->whereNull('parent_id')->orderBy('name')->get();
    }

    // public function attributs() {
    //     $liste =  $this->hasMany('App\Models\Attribut_link','parent_id','id')->where('parent_type','categorie')->pluck('attribut_id');
    //     return Attribut::whereIn('id', $liste)->get();
    // }

    public function attributs()
    {
        return $this->belongsToMany(Attribut::class)->orderBy('name');
    }
}
