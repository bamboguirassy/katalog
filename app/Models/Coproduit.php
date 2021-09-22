<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Coproduit extends Model
{
    use HasFactory;

    protected $fillable = [
        'produit_id',
        'commande_id',
        'quantite',
        'prixUnitaire'
    ];

    /**
     * Get the produit that owns the Coproduit
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function produit(): BelongsTo
    {
        return $this->belongsTo(Produit::class);
    }
}
