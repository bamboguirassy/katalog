<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'shop_id',
        'user_id',
        'etat'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function produits() {
        return $this->hasMany(Coproduit::class);
    }

    public function shop() {
        return $this->belongsTo(Shop::class);
    }
}
