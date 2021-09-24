<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'active',
        'couverture',
        'produit_id',
        'couleur_produit_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    /**
     * Get the produit that owns the Image
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function produit(): BelongsTo
    {
        return $this->belongsTo(Produit::class);
    }

    public function couleurProduit() {
        return $this->belongsTo(CouleurProduit::class);
    }
}
