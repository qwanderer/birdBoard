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
} // class
