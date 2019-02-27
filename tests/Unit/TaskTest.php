<?php

namespace Tests\Unit;

use App\Project;
use App\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{

    use RefreshDatabase;


    public function test_task_belongs_to_project()
    {
        $task = factory(Task::class)->create();
        $this->assertInstanceOf(Project::class, $task->project);
    }


    public function test_task_have_urn()
    {
        $task = factory(Task::class)->create();
        $this->assertEquals("/projects/".$task->project->id."/tasks/".$task->id, $task->urn());
    } // func




} // class
