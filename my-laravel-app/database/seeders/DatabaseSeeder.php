<?php

namespace Database\Seeders;

use App\Models\Tasks;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\TaskTeamMembers;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Tasks::factory()->create([
            'task_name' => 'Разработка фичи A',
            'status' => 'в работе',
        ]);

        Tasks::factory()->create([
            'task_name' => 'Тестирование фичи A',
            'status' => 'не начато',
        ]);

        Tasks::factory()->create([
            'task_name' => 'Дизайн интерфейса',
            'status' => 'завершено',
        ]);

        Tasks::factory()->create([
            'task_name' => 'Планирование проекта B',
            'status' => 'остановлено',
        ]);

        TaskTeamMembers::factory()->create([
            'task_id' => '1',
            'team_member_id' => '1',
        ]);

        TaskTeamMembers::factory()->create([
            'task_id' => '2',
            'team_member_id' => '2',
        ]);

        TaskTeamMembers::factory()->create([
            'task_id' => '1',
            'team_member_id' => '2',
        ]);

        TaskTeamMembers::factory()->create([
            'task_id' => '3',
            'team_member_id' => '3',
        ]);

        TaskTeamMembers::factory()->create([
            'task_id' => '4',
            'team_member_id' => '4',
        ]);
    }
}
