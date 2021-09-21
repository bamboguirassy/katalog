<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributProduit extends Model
{
    use HasFactory;

    protected $fillable = [
        'attribut_id',
        'produit_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    

    public function valeurs() {
        return $this->hasMany(ValeurAttributProduit::class);
    }

    public function attribut() {
        return $this->belongsTo(Attribut::class);
    }
}
