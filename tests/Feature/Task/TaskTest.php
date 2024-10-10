<?php

namespace Tests\Feature\Task;

use App\Models\Diary\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_new_task_by_controller(): void
    {
        $user = User::factory()->create();

        $testData = [
            'title' => 'Testowy tytuł',
            'description' => 'Lorem ipsum',
            'type' => 'task',
            'due_date' => Carbon::now()->addDays(30)->toDateTimeString(),
        ];

        $response = $this->actingAs($user)->post('/diary/tasks', $testData);

        $response->assertStatus(302);
        $this->assertDatabaseCount('tasks', 1);
        $this->assertDatabaseHas('tasks', $testData);
    }

    public function test_update_task_by_controller(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $task = Task::factory()->create();

        $this->put('/diary/tasks/' . $task->id, ['title' => 'Zmieniony tytuł']);

        $this->assertDatabaseHas('tasks', ['title' => 'Zmieniony tytuł']);
    }

    public function test_show_tasks(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $task = Task::factory()->create();

        $this->get('diary/tasks/' . $task->id)->assertStatus(200);
    }

    public function test_delete_task(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $task = Task::factory()->create();

        $this->assertDatabaseCount('tasks', 1);
        $this->actingAs($user)->delete('diary/tasks/' . $task->id)->assertStatus(302);
        $this->assertDatabaseCount('tasks', 0);
    }
}
