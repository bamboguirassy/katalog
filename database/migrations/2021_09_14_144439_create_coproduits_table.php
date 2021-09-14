<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoproduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coproduits', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('commande_id')->constrained()->require();
            $table->foreignId('produit_id')->constrained()->require();
            $table->integer('quantite')->require()->min(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coproduits');
    }
}
