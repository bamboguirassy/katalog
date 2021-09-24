<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouleurProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('couleur_produits', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('couleur_id')->constrained()->require();
            $table->foreignId('produit_id')->constrained()->require();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('couleur_produits');
    }
}
