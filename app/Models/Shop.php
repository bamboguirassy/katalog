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
}
