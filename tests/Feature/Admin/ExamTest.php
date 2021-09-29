<?php

namespace Tests\Feature\Admin;

use App\Models\Exam;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExamTest extends TestCase
{
    public function test_exam_can_show()
    {
        // $this->withoutExceptionHandling();
        $exam =  Exam::factory()->has(\App\Models\Question::factory()->count(10))->create(['name'=>'Exam 1','total_marks'=>10]);
        $this->assertDatabaseCount('exams', 1);
        $this->signIn();
        $this->get('/exam')->assertSee($exam->name);

    }

    public function test_finished_exam_dont_show()
    {
        // $this->withoutExceptionHandling();
        $exam =  Exam::factory()->has(\App\Models\Question::factory()->count(10))->create(['name'=>'Exam 2','status'=>3,'total_marks'=>10]);
        $this->assertDatabaseCount('exams', 1);
        $this->signIn();
        $this->get('/exam')->assertDontSee($exam->name);

    }

    public function test_create_a_draft_dont_show_in_exam()
    {
        // $this->withoutExceptionHandling();
        $exam =  Exam::factory()->create(['name'=>'Exam 3','status'=>0]);
        $this->assertDatabaseCount('exams', 1);
        $this->signIn();
        // dd($exam->name);
        $this->get('/exam')->assertDontSee($exam->name);
    }

    public function test_exam_with_no_question_can_not_change_status()
    {
        $exam =  Exam::factory()->create(['name'=>'Exam 4','status'=>0]);
        $this->assertDatabaseCount('exams', 1);

        $this->actAsAdmin();

        $this->get('/exam')->assertDontSee($exam->name);
        $this->post(route('admin.exam.statusupdate',$exam->id),['status'=>1])->assertSessionHas('error');

    }
    public function test_exam_with_question_can_change_status()
    {
        $exam =  Exam::factory()->create(['name'=>'Exam 5','status'=>0,'total_marks'=>10,
        'default_mark'=>1,]);
        $this->assertDatabaseCount('exams', 1);

        $this->actAsAdmin();

        $this->get('/exam')->assertDontSee($exam->name);
        $this->post(route('admin.exam.statusupdate',$exam->id),['status'=>1])->assertSessionHas('error');

    }
}
