<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'categorie_id',
        'prixUnitaire',
        'quantite',
        'description',
        'visible',
        'shop_id',
        'produit_id',
        'configured',
        'inPromo',
        'oldPrice'
    ];

    protected $casts = [];

    /**
     * Get the shop that owns the Produit
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    /**
     * Get the categorie that owns the Produit
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class);
    }

    public function images() {
        return $this->hasMany(Image::class);
    }

    public function imageCouverture() {
        return $this->hasOne(Image::class)->ofMany([], function($query) {
            $query->where('couverture',true);
        });
    }

    public function attributs() {
        return $this->hasMany(AttributProduit::class);
    }

    public function variants() {
        return $this->hasMany(Produit::class);
    }

    public function produit() {
        return $this->belongsTo(Produit::class);
    }

    public function attributValues() {
        return $this->hasMany(VariantAttributeValue::class);
    }
}
