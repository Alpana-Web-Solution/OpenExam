<?php

namespace Tests\Feature\Admin;

use App\Models\Question;
use Carbon\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\VarDumper\Cloner\Data;
use Tests\TestCase;

class QuestionTest extends TestCase
{

    public function test_get_question_list()
    {
        Question::factory(30)->create();
        $this->actAsAdmin()->get(route('admin.question.index'))
            ->assertOk()
            ->assertSee('Create A Question');
        $this->assertDatabaseCount('questions', 30);
    }

    public function test_show_question()
    {
        $question = Question::factory()->create();

        $this->actAsAdmin()
        ->get(route('admin.question.show',$question->id))
        ->assertOk()
        ->assertSee($question->question);
    }

    public function test_create_a_question_form()
    {

        $this->actAsAdmin()
        ->get(route('admin.question.create'))
        ->assertSee('create');

    }

    public function test_view_a_question()
    {
        $question = Question::factory()->create();

        $this->actAsAdmin()
        ->get(route('admin.question.show',$question->id))
        ->assertSee($question->question);

    }

    public function test_view_a_question_edit_form()
    {
        $question = Question::factory()->create();

        $this->actAsAdmin()
        ->get(route('admin.question.edit',$question->id))
        ->assertSee($question->question)
        ->assertSee('Update');

    }

    public function test_update_validated_question()
    {
        $question =Question::factory()->create();
        $data = Question::factory()->raw();
        $this->actAsAdmin()
        ->put(route('admin.question.update',$question->id),$data)
        ->assertRedirect(route('admin.question.show',$question->id))
        ->assertSessionHas('success');
    }

    public function test_can_fail_update_validated_error_in_question()
    {
        $question =Question::factory()->create();
        $data = Question::factory()->raw();
        unset($data['question']);
        $this->actAsAdmin()
        ->put(route('admin.question.update',$question->id),$data)
        ->assertStatus(302);

    }

    public function test_delete_a_question()
    {
        $this->withoutExceptionHandling();
        $question = Question::factory()->create();
        $this->actAsAdmin()
            ->delete(route('admin.question.destroy',$question->id))
            ->assertRedirect(route('admin.question.index'))
            ->assertSessionHas('success');
    }

}
