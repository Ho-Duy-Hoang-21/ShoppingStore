<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = 
    [
        'id',
        'cmt',
        'id_blog',
        'id_user',
        'name_user',
        'level',
        'parent_id'
    ];

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')->latest();
    }
}
