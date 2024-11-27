<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestResultsTable extends Migration
{
    public function up()
    {
        Schema::create('test_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Si deseas asociar los resultados a un usuario
            $table->string('calificacion');
            $table->decimal('puntaje', 5, 2); // Porcentaje del puntaje
            $table->json('temas_refuerzo'); // Para almacenar los temas en formato JSON
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('test_results');
    }
}
