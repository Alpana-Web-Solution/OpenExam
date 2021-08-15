<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class TestBrokenLinksTest extends TestCase
{

    
    /**
     * This tests all admin url and check if they are accacable by admin
     *
     * @return void
     */
    public function test_admin_check_login()
    {
       
        $this->signIn(User::factory(['is_admin'=>1])->create())
        ->get('/admin/dashboard')
        ->assertSeeText('Welcome');
    }

    public function test_admin_check_usermanager()
    {

        $user = User::factory(['is_admin'=>1])->create();
        $this->actingAs($user)
        ->get('/admin/usermanager')
        ->assertSeeText('name',$user->name);
    }
    
    public function test_admin_change_to_bengali_language()
    {
        
        $this->actingAs(User::factory(['is_admin'=>1])->create())
        ->get('admin/dashboard?change_language=bn')
        ->assertSeeText('ড্যাশবোর্ড');
    }
}
