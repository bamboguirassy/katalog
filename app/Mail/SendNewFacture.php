<?php

namespace App\Mail;

use App\Models\Facture;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendNewFacture extends Mailable
{
    use Queueable, SerializesModels;
    public $facture;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Facture $facture)
    {
        $this->facture = $facture;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.facture.new')->subject('Nouvelle Facture - '.$this->facture->titre);
    }
}
