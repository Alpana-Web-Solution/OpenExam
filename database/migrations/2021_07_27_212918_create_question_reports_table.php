<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_reports', function (Blueprint $table) {
            $table->id();

            $table->foreignId('question_id')
            ->constrained()
            ->onDelete('cascade');

            $table->foreignId('user_id')
            ->constrained()
            ->onDelete('cascade');

            $table->foreignId('result_id')
            ->constrained()
            ->nullable()
            ->onDelete('cascade');

            $table->string('report')
            ->nullable();

            $table->string('replay')
            ->nullable();

            $table->tinyInteger('status')
            ->nullable()
            ->comment('0=pending,1=accept,2=Denied');

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
        Schema::dropIfExists('question_reports');
    }
}
