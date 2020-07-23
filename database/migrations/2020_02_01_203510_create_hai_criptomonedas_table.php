<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHaiCriptomonedasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hai_criptomonedas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_moneda');
            $table->foreign('id_moneda')->references('id')->on('monedas');

            $table->unsignedBigInteger('id_origen');
            $table->foreign('id_origen')->references('id')->on('origenes');

            $table->double('comision_red',10,6); 
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
        Schema::dropIfExists('hai_criptomonedas');
    }
}
