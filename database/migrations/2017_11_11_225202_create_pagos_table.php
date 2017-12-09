<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('valor_pago');
            $table->text('descripcion')->nullable();

            $table->integer('cliente_id')->unsigned()->nullable();
            $table->foreign('cliente_id')->references('id')->on('clientes');

            $table->integer('mes_id')->unsigned()->nullable();
            $table->foreign('mes_id')->references('id')->on('meses');

            $table->integer('anio_id')->unsigned()->nullable();
            $table->foreign('anio_id')->references('id')->on('anios');

            $table->integer('servicio_id')->unsigned();
            $table->foreign('servicio_id')->references('id')->on('servicios');

            $table->string('referenceCode',255);

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
        Schema::dropIfExists('pagos');
    }
}
