<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallComandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detall_comandes', function (Blueprint $table) {
            $table->bigInteger('comanda_id')->unsigned();
            $table->foreign('comanda_id')->references('id')->on('comandes');
            $table->bigInteger('producte_id')->unsigned();
            $table->foreign('producte_id')->references('id')->on('productes');
            $table->primary(['comanda_id', 'producte_id']);
            $table->integer('quantitat');
            $table->date('data');
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
        Schema::dropIfExists('detall_comandes');
    }
}
