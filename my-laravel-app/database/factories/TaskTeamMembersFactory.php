<?php

namespace Database\Factories;

use App\Models\TaskTeamMembers;
use App\Models\Tasks;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskTeamMembersFactory extends Factory
{
    protected $model = TaskTeamMembers::class;

    public function definition()
    {
        return [
            'task_id' => Tasks::factory(),
            'team_member_id' => $this->faker->numberBetween(1,10),
        ];
    }
}