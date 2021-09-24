<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouleurProduit extends Model
{
    use HasFactory;

    protected $fillable = [
        'produit_id',
        'couleur_id'
    ];

    public function produit() {
        return $this->belongsTo(Produit::class);
    }

    public function couleur() {
        return $this->belongsTo(Couleur::class);
    }

    public function images() {
        return $this->hasMany(Image::class);
    }
}
