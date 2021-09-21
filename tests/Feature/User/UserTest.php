<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{

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

    public function test_user_change_to_bengali_language()
    {
        $this->signIn()
        ->get('user?change_language=bn')
        ->assertSeeText('ড্যাশবোর্ড');
    }

    public function test_check_exam_exists()
    {

    }

}
