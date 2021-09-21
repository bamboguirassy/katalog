<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValeurAttributProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valeur_attribut_produits', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('attribut_produit_id')->constrained()->require();
            $table->foreignId('valeur_attribut_id')->constrained()->require();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('valeur_attribut_produits');
    }
}
