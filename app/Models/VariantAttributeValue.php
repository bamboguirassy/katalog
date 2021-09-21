<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantAttributeValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'produit_variant_id',
        'valeur_attribut_produit_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function produitVariant() {
        return $this->belongsTo(ProduitVariant::class);
    }

    public function valeurAttributProduit() {
        return $this->belongsTo(ValeurAttributProduit::class);
    }
}
