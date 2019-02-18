<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

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

} // class
