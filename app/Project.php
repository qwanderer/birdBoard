<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];


    public function urn()
    {
        return "/projects/{$this->id}";
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function activity()
    {
        return $this->hasMany(Activity::class);
    }


    public function tasks()
    {
        return $this->hasMany(Task::class)->orderBy("updated_at", "DESC");
    }


    public function addTask($body)
    {
        return $this->tasks()->create([
            'body'=>$body
        ]);
    }
} // class
