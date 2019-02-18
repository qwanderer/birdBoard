<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{

    use RefreshDatabase;

    public function test_project_has_a_path()
    {
        $project = factory("App\Project")->create();
        $this->assertEquals("/projects/".$project->id, $project->urn());
    } // func


    public function test_project_has_user_owner()
    {
        $project = factory("App\Project")->create();
        $this->assertInstanceOf("App\User", $project->user);
    }


    public function test_project_can_have_tasks()
    {

        //$this->withoutExceptionHandling();

        $project = factory("App\Project")->create();

        $task = $project->addTask("Test task body");

        $this->assertCount(1, $project->tasks);
        $this->assertTrue($project->tasks->contains($task));

    }

} // class
