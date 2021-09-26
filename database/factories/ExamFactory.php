<?php

namespace Database\Factories;

use App\Models\Exam;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Exam::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=> $this->faker->word(3),
            'description'=>$this->faker->sentence(),
            'start_date'=>now(),
            'end_date'=>now()->addDays(30),
            'duration'=>3600,
            'total_marks'=>100,
            'default_mark'=>1,
            'status'=>1,
            'publish_result'=>1
        ];
    }
}
