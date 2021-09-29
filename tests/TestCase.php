<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;
use App\Exceptions\Handler;
use App\Models\Question;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\User;


abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;


    protected function signIn($user = null)
    {
        $user = $user ?? User::factory()->create();

        $this->actingAs($user);

        return $this;
    }

    public function actAsAdmin()
    {
        $user = User::factory(['is_admin'=>1])->create();
        $this->actingAs($user);
        return $this;

    }

    public function createQuestion($args = [],$num = null)
    {
        return Question::factory($num)->create($args);
    }
}
