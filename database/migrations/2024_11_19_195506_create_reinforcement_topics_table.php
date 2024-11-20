<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReinforcementTopicsTable extends Migration
{
    public function up()
    {
        Schema::create('reinforcement_topics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_id')->constrained()->onDelete('cascade'); // Relación con la tabla tests
            $table->string('topic'); // Tema de refuerzo
            $table->timestamps(); // Timestamps para created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('reinforcement_topics');
    }
}
