<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Paproduit extends Model
{
    use HasFactory;

    protected $fillable = [
        'panier_id',
        'quantite',
        'produit_id'
    ];

    /**
     * Get the produit that owns the Paproduit
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function produit(): BelongsTo
    {
        return $this->belongsTo(Produit::class);
    }
}
