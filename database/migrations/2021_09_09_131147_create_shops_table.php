<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nom')->unique()->require();
            $table->string('pseudonyme')->unique()->require()->min(6);
            $table->foreignId('categorie_id')->constrained()->require();
            $table->string('logo')->nullable();
            $table->string('telephonePrimaire');
            $table->string('telephoneSecondaire')->nullable();
            $table->text('description')->require();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->text('adresse')->require();
            $table->string('email');
            $table->foreignId('user_id')->constrained()->require();
            $table->boolean('enabled')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops');
    }
}
