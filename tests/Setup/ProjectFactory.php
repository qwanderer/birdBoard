<?php
/**
 * Created by PhpStorm.
 * User: rodion
 * Date: 2/25/2019
 * Time: 2:13 PM
 */

namespace Tests\Setup;


use App\Project;
use App\Task;
use App\User;

class ProjectFactory
{
    protected $tasksCount=0;
    protected $user;

    public function withTasks($count)
    {
        $this->tasksCount = $count;
        return $this;
    } // func


    public function ownedBy($user)
    {
        $this->user = $user;
        return $this;
    }


    public function create()
    {
        $project = factory(Project::class)->create([
            "user_id"=>$this->user ?? factory(User::class)
        ]);

        factory(Task::class, $this->tasksCount)->create([
            'project_id'=>$project->id
        ]);

        return $project;
    }

}