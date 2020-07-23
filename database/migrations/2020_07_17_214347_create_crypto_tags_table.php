<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCryptoTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crypto_tags', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->unsignedBigInteger('id_cartera');
            $table->foreign('id_cartera')->references('id')->on('carteras');
            
            $table->char('tag',50)->nullable();

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
        Schema::dropIfExists('crypto_tags');
    }
}
