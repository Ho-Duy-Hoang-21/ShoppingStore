<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
class ListProductController extends Controller
{
    public function listProduct(Request $request)
    {
        $query = Product::with(['brand', 'category', 'user']);

        // Tìm kiếm theo tên member
        if ($request->filled('search')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        $products = $query->paginate(10);

        return view('admin.product.list-product', compact('products'));
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);

        // Xóa ảnh thật trên server
        $images = json_decode($product->image, true) ?? [];
        foreach ($images as $imgGroup) {
            foreach ($imgGroup as $path) {
                $fullPath = public_path($path);
                if (file_exists($fullPath)) {
                    unlink($fullPath);
                }
            }
        }

        $product->delete();

        return redirect()->route('admin.product.list')->with('success', 'Xóa sản phẩm thành công!');
    }

    public function edit($id)
    {
        $product = Product::with(['brand', 'category'])->findOrFail($id);
        $categories = \App\Models\Category::all();
        $brands = \App\Models\Brand::all();

        return view('admin.product.edit-product', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'id_category' => 'required|exists:category,id',
            'id_brand' => 'required|exists:brand,id',
            'status' => 'required|in:0,1',
            'sale' => 'nullable|numeric|min:0|max:100',
            'company' => 'nullable|string|max:255',
        ]);

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'id_category' => $request->id_category,
            'id_brand' => $request->id_brand,
            'status' => $request->status,
            'sale' => $request->status == 0 ? ($request->sale ?? 0) : 0,
            'company' => $request->company,
        ]);

        $saleValue = ($request->status == 0) ? ($request->sale ?? 0) : 0;
        $oldImages = json_decode($product->image, true) ?? [];
        $deleteList = $request->input('delete_images', []);

        // Xóa ảnh được đánh dấu
        foreach ($oldImages as $key => $imgGroup) {
            if (in_array($key, $deleteList)) {
                // Xóa file thật
                foreach ($imgGroup as $path) {
                    $fullPath = public_path($path);
                    if (file_exists($fullPath)) {
                        unlink($fullPath);
                    }
                }
                unset($oldImages[$key]);
            }
        }

        // Reset key về 0,1,2,...
        $oldImages = array_values($oldImages);

        // Upload ảnh mới
        $newImages = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $name = time() . '_' . $file->getClientOriginalName();

                // Thumb - 85x84
                Image::read($file->getRealPath())
                    ->cover(85, 84)
                    ->save(public_path('upload/product/thumb/thumb_' . $name));

                // Medium - 329x380
                Image::read($file->getRealPath())
                    ->cover(329, 380)
                    ->save(public_path('upload/product/medium/medium_' . $name));

                // Full - giữ nguyên
                Image::read($file->getRealPath())
                    ->save(public_path('upload/product/full/' . $name));

                $newImages[] = [
                    'full' => 'upload/product/full/' . $name,
                    'thumb' => 'upload/product/thumb/thumb_' . $name,
                    'medium' => 'upload/product/medium/medium_' . $name,
                ];
            }
        }

        // Gộp ảnh cũ còn lại + ảnh mới
        $mergedImages = array_merge($oldImages, $newImages);

        // Kiểm tra tổng số ảnh <= 3
        if (count($mergedImages) > 3) {
            return back()->withErrors(['images' => 'Tổng số hình không được vượt quá 3.'])->withInput();
        }

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'id_category' => $request->id_category,
            'id_brand' => $request->id_brand,
            'status' => $request->status,
            'sale' => $saleValue,
            'image' => json_encode($mergedImages),
            'detail' => $request->detail,
            'company' => $request->company,
        ]);

        return redirect()->route('product.list')->with('success', 'Cập nhật sản phẩm thành công!');
    }
}
