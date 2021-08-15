<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class CheckBrokenLinksTest extends TestCase
{
    
    /**
     * This tests all admin url and check if they are accacable by User
     *
     * @return void
     */
    public function test_check_successfull_login()
    {

        $this->signIn()
        ->get('/dashboard')
        ->assertSeeText('Welcome');
    }
    public function test_check_user_profile()
    {
            $this->signIn()->get('/profile')->assertSeeText(auth()->user()->name);
    }
}
