<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->text('description');

            $table->datetime('start_date');

            $table->datetime('end_date')
            ->nullable();

            $table->integer('duration')
            ->comment('In seconds');

            $table->integer('total_marks');

            $table->tinyInteger('default_mark')
            ->comment('Default Marks per question overwrite per question mark.');

            // $table->decimal('negative_mark',2,2)
            $table->integer('negative_mark')
            ->nullable()
            ->comment('Overwrite Questions point/mark,devided by 100');

            $table->boolean('attend_negative_marking')
            ->default(1)
            ->comment('Calculate negetive marking only on attendent questions.');

            $table->tinyInteger('publish_result')
            ->comment('Exam Status: 0/null = Immidiate, 1=After exam end date, 2=Manually.')
            ->default(0);

            $table->tinyInteger('status')
            ->comment('Exam Status: 0 = Draft,1=active,2=ended')
            ->nullable()
            ->default(0);

            $table->integer('user_attended')
            ->comment('How many user attended this exam.')
            ->nullable()
            ->default(0);

            $table->tinyInteger('randomise_questions')
            ->nullable();

            // $table->json('grade')->nullable()->comment('1st 2nd and qualification');//
            $table->text('instruction')
            ->nullable();

            $table->softDeletes();

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
        Schema::dropIfExists('exams');
    }
}
