<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComisionesReferido extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comisiones_referido', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('id_hai_criptomoneda');
            $table->foreign('id_hai_criptomoneda')->references('id')->on('hai_criptomonedas');

            $table->decimal('monto_en_usd',5,2); 

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
        Schema::dropIfExists('comisiones_referido');
    }
}
