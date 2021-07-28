<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentReplay extends Model
{
    protected $fillable=['replay_desc','comment_id','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
