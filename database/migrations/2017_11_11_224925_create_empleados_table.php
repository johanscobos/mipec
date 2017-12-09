<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cedula', 15);
            $table->string('nombres', 100);
            $table->string('apellidos', 50);
            $table->string('telefono', 20)->nullable();
            $table->string('celular', 20);
            $table->string('direccion', 100)->nullable();

            $table->char('pais_codigo');
            $table->foreign('pais_codigo')->references('codigo')->on('paises');

            $table->integer('ciudad_id')->unsigned();
            $table->foreign('ciudad_id')->references('id')->on('ciudades');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->char('estado',1);
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
        Schema::dropIfExists('empleados');
    }
}
