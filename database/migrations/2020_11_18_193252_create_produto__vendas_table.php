<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutoVendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produto__vendas', function (Blueprint $table) {
            //produto id / venda id / qnt
            $table->integer('qnt');
            $table->unsignedBigInteger('produto_id');
            $table->unsignedBigInteger('venda_id');
            $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('cascade');
            $table->foreign('venda_id')->references('id')->on('vendas');
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
        Schema::dropIfExists('produto__vendas');
    }
}
