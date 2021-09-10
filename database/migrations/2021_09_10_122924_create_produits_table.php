<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nom')->require();
            $table->foreignId('categorie_id')->constrained()->require();
            $table->integer('prixUnitaire')->require();
            $table->integer('quantite')->nullable()->default(0);
            $table->text('description')->require();
            $table->boolean('visible')->require()->default(true);
            $table->foreignId('shop_id')->constrained()->require();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produits');
    }
}
