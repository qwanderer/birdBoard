<?php

namespace App\Http\Controllers;

use App\Project;
use App\Task;
use Illuminate\Http\Request;

class ProjectTasksController extends Controller
{
    public function store(Project $project)
    {

        $this->authorize("update", $project);

        request()->validate(['body'=>"required|min:5"]);

        $project->addTask(request('body'));

        return redirect($project->urn());
    } // func


    public function update(Project $project, Task $task)
    {

        $this->authorize("update", $task->project);

        $attributes = request()->validate(['body'=>"sometimes|min:5"]);
        if(request()->has("completed")){
            $attributes['completed'] = request("completed")=="on";
        }else{
            $attributes['completed'] = false;
        }

        $task->update($attributes);

        return redirect($project->urn());
    } // func

} // class
