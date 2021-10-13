<?php

namespace Tests\Feature\Admin;

use App\Models\Subject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubjectTest extends TestCase
{
    public function test_admin_can_view_subject_list()
    {
        $subject =  Subject::factory(1)->create(["name"=>"Subject_Name"]);
        $this->assertDatabaseCount('subjects', 1);
        $this->actAsAdmin();
        $this->get(route('admin.subject.index'))->assertSee($subject->first()->name);
    }

    public function test_user_can_not_access_subject_list()
    {
        $subject =  Subject::factory(1)->create(["name"=>"Subject_Name"]);
        $this->assertDatabaseCount('subjects', 1);
        $this->signIn();
        $this->get(route('admin.subject.index'))
            ->assertForbidden();
    }

    public function test_check_one_subject()
    {
        $subject =  Subject::factory(1)->create(["name"=>"Subject_Name"]);
        $this->assertDatabaseCount('subjects', 1);
        $this->actAsAdmin();
        $this->get(route('admin.subject.show', $subject->first()->id))
            ->assertSee($subject->first()->name);
    }

    public function test_admin_can_see_subject_create_form()
    {
        $this->actAsAdmin();
        $this->get(route('admin.subject.create'))
            ->assertOk()
            ->assertSee('Add a Subject');
    }

    public function test_admin_can_see_subject_edit_form()
    {
        $subject =  Subject::factory(1)->create(["name"=>"Subject_Name"]);
        $this->assertDatabaseCount('subjects', 1);
        $this->actAsAdmin();
        $this->get(route('admin.subject.edit', $subject->first()->id))->assertSee($subject->first()->name);
    }

    public function test_admin_can_update_subject()
    {
        $subject =  Subject::factory(1)->create(["name"=>"Subject_Name"]);
        $this->assertDatabaseCount('subjects', 1);
        $this->actAsAdmin();
        $this->put(route('admin.subject.update', $subject->first()->id), ['subjectName' => 'nameIsHere'])
            ->assertRedirect(route('admin.subject.show', $subject->first()->id))
            ->assertSessionHas('success');
    }

    public function test_admin_can_delete_a_subject()
    {
        $this->withoutExceptionHandling();
        $subject =  Subject::factory(2)->create();
        $this->actAsAdmin();
        $this->delete(route('admin.subject.destroy', $subject->first()->id));
        $this->assertSoftDeleted('subjects', ['id' => $subject->first()->id]);
    }

    public function test_admin_can_see_subject_trash()
    {
        $subject =  Subject::factory(1)->create(["name"=>"Subject_Name"]);
        $this->actAsAdmin();
        $this->delete(route('admin.subject.destroy', $subject->first()->id));
        $this->get('admin.subject.trash')
            ->assertSee($subject->first()->id);
    }

    public function test_admin_can_restore_deleted_subject()
    {
        $subject =  Subject::factory(1)->create(["name"=>"Subject_Name"]);
        $this->actAsAdmin();
        $this->delete(route('admin.subject.destroy', $subject->first()->id));
        $this->get(route('admin.subject.index'))->assertDontSee($subject->first()->name);
        $this->post(route('admin.subject.restoreDeleted', $subject->first()->id));
        $this->get(route('admin.subject.index', $subject->first()->id))->assertSee($subject->first()->name);
    }

    public function test_admin_can_delete_permanently()
    {
        $subject =  Subject::factory(1)->create(["name"=>"Subject_Name"]);
        $this->actAsAdmin();
        $this->delete(route('admin.subject.destroy', $subject->first()->id));
        $this->post(route('admin.subject.forceDelete', $subject->first()->id));
        $this->assertDatabaseCount('subjects', 0);
        $this->get(route('admin.subject.show', $subject->first()->id))->assertDontSee($subject->first()->name);
    }
}
