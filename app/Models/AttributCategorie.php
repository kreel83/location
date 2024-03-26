<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AttributCategorie extends Pivot
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'categorie_id',
        'attribut_id',
    ];
}
