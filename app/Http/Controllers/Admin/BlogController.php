<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blogs;
use App\Models\BlogRate;


class BlogController extends Controller
{
    public function GetBlog()
    {
        $blogs = Blogs::latest()->paginate(5);
        return view('admin.blog.blog', compact('blogs'));
    }

    public function AddBlog()
    {
        return view('admin.blog.addblog');
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string|max:500',
            'content' => 'required|string',
        ], [
            // Thông báo lỗi tiếng Việt
            'title.required' => 'Tiêu đề không được để trống',
            'title.max' => 'Tiêu đề không được quá 255 ký tự',
            'image.required' => 'Vui lòng chọn ảnh',
            'image.image' => 'File phải là ảnh',
            'image.mimes' => 'Ảnh phải có định dạng jpeg, png, jpg, gif',
            'image.max' => 'Ảnh không được quá 2MB',
            'description.required' => 'Mô tả không được để trống',
            'description.max' => 'Mô tả không được quá 500 ký tự',
            'content.required' => 'Nội dung không được để trống',
        ]);

        $blog = new Blogs();
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->content = $request->input('content');

        $file = $request->file('image');

        if ($file) {
            $file = $request->file('image');
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('admin/assets/images/blogs'), $imageName);
            $blog->image = $imageName;
        }
        $blog->save();


        return redirect()->route('blog.list')->with('success', 'Thêm blog thành công!');
    }

    public function edit($id)
    {
        $blog = Blogs::findOrFail($id);
        return view('admin/blog/editblog', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'description' => 'required|string|max:500',
            'content' => 'required|string',
        ], [
            'title.required' => 'Tiêu đề không được để trống',
            'title.max' => 'Tiêu đề không được quá 255 ký tự',
            'image.image' => 'File phải là ảnh',
            'image.mimes' => 'Ảnh phải có định dạng jpeg, png, jpg, gif',
            'image.max' => 'Ảnh không được quá 2MB',
            'description.required' => 'Mô tả không được để trống',
            'description.max' => 'Mô tả không được quá 500 ký tự',
            'content.required' => 'Nội dung không được để trống',
        ]);

        $blog = Blogs::findOrFail($id);
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->content = $request->input('content');


        if ($request->hasFile('image')) {

            $oldImage = public_path('admin/assets/images/blogs/' . $blog->image);
            if (file_exists($oldImage)) {
                unlink($oldImage);
            }

            $file = $request->file('image');
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('admin/assets/images/blogs'), $imageName);
            $blog->image = $imageName;
        }

        $blog->save();
        return redirect()->route('blog.list')->with('success', 'Cập nhật thành công!');
    }

    public function delete($id)
    {
        $blog = Blogs::find($id);
        $blog->delete();

        return redirect()->route('blog.list');
    }

    public function rate(Request $request)
    {
        $request->validate([
            'rate' => 'required|integer|min:1|max:5',
            'id_blog' => 'required|exists:blogs,id',
        ]);

        // Nếu đã rate rồi thì giữ nguyên, chưa thì tạo mới
        $existing = BlogRate::where('id_blog', $request->id_blog)
            ->where('id_user', auth()->id())
            ->first();

        if (!$existing) {
            BlogRate::create([
                'rate' => $request->rate,
                'id_blog' => $request->id_blog,
                'id_user' => auth()->id(),
            ]);
            $message = 'Đánh giá thành công!';
        } else {
            $message = 'Bạn đã đánh giá rồi!';
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'avg_rate' => number_format(
                BlogRate::where('id_blog', $request->id_blog)->avg('rate'),
                1
            ),
            'total_vote' => BlogRate::where('id_blog', $request->id_blog)->count(),
        ]);
    }
}
