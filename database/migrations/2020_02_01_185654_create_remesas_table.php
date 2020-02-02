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

            $table->unsignedBigInteger('monto');
            
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
