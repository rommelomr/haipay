<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasDepositoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras_deposito', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('id_compra_criptomoneda');
            $table->foreign('id_compra_criptomoneda')->references('id')->on('compras_criptomoneda');

            $table->decimal('comision_deposito',5,2);
            
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
        Schema::dropIfExists('compras_deposito');
    }
}
