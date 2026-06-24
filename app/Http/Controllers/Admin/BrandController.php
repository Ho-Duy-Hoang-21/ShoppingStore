<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function showBrand()
    {
        $brand = Brand::orderBy('id', 'asc')->paginate(10);
        return view('admin.brand.brand',compact('brand'));
    }

    public function add()
    {
        return view('admin.brand.addbrand');
    }

    public function create(Request $request)
    {
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->save();
        
        return redirect()->route('brand.list');
    }

    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('admin.brand.editbrand',compact('brand'));
    }

    public function update(Request $request,$id)
    {
        $brand = Brand::find($id);
        $brand->name = $request->name;
        $brand->save();

        return redirect()->route('brand.list');
    }

    public function delete($id)
    {
        $brand = Brand::find($id);
        $brand->delete();

        return redirect()->route('brand.list');
    }
}
