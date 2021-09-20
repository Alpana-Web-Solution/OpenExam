<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use Tests\TestCase;

class ProfileTest extends TestCase
{
    public function test_check_user_profile()
    {
        $this->signIn()
        ->get(route('user.profile'))
        ->assertSeeText('Update');
    }

    public function test_profile_change_password_form()
    {
        $this->signIn()
        ->get(route('user.profile.password.form'))
        ->assertOk();
    }

    public function test_update_users_password()
    {
        $this->signIn()
        ->post(route('user.profile.password'),[
            'current_password'=>'password',
            'password'=>'secret@is@very@unique@$$%%1',
            'password_confirmation'=>'secret@is@very@unique@$$%%1'
        ])
        ->assertRedirect('/');

    }

    public function test_profile_update_phone_number()
    {
        $newData = [
        'name'=>'User1111',
        'username'=>'User112221',
        'email'=>'asdasdasdasd@gmail.com',
        'mobile'=>'8790872256'
        ];

        $this->signIn()
        ->post(route('user.profile.update'),$newData)
        ->assertStatus(302);

    }
}
