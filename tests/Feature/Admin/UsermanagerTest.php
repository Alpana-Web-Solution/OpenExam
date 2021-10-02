<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class UsermanagerTest extends TestCase
{

    public function test_usermanager_index_list()
    {
        $this->actAsAdmin();
        $this->get(route('admin.usermanager.index'))->assertSee('admin@admin.com');
    }

    public function test_can_create_a_user()
    {
        $this->actAsAdmin();
        $this->get(route('admin.usermanager.create'))->assertSee('Save');
    }

    public function test_usermanager_create_user_using_post()
    {
        $this->actAsAdmin();
        $user = User::factory()->raw();
        $user['password_confirmation'] = $user['password'];
        $response = $this->post(route('admin.usermanager.store'),$user)->assertStatus(302);

        $response->assertSessionHas('success');

        $this->assertDatabaseCount('users',2);
    }

    public function test_usermanager_need_password_confirmation_else_throw_validation_error()
    {

        $this->actAsAdmin();
        $user = User::factory()->raw();
        unset($user['username']);

        $response = $this->post(route('admin.usermanager.store'),$user);
        $errors = session('errors');
        $response->assertSessionHasErrors();
        $this->assertEquals($errors->get('password')[0],"The password confirmation does not match.");
        $this->assertEquals($errors->get('username')[0],"The username field is required.");
    }

    public function test_usermanager_show_edit_form()
    {
        $this->actAsAdmin();
        $response = $this->post(route('admin.usermanager.edit',auth()->id()));
        $response->assertSee(auth()->user()->name);

    }

    public function test_usermanager_can_update()
    {
        $this->actAsAdmin();
        $user = User::factory()->create();
        $updateuser = $user->toArray();
        unset($updateuser['username']);
        $updateuser['username']= 'UserNameUpdated';
        $updateuser['password'] = 'password';
        $updateuser['password_confirmation']= 'password';


        $response = $this->put(route('admin.usermanager.update',$user->id),$updateuser);
        $response->assertRedirect(route('admin.usermanager.index'))->assertSessionHas('success');
        $this->assertDatabaseHas('users',['username'=>'UserNameUpdated']);

    }

    public function test_delete_a_user()
    {
        $this->actAsAdmin();
        $user = User::factory()->create();
        $response = $this->delete(route('admin.usermanager.destroy',$user->id));
        $response->assertRedirect(route('admin.usermanager.index'));
        $this->assertDatabaseCount('users',1);
    }

}
