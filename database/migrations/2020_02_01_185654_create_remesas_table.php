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

            $table->unsignedBigInteger('id_moderador')->nullable();
            $table->foreign('id_moderador')->references('id')->on('moderadores');

            $table->unsignedBigInteger('id_tipo_remesa')->nullable();
            $table->foreign('id_tipo_remesa')->references('id')->on('tipos_remesa');

            $table->unsignedBigInteger('id_metodo_pago');
            $table->foreign('id_metodo_pago')->references('id')->on('metodos_pago');

            $table->decimal('monto',6,2);

            $table->decimal('comision_general',6,2);

            $table->decimal('comision_compra',6,2);

            $table->decimal('precio_bitcoin_htg',15,2);

            $table->decimal('monto_total',15,2);

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
