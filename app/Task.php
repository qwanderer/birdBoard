<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    protected $guarded=[];

    protected $touches = ['project'];

    protected $casts = [
        'completed' => "boolean"
    ];



    public function project()
    {
        return $this->belongsTo(Project::class);
    }


    public function urn()
    {
        return "/projects/{$this->project->id}/tasks/{$this->id}";
    }


} // func
