<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Id_Usuario')->constrained('users');
            $table->foreignId('Id_Game')->constrained('games');
            $table->text('Comentarios')->nullable();
            $table->double('Nota', 3, 1)->nullable();
            $table->date('Inicio')->nullable();
            $table->date('Finalização')->nullable();
            $table->date('Completado')->nullable();
            $table->time('Tempo')->nullable();
            $table->foreignId('Id_Status')->constrained('statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listings');
    }
}
