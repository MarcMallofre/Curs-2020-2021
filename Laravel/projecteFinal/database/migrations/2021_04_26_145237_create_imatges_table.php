<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImatgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imatges', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('ruta');
            $table->bigInteger('producte_id')->unsigned();
            $table->foreign('producte_id')->references('id')->on('productes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imatges');
    }
}
