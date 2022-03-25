<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('clients_id');
            $table->unsignedBigInteger('produtos_id');
            $table->float('total', 10, 2);
            $table->integer('numero');
            $table->integer('qtd');
            $table->date('data');
            $table->enum('status', ['Em aberto', 'Pago', 'Cancelado'])->default('Em aberto');
            $table->timestamps();

            $table->foreign('clients_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('produtos_id')->references('id')->on('produtos')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
