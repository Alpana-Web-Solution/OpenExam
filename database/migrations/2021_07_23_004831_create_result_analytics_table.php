<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultAnalyticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_analytics', function (Blueprint $table) {

            $table->unsignedBigInteger('result_id');

            $table->json('right')
            ->comment('question_id,answer,time')
            ->nullable();

            $table->json('wrong')
            ->comment('question_id,answer,time')
            ->nullable();

            $table->json('skipped')
            ->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('result_analytics');
    }
}
