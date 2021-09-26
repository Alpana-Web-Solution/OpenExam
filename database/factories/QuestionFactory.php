<?php

namespace Database\Factories;

use App\Models\Question;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;
use Mockery\Matcher\Subset;

class QuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Question::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $subject = Subject::first();

        if (empty($subject)) {
            $subject = Subject::factory()->create();
        }

        return [
            'question' => $this->faker->sentence(),
            'options' => [
                1 => $this->faker->sentence(),
                2 => $this->faker->sentence(),
                3 => $this->faker->sentence(),
                4 => $this->faker->sentence()
            ],
            'difficulty' => 1,
            'answer' => $this->faker->numberBetween(1, 4),
            'point' => 1,
            'subject_id' => $subject->id
        ];
    }
}
