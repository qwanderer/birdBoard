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
        if(auth()->user()->isNot($project->user)){
            abort(403);
        }
        return view('projects.show', compact('project'));
    }

    public function store()
    {
        $attribute = request()->validate([
            'title'=>"required",
            'description'=>"required"
        ]);
        auth()->user()->projects()->create($attribute);
        return redirect('/projects');
    } // func


} // class