<?php

namespace App\Mail;

use App\Models\Commande;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NouvelleCommande extends Mailable
{
    public $commande;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Commande $commande)
    {
        $this->commande = $commande;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.commande.new')->subject("Nouvelle commande - ".$this->commande->numero)
        ->from($this->commande->shop->email,$this->commande->shop->nom);
    }
}
