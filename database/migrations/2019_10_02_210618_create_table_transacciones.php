<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTransacciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transacciones', function (Blueprint $table) {

            $table->bigIncrements('id');
            /*
            $table->unsignedBigInteger('id_tipo_transaccion');
            $table->foreign('id_tipo_transaccion')->references('id')->on('tipo_transaccion');
            
            $table->unsignedBigInteger('id_metodo_pago');
            $table->foreign('id_metodo_pago')->references('id')->on('metodos_pago');
            */
            
            $table->unsignedBigInteger('id_cliente');
            $table->foreign('id_cliente')->references('id')->on('clientes');

            $table->unsignedBigInteger('id_moderador')->nullable();
            $table->foreign('id_moderador')->references('id')->on('moderadores');

            $table->unsignedBigInteger('id_tipo_transaccion');
            $table->foreign('id_tipo_transaccion')->references('id')->on('tipos_transaccion');

            $table->tinyInteger('estado');

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
        Schema::dropIfExists('transacciones');
    }
}
