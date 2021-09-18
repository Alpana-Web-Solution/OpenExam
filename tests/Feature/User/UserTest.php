<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public $data = [
        'name'=>'User1111',
        'username'=>'User112221',
        'email'=>'asdasdasdasd@gmail.com',
        'password'=>'this@is@very@unique@$$%%',
        'password_confirmation'=>'this@is@very@unique@$$%%',
        'mobile'=>'8790872256'
    ];

    public function test_check_successfull_login()
    {
        $this->signIn()
        ->get('/user')
        ->assertSeeText('Welcome');
    }

    public function test_check_user_profile()
    {
        $this->signIn()
        ->get('/user/profile')
        ->assertSeeText('Update');
    }

    public function test_check_user_result()
    {
        $this->signIn()
        ->get('/user/result')
        ->assertSeeText('Your Previous Exam Results.');
    }

    public function test_check_user_exam()
    {
        $this->signIn()
        ->get('/exam')
        ->assertOk();
    }

    public function test_check_change_password()
    {
        $this->signIn()
        ->get('/user/profile/password/form')
        ->assertOk();
    }

    public function test_register_a_user()
    {
        $this->withExceptionHandling();

        $this->post(route('register'),$this->data)
            ->assertRedirect(route('home'))
            ->assertSessionHasNoErrors();
        $this->assertDatabaseCount('users',1);
    }


    // Update a user's phone number
    public function test_user_update_phone()
    {
        $newData = $this->data;

        unset($newData['password'],$newData['password_confirmation']);

        $this->signIn()
        ->post(route('user.profile.update'),$newData)
        ->assertStatus(302);

    }


    // Update password
    public function test_update_users_password()
    {
        $data = [
            'current_password'=>'password',
            'password'=>'secret@is@very@unique@$$%%1',
            'password_confirmation'=>'secret@is@very@unique@$$%%1',
        ];

        $this->signIn()
        ->post(route('user.profile.password'),$data)
        ->assertRedirect('/');

    }

    public function test_user_change_to_bengali_language()
    {
        $this->signIn()
        ->get('user?change_language=bn')
        ->assertSeeText('ড্যাশবোর্ড');
    }

}
