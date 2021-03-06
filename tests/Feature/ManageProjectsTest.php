<?php

namespace Tests\Feature;

use App\Project;
use Tests\Setup\ProjectFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageProjectsTest extends TestCase
{

    use WithFaker, RefreshDatabase;


    public function test_guest_cannot_manage_project()
    {
        $project = factory(Project::class)->create();

        $this->get('/projects')->assertRedirect("login");
        $this->get('/projects/create')->assertRedirect("login");
        $this->get($project->urn()."/edit")->assertRedirect("login");
        $this->get($project->urn())->assertRedirect("login");
        $this->post("/projects", $project->toArray())->assertRedirect("login");
    }


    public function test_user_can_create_project()
    {
        $this->signIn();
        $project_data = factory("App\Project")->raw(['user_id'=>auth()->user()->id]);

        $this->post("/projects", $project_data)->assertRedirect();

        $this->assertDatabaseHas("projects", $project_data);
        $this->get('/projects')
            ->assertSee($project_data['title']);

    } // func


    public function test_project_required_title()
    {
        $this->signIn();
        $project_data = factory("App\Project")->raw(['title'=>""]);
        $this->post("/projects", $project_data)->assertSessionHasErrors('title');
    } // func

    public function test_project_required_description()
    {
        $this->signIn();
        $project_data = factory("App\Project")->raw(['description'=>""]);
        $this->post("/projects", $project_data)->assertSessionHasErrors('description');
    } // func

    public function test_guest_cannot_create_projects()
    {
        $project_data = factory("App\Project")->raw();
        $this->post("/projects", $project_data)->assertRedirect("login");
    } // func

    public function test_guest_cannot_view_projects()
    {
        $this->get('/projects')->assertRedirect("login");
    }

    public function test_guest_cannot_view_single_project()
    {
        $project = factory("App\Project")->create();
        $this->get($project->urn())->assertRedirect("login");
    }


    public function test_user_can_view_his_project()
    {
        $this->signIn();
        $project = factory("App\Project")->create(['user_id'=>auth()->id()]);
        $this->get($project->urn())
            ->assertSee($project->title)
            ->assertSee($project->description);
    } // func


    public function test_user_cannot_view_not_his_projects()
    {
        $this->signIn();
        $project = factory("App\Project")->create();
        $this->get($project->urn())->assertStatus(403);
    }


    public function test_user_can_update_project()
    {
        $this->signIn();
        $project = factory("App\Project")->create(['user_id'=>auth()->id()]);
        $new_project_data = [
            'notes'=>"new notes",
            'title'=>"new Title",
            'description'=>"new description"
        ];

        $this->patch($project->urn(), $new_project_data)
            ->assertRedirect();
        $this->assertDatabaseHas("projects", $new_project_data);

        $this->get($project->urn()."/edit")->assertStatus(200);
    }


    public function test_user_can_update_project_notes()
    {
        $project = app(ProjectFactory::class)
            ->ownedBy($this->signIn())
            ->create();

        $this->patch($project->urn(), $new_notes = ['notes'=>"new notes"])
            ->assertRedirect();

        $this->assertDatabaseHas("projects", $new_notes);

    } // func

} // class
















