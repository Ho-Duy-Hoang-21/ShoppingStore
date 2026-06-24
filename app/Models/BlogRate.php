<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogRate extends Model
{
    protected $table = 'blog_ratings';

    protected $fillable = 
    [
        'id',
        'rate',
        'id_blog',
        'id_user'
    ];
}
