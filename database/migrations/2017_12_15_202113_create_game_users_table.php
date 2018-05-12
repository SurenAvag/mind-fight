<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameUsersTable extends Migration
{
    public function up()
    {
        Schema::create('game_users', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedInteger('game_id')->nullable();
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');

            $table->integer('true_answers_count')->nullable();
            $table->double('rating_changes')->nullable();

            $table->string('finished_date')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('game_users');
    }
}
