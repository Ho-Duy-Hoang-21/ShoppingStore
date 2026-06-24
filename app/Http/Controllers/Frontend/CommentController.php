<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    // Lấy danh sách comment cha + con
    public function index(Request $request)
    {
        $comments = Comment::where('id_blog', $request->id_blog)
            ->whereNull('parent_id')
            ->with('replies')
            ->latest()
            ->paginate(5);

        return response()->json($comments);
    }

    // Gửi comment qua AJAX
    public function storeAjax(Request $request)
    {
        $request->validate(['cmt' => 'required|string|max:500']);

        $comment = Comment::create([
            'cmt'       => $request->cmt,
            'id_blog'   => $request->id_blog,
            'parent_id' => $request->parent_id ?? null,
            'id_user'   => auth()->id(),
            'name_user' => auth()->user()->name,
            'avatar'    => auth()->user()->avatar ?? null,
            'level'     => 0,
            'time'      => 0,
        ]);

        // Load lại replies nếu là reply con
        $comment->load('replies');

        return response()->json([
            'success' => true,
            'comment' => $comment,
        ]);
    }

    // Gửi form thường (fallback)
    public function storeComment(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        Comment::create([
            'cmt'       => $request->cmt,
            'id_blog'   => $request->id_blog,
            'parent_id' => $request->parent_id ?? null,
            'id_user'   => auth()->id(),
            'name_user' => auth()->user()->name,
            'avatar'    => auth()->user()->avatar ?? null,
            'level'     => 0,
            'time'      => 0,
        ]);

        return back()->with('success', 'Bình luận thành công!');
    }
}