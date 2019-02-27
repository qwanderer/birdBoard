<?php

namespace Tests\Feature;

use Tests\Setup\ProjectFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecordActivityTest extends TestCase
{
    use RefreshDatabase;

    public function test_creating_project()
    {
        $project = app(ProjectFactory::class)->create();
        $this->assertCount(1, $project->activity);

        $this->assertEquals("created", $project->activity[0]->description);
    } // func


    public function test_updating_project()
    {
        $project = app(ProjectFactory::class)->create();
        $project->update(['title'=>"Changed"]);

        $this->assertCount(2, $project->activity);
        $this->assertEquals("updated", $project->activity->last()->description);
    } // func


    public function test_creating_task()
    {
        $project = app(ProjectFactory::class)
            ->withTasks(1)
            ->create();
        $this->assertCount(2, $project->activity);
        $this->assertEquals("created_task", $project->activity->last()->description);
    }


    public function test_completing_task()
    {
        $user = $this->signIn();
        $project = app(ProjectFactory::class)
            ->ownedBy($user)
            ->withTasks(1)
            ->create();


        $this->patch($project->tasks[0]->urn(), ['body'=>"new body", 'completed'=>true]);


        $this->assertEquals(true, $project->tasks[0]->fresh()->completed);


        $this->assertCount(3, $project->fresh()->activity);
        $this->assertEquals("completed_task", $project->fresh()->activity->last()->description);
    }

    public function test_INcompleting_task()
    {
        $user = $this->signIn();
        $project = app(ProjectFactory::class)
            ->ownedBy($user)
            ->withTasks(1)
            ->create();

        // complete task
        $this->patch($project->tasks[0]->urn(), ['body'=>"new body", 'completed'=>true]);
        $project->refresh();
        $this->assertEquals(true, $project->tasks[0]->completed);
        $this->assertCount(3, $project->activity);


        // incomplete task
        $this->patch($project->tasks[0]->urn(), ['body'=>"new body", 'completed'=>false]);
        $project->refresh();
        $this->assertEquals(false, $project->tasks[0]->fresh()->completed);

        $this->assertCount(4, $project->activity);

        $this->assertEquals("incompleted_task", $project->activity->last()->description);
    }

} // class