<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    public $data = [
        'name'=>'User1111',
        'username'=>'User112221',
        'email'=>'asdasdasdasd@gmail.com',
        'password'=>'this@is@very@unique@$$%%',
        'password_confirmation'=>'this@is@very@unique@$$%%',
        'mobile'=>'8790872256'
    ];

    public function test_check_registration_url_working()
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200);

    }

    public function test_register_a_user()
    {
        $this->withExceptionHandling();

        $this->post(route('register'),$this->data)
            ->assertRedirect(route('home'))
            ->assertSessionHasNoErrors();
        $this->assertDatabaseCount('users',1);
    }

    public function test_validate_wrong_email()
    {
        $this->withExceptionHandling();

        $validateData = $this->data;
        unset($validateData['email']);
        $validateData['email'] = 'somewrongemail.com';

        $this->post(route('register'),$validateData)
            ->assertSessionHasErrors();

    }

}
