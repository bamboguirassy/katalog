<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produit_variants', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('prixUnitaire')->require()->min(0);
            $table->integer('quantite')->require()->min(0);
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
        Schema::dropIfExists('produit_variants');
    }
}
