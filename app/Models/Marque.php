<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marque extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'shop_id',
        'logo',
        'description'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function produits() {
        return $this->hasMany(Produit::class);
    }
}
