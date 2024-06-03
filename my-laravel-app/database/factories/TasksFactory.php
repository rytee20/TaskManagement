<?php

namespace Database\Factories;

use App\Models\Tasks;
use Illuminate\Database\Eloquent\Factories\Factory;

class TasksFactory extends Factory
{
    protected $model = Tasks::class;

    public function definition()
    {
        return [
            'task_name' => $this->faker->sentence,
            'status' => $this->faker->randomElement(['завершено', 'в работе', 'остановлено', 'не начато']),
        ];
    }
}