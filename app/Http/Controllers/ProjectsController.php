<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProjectRequest;
use App\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{


    public function index()
    {
        $projects = auth()->user()->projects;
        return view('projects.index', compact('projects'));
    } // func


    public function create()
    {
        return view("projects.create");
    }

    public function show(Project $project)
    {
        $this->authorize("update", $project);
        return view('projects.show', compact('project'));
    }


    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        $request->save();
        return redirect($project->urn());
    } // func

    public function store()
    {
        $attribute = $this->validateRequest();
        $project = auth()->user()->projects()->create($attribute);
        return redirect($project->urn());
    } // func


    protected function validateRequest()
    {
        return request()->validate([
            'title'=>"sometimes|required",
            'description'=>"sometimes|required",
            'notes'=>"nullable",
        ]);
    }


} // class