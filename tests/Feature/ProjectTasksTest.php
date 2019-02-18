<?php

namespace Tests\Feature;

use App\Project;
use App\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTasksTest extends TestCase
{

    use RefreshDatabase;


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


} // class
