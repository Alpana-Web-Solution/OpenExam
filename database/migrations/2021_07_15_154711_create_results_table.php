<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();

            $table->foreignId('exam_id')
            ->constrained()
            ->onDelete('cascade');

            $table->foreignId('user_id')
            ->constrained()
            ->onDelete('cascade');

            $table->json('answers')
            ->nullable()
            ->comment('All question answered pair will be stored here.');

            $table->json('time')
            ->nullable()
            ->comment('All question times will be stored here.');

            $table->integer('point')
            ->nullable()
            ->comment('Between 0 to 100');

            $table->integer('percentage')
            ->nullable()
            ->comment('between 0 to 100');

            $table->datetime('finish_time')
            ->comment('User can login and give exam again between creted_at and this time.');

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
        Schema::dropIfExists('results');
    }
}
