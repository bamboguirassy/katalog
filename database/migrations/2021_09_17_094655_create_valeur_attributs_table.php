<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValeurAttributsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valeur_attributs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('valeur')->require();
            $table->string('nom')->nullable();
            $table->foreignId('attribut_id')->constrained()->require();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('valeur_attributs');
    }
}
