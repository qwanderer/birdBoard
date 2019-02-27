<?php

namespace Tests\Feature;

use App\Project;
use App\Task;
use Tests\Setup\ProjectFactory;
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

        $this->post($project->urn()."/tasks", ['body'=>"Test task"]);

        $this->get($project->urn())
            ->assertSee($project->title)
            ->assertSee("Test task");
    } // func


    public function test_task_required_body()
    {
        $this->signIn();
        $project = factory(Project::class)->create(['user_id'=>auth()->id()]);

        $this->post($project->urn()."/tasks", ['body'=>""])
            ->assertSessionHasErrors('body');
    }


    public function test_task_can_be_updated()
    {

        $project = app(ProjectFactory::class)
            ->ownedBy($this->signIn())
            ->withTasks(1)
            ->create();

        $new_task_data = ['body'=>"Changed",];
        $this->patch($project->tasks[0]->urn(), $new_task_data);
        $this->assertDatabaseHas("tasks", $new_task_data);
    } // func




    public function test_only_owner_can_update_task()
    {
        $this->signIn();

        $project = app(ProjectFactory::class)
            ->withTasks(1)
            ->create();

        $new_task_data = [
            'body'=>"Changed",
            'completed'=>true
        ];
        $this->patch($project->tasks[0]->urn(), $new_task_data)
            ->assertStatus(403);

        $this->assertDatabaseMissing("tasks", $new_task_data);
    }
} // class


















