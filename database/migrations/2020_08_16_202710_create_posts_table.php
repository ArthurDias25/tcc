<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
         // $table->foreignId('Id_CategoriaPost')->constrained('post_categories');
            $table->string('Titulo')->nullable();
            $table->text('Post');
            $table->foreignId('Id_Usuario')->constrained('users');
            $table->foreignId('Id_Game')->nullable()->constrained('games');
            $table->boolean('Deleted')->default('0');
            $table->string('Info')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
