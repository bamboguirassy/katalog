<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'pseudonyme',
        'categorie_id',
        'logo',
        'telephonePrimaire',
        'telephoneSecondaire',
        'description',
        'facebook',
        'instagram',
        'twitter',
        'linkedin',
        'adresse',
        'email',
        'user_id',
        'enabled'
    ];

    /**
     * Get the user that owns the Shop
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categorie(): BelongsTo
    {
        return $this->belongsTo(Type::class,'categorie_id');
    }

    public function categories() {
        return $this->hasMany(Categorie::class)->where('categorie_id',null);
    }

    public function marques() {
        return $this->hasMany(Marque::class)->has('produits');
    }

    public function produits() {
        return $this->hasMany(Produit::class);
    }

    public function paniers() {
        return $this->hasMany(Panier::class)->has('produits');
    }

    public function commandes() {
        return $this->hasMany(Commande::class);
    }

    public function commandeEnAttentes() {
        return $this->hasMany(Commande::class)->where('etat','En attente');
    }

    public function commandeAcceptees() {
        return $this->hasMany(Commande::class)->where('etat','Acceptée');
    }

    public function commandeRejetees() {
        return $this->hasMany(Commande::class)->where('etat','Rejetée');
    }

    public function commandeLivrees() {
        return $this->hasMany(Commande::class)->where('etat','Livrée');
    }

    public function commandeAnnulees() {
        return $this->hasMany(Commande::class)->where('etat','Annulée');
    }
}
