<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
        'shop_id',
        'active',
        'categorie_id'
    ];


    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    
    /**
     * Get the shop that owns the Categorie
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    /*public function produits() {
        return $this->hasMany(Produit::class);
    }*/

    /**
     * Get the parent that owns the Categorie
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Categorie::class,'categorie_id');
    }

    public function subs() {
        return $this->hasMany(Categorie::class);
    }

    public function categorieProduits() {
        return $this->hasMany(CategorieProduit::class);
    }

    public function produits() {
        return $this->belongsToMany(Produit::class,'categorie_produits','categorie_id','produit_id')->take(4);
    }
}
