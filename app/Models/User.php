<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'telephone',
        'type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function shop() {
        return $this->hasOne(Shop::class);
    }

    /**
     * Route notifications for the Slack channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForSlack($notification)
    {
        return 'https://hooks.slack.com/services/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';
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
