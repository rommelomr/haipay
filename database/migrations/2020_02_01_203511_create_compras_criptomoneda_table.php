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

            $table->unsignedBigInteger('id_moderador')->nullable();
            $table->foreign('id_moderador')->references('id')->on('moderadores');

            $table->unsignedBigInteger('id_metodo_pago');
            $table->foreign('id_metodo_pago')->references('id')->on('metodos_pago');

            $table->decimal('precio_moneda_a_comprar',15,9);
            $table->decimal('precio_moneda_a_pagar',15,9);
            $table->decimal('comision_general',5,2);
            $table->decimal('monto',15,9);
            $table->decimal('total_sin_comision',15,9);
            $table->decimal('total_con_comision',15,9);
            $table->decimal('ganancia',13,9);
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
