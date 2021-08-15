<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	// Admin user create
    	\App\Models\User::factory([
    		'name'=>'Admin',
    		'email'=>'admin@admin.com',
    		'username'=>'admin',
    		'mobile'=>'0000000000',
    		'is_admin'=>true,
    		'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
    	])->create();
    	// Create 10 demo user
        \App\Models\User::factory(10)->create();

    }
}
