<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;
    public function project()     { return $this->belongsTo(Project::class); }
    public function user()        { return $this->belongsTo(User::class); }
    public function subtasks()    { return $this->hasMany(Subtask::class); }
    public function comments()    { return $this->hasMany(Comment::class); }
    public function attachments(){ return $this->hasMany(Attachment::class); }
}
