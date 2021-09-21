<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValeurAttributProduit extends Model
{
    use HasFactory;

    protected $fillable = [
        'attribut_produit_id',
        'valeur_attribut_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function valeurAttribut() {
        return $this->belongsTo(ValeurAttribut::class);
    }
}
