<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnosAsignaturas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos_asignaturas', function (Blueprint $table) {
            $table->id();
            $table->integer("id_alumno");
            $table->integer("alumnos_asignaturas_id");
            $table->timestamp("fecha_registro");
            $table->tinyText("estatus");
            
            $table->foreign('alumnos_asignaturas_id')
            ->references('id')->on('asignaturas')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumnos_asignaturas');
    }
}
