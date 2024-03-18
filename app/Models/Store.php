<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Store extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'url',
        'adresse1',
        'adresse2',
        'cp',
        'ville',
        'phone',
        'code_ville',
        'latitude',
        'longitude',
        'jours_ferie_zone',
    ];

    public function joursFeries(): BelongsToMany
    {
        return $this->BelongsToMany(JoursFerie::class, 'store_jours_feries');
    }

}
