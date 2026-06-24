<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function showCategory()
    {
        $category = Category::orderBy('id', 'asc')->paginate(10);
        return view('admin.category.category',compact('category'));
    }

    public function addCategory()
    {
        return view('admin.category.addcategory');    
    }

    public function createCategory(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->save();

        return redirect()->route('category.list');    
    }

    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect()->route('category.list');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.editcategory',compact('category'));   
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();
        
        return redirect()->route('category.list');
    }
}
