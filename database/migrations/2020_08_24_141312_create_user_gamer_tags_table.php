<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserGamerTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_gamer_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Id_User')->constrained('users');
            $table->string('Nome');
            $table->foreignId('Id_GamerTag')->constrained('gamer_tags');
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
        Schema::dropIfExists('user_gamer_tags');
    }
}
