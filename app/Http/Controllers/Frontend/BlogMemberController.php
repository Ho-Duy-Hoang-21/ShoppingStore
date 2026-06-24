<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blogs;
use App\Models\Comment;


class BlogMemberController extends Controller
{
    public function getblog()
    {
        $blogs = Blogs::latest()->paginate(3);
        return view('frontend.blog.blog', compact('blogs'));
    }

    public function getblogDetail($id)
    {
        $blogs = Blogs::find($id);
        $nextBlog = Blogs::where('id', '>', $id)->orderBy('id', 'asc')->first();
        $prevBlog = Blogs::where('id', '<', $id)->orderBy('id', 'desc')->first();
        return view('frontend.blog.blog-detail', compact('blogs', 'nextBlog', 'prevBlog'));
    }

    
}
