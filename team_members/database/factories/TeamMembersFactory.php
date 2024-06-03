<?php

namespace Database\Factories;

use App\Models\TeamMembers;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamMembersFactory extends Factory
{
    protected $model = TeamMembers::class;

    public function definition()
    {
        return [
            'name' => $this->faker->sentence,
            'role' => $this->faker->randomElement(['Разработчик', 'Тестировщик', 'Дизайнер', 'Менеджер проекта', 'Руководитель']),
        ];
    }
}