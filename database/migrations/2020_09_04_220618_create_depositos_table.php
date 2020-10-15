<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depositos', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->unsignedBigInteger('id_cliente');
            $table->foreign('id_cliente')->references('id')->on('clientes');

            $table->unsignedBigInteger('id_hai_criptomoneda');
            $table->foreign('id_hai_criptomoneda')->references('id')->on('hai_criptomonedas');

            $table->unsignedBigInteger('id_moderador');
            $table->foreign('id_moderador')->references('id')->on('moderadores');
            
            $table->char('url');
            $table->char('imagen');

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
        Schema::dropIfExists('depositos');
    }
}
