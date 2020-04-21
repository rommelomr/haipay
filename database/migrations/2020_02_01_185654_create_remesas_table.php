<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemesasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remesas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_emisor');
            $table->foreign('id_emisor')->references('id')->on('clientes');
            
            $table->unsignedBigInteger('id_transaccion');
            $table->foreign('id_transaccion')->references('id')->on('transacciones');
            
            $table->unsignedBigInteger('id_metodo_retiro');
            $table->foreign('id_metodo_retiro')->references('id')->on('metodos_retiro');

            $table->unsignedBigInteger('id_tipo_remesa')->nullable();
            $table->foreign('id_tipo_remesa')->references('id')->on('tipos_remesa');

            $table->unsignedBigInteger('monto');
            $table->bigInteger('monto_total');
            $table->tinyInteger('comision_remesa');
            $table->tinyInteger('estado')->default(0);
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
        Schema::dropIfExists('remesas');
    }
}
