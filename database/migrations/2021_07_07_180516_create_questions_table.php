<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();

            $table->text('question');

            $table->tinyInteger('type')
            ->default(1)
            ->comment('Can be many types of questions');

            $table->json('options')
            ->nullable();

            $table->string('media')
            ->nullable()
            ->comment('Question can be a media and user can give an options');

            $table->tinyInteger('answer')
            ->comment('As options is an array it starts with 0');

            $table->text('help')
            ->nullable()
            ->comment('Help can be provided to the students.');

            $table->tinyInteger('point');

            $table->tinyInteger('difficulty')
            ->default(1)
            ->comment('1=simple,2=hard,3=Super Human');

            $table->unsignedBigInteger('subject_id')
            ->nullabel();

            $table->foreign('subject_id')
            ->references('id')
            ->on('subjects');

            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
