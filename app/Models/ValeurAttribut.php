<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValeurAttribut extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'valeur',
        'attribut_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function attribut() {
        return $this->belongsTo(Attribut::class);
    }
}
