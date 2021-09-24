<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CategorieProduit extends Model
{
    use HasFactory;

    protected $fillable = [
        'produit_id',
        'categorie_id'
    ];

    /**
     * Get the categorie that owns the CategorieProduit
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class);
    }
}
