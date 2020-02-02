<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasCriptomonedaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras_criptomoneda', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_hai_criptomoneda');
            $table->foreign('id_hai_criptomoneda')->references('id')->on('hai_criptomonedas');

            $table->unsignedBigInteger('id_moneda');
            $table->foreign('id_moneda')->references('id')->on('monedas');

            $table->unsignedBigInteger('id_transaccion');
            $table->foreign('id_transaccion')->references('id')->on('transacciones');

            $table->bigInteger('monto');
            $table->decimal('precio',13,9);
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
        Schema::dropIfExists('compras_criptomoneda');
    }
}