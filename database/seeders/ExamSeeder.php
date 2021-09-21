<?php

namespace Database\Seeders;

use App\Models\Exam;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::factory(2)->create();
        Exam::factory()->has(\App\Models\Question::factory()->count(100))->create();

    }
}
