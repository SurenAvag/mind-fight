<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('text');

            $table->unsignedInteger('subject_id');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');

            $table->unsignedInteger('topic_id');
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');

            $table->integer('level')->default(1)->comment('1=>easy,2=>middle,3=>high');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('questions');
        Schema::enableForeignKeyConstraints();
    }
}
