<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProduitVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'prixUnitaire',
        'quantite',
        'produit_id',
        'configured'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function produit() {
        return $this->belongsTo(Produit::class);
    }

    public function attributValues() {
        return $this->hasMany(VariantAttributeValue::class);
    }

    public function images() {
        return $this->hasMany(Image::class);
    }
}
