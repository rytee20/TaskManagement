<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Tasks;
use App\Models\TaskTeamMembers;

class TasksControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate', ['--env' => 'testing']); // вызов миграций перед каждым тестом
    }

    /** @test */
    public function it_can_get_tasks()
    {
        // Arrange
        $task1 = Tasks::factory()->create(['status' => 'в работе']);
        $task2 = Tasks::factory()->create(['status' => 'завершено']);
        $taskTeamMember = TaskTeamMembers::factory()->create(['task_id' => $task1->task_id, 'team_member_id' => 1]);

        // Act
        $response = $this->get('/tasks?status=в работе&team_member_id=1');

        // Assert
        $response->assertStatus(200);
        $response->assertJsonFragment(['task_name' => $task1->task_name]);
        $response->assertJsonMissing(['task_name' => $task2->task_name]);
    }

    /** @test */
    public function it_can_store_a_task()
    {
        // Arrange

        $taskData = [
            'task_name' => 'Test Task',
            'status' => 'в работе'
        ];

        // Act
        $response = $this->post('/tasks', $taskData);

        // Assert
        $response->assertRedirect('/tasks/create');
        $this->assertDatabaseHas('tasks', ['task_name' => 'Test Task', 'status' => 'в работе']);
    }
}