<?php

namespace Database\Seeders;

use App\Models\TeamMembers;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        TeamMembers::factory()->create([
            'name' => 'Иван',
            'role' => 'Разработчик',
        ]);

        TeamMembers::factory()->create([
            'name' => 'Мария',
            'role' => 'Тестировщик',
        ]);

        TeamMembers::factory()->create([
            'name' => 'Алексей',
            'role' => 'Дизайнер',
        ]);

        TeamMembers::factory()->create([
            'name' => 'Елена',
            'role' => 'Менеджер проекта',
        ]);

        TeamMembers::factory()->create([
            'name' => 'Егор',
            'role' => 'Руководитель',
        ]);
    }
}
