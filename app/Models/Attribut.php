<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribut extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'type',
        'description',
        'shop_id',
        'changePrice'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function valeurs() {
        return $this->hasMany(ValeurAttribut::class);
    }
}
