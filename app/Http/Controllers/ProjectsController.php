<?php

namespace App\Http\Controllers;

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


    public function update(Project $project)
    {
        $this->authorize("update", $project);
        $attribute = request()->validate([
            'notes'=>"min:3",
        ]);
        $project->update($attribute);
        return redirect($project->urn());
    } // func

    public function store()
    {
        $attribute = request()->validate([
            'title'=>"required",
            'description'=>"required",
            'notes'=>"min:3",
        ]);
        $project = auth()->user()->projects()->create($attribute);
        return redirect($project->urn());
    } // func


} // class