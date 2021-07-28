<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable=[
        'comment_desc',
        'user_id',
        'task_id'
    ];

    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }
    public function replies()
    {
        return $this->hasMany(CommentReplay::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
