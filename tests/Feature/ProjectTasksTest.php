<?php

namespace Tests\Feature;

use App\Project;
use App\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTasksTest extends TestCase
{

    use RefreshDatabase;


    public function test_only_the_owner_of_a_project_can_add_tasks_to_it()
    {
        $this->signIn();
        $project = factory(Project::class)->create();

        $this->post($project->urn()."/tasks", ['body'=>"Test task"])->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body'=>"Test task"]);
    } // func


    public function test_project_have_tasks()
    {
        $this->signIn();
        $project = factory(Project::class)->create(['user_id'=>auth()->id()]);
        $task = ['body'=>"Test task"];

        $this->post($project->urn()."/tasks", $task);

        $this->get($project->urn())
            ->assertSee($project->title)
            ->assertSee($task['body']);
    } // func


    public function test_task_required_body()
    {
        $this->signIn();
        $project = factory(Project::class)->create(['user_id'=>auth()->id()]);

        $task = factory(Task::class)->raw(['body'=>""]);

        $this->post($project->urn()."/tasks", $task)
            ->assertSessionHasErrors('body');
    }


    public function test_task_can_be_updated()
    {
        $this->signIn();
        $project = factory(Project::class)->create(['user_id'=>auth()->id()]);
        $task = $project->addTask("Test Task");

        $new_task_data = [
            'body'=>"Changed",
            'completed'=>true
        ];
        $this->patch($task->urn(), $new_task_data);
        $this->assertDatabaseHas("tasks", $new_task_data);
    } // func


    public function test_only_owner_can_update_task()
    {
        $this->signIn();
        $project = factory(Project::class)->create();
        $task = $project->addTask("Test Task");

        $new_task_data = [
            'body'=>"Changed",
            'completed'=>true
        ];
        $this->patch($task->urn(), $new_task_data)
            ->assertStatus(403);

        $this->assertDatabaseMissing("tasks", $new_task_data);
    }
} // class


















