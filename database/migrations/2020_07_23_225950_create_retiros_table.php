<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetirosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retiros', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->unsignedBigInteger('id_cliente');
            $table->foreign('id_cliente')->references('id')->on('clientes');

            $table->unsignedBigInteger('id_moderador');
            $table->foreign('id_moderador')->references('id')->on('moderadores');
            
            $table->unsignedBigInteger('id_hai_criptomoneda');
            $table->foreign('id_hai_criptomoneda')->references('id')->on('hai_criptomonedas');

            $table->unsignedBigInteger('id_metodo_retiro');
            $table->foreign('id_metodo_retiro')->references('id')->on('metodos_retiro');

            $table->decimal('comision_red',16,9);

            $table->decimal('comision_retiro',16,9);

            $table->char('tipo',1);
            $table->char('direccion',255);
            $table->char('tag',255)->default('N/A');

            $table->decimal('monto_total',16,9);

            $table->decimal('monto_a_retirar',16,9);
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
        Schema::dropIfExists('retiros');
    }
}
