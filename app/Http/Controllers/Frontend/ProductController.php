<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Intervention\Image\Laravel\Facades\Image;

class ProductController extends Controller
{


    public function showProduct()
    {
        $products = Product::with(['brand', 'category'])
            ->where('id_user', auth()->id())
            ->paginate(5);
        $categories = Category::all();
        $brands = Brand::all();

        return view('frontend.product.my-product', compact('products', 'brands', 'categories'));
    }

    public function showCreate()
    {
        $categories = Category::all();
        $brands = Brand::all();

        return view('frontend.product.add-product', compact('brands', 'categories'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'id_category' => 'required|exists:category,id',
            'id_brand' => 'required|exists:brand,id',
            'status' => 'required|in:0,1',
            'sale' => 'nullable|numeric|min:0|max:100',
            'images' => 'nullable|array|max:3',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:1024',
            'detail' => 'nullable|string',
        ], [
            'name.required' => 'Vui lòng nhập tên sản phẩm.',
            'price.required' => 'Vui lòng nhập giá sản phẩm.',
            'price.numeric' => 'Giá phải là số.',
            'id_category.required' => 'Vui lòng chọn danh mục.',
            'id_brand.required' => 'Vui lòng chọn thương hiệu.',
            'status.required' => 'Vui lòng chọn trạng thái.',
            'image.max' => 'Chỉ được upload tối đa 3 hình.',
            'images.*.image' => ':attribute phải là file hình ảnh.',
            'images.*.mimes' => ':attribute phải có định dạng jpeg, png, jpg, gif.',
            'images.*.max' => ':attribute không được vượt quá 1MB.',
        ]);


        // Xử lý upload ảnh
        $imagesPaths = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $name = $file->getClientOriginalName();

                // Thumb - 85x84
                Image::read($file->getRealPath())
                    ->cover(85, 84)
                    ->save(public_path('upload/product/thumb/' . $name));

                // Medium - 329x380
                Image::read($file->getRealPath())
                    ->cover(329, 380)
                    ->save(public_path('upload/product/medium/' . $name));

                // Full - giữ nguyên
                Image::read($file->getRealPath())
                    ->save(public_path('upload/product/full/' . $name));

                $imagesPaths[] = $name;
            }
        }


        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'id_category' => $request->id_category,
            'id_brand' => $request->id_brand,
            'status' => $request->status,
            'sale' => $request->sale,
            'id_user' => auth()->id(),
            'image' => json_encode($imagesPaths),
            'detail' => $request->detail,
            'company' => $request->company
        ]);

        return redirect()->route('myproduct')
            ->with('success', 'Thêm sản phẩm thành công!');
    }

    public function delete($id)
    {
        $products = Product::find($id);
        $products->delete();

        return redirect()->route('myproduct');
    }

    public function showEdit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $brands = Brand::all();

        return view('frontend.product.edit-product', compact('product', 'brands', 'categories'));
    }

    public function edit(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'id_category' => 'required|exists:category,id',
            'id_brand' => 'required|exists:brand,id',
            'status' => 'required|in:0,1',
            'sale' => 'nullable|numeric|min:0|max:100',
            'images' => 'nullable|array|max:3',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:1024',
            'detail' => 'nullable|string',
            'delete_image' => 'nullable|array',
        ], [
            'name.required' => 'Vui lòng nhập tên sản phẩm.',
            'price.required' => 'Vui lòng nhập giá sản phẩm.',
            'id_category.required' => 'Vui lòng chọn danh mục.',
            'id_brand.required' => 'Vui lòng chọn thương hiệu.',
            'status.required' => 'Vui lòng chọn trạng thái.',
            'image.*.max' => ':attribute không được vượt quá 1MB.',
            'images.*.mimes' => ':attribute phải có định dạng jpeg, png, jpg, gif.',
        ]);


        $oldImages = json_decode($product->image, true) ?? [];
        $deleteList = $request->input('delete_images', []);

        // Xóa ảnh được đánh dấu
        foreach ($oldImages as $key => $name) {
            if (in_array($key, $deleteList)) {
                @unlink(public_path('upload/product/full/' . $name));
                @unlink(public_path('upload/product/thumb/' . $name));
                @unlink(public_path('upload/product/medium/' . $name));

                unset($oldImages[$key]);
            }
        }

        $oldImages = array_values($oldImages);

        // Upload ảnh mới
        $newImages = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $name = time() . '_' . $file->getClientOriginalName();

                // Thumb - 85x84
                Image::read($file->getRealPath())
                    ->cover(85, 84)
                    ->save(public_path('upload/product/thumb/' . $name));

                // Medium - 329x380
                Image::read($file->getRealPath())
                    ->cover(329, 380)
                    ->save(public_path('upload/product/medium/' . $name));

                // Full - giữ nguyên
                Image::read($file->getRealPath())
                    ->save(public_path('upload/product/full/' . $name));

                $newImages[] = $name;
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
            'sale' => $request->sale,
            'image' => json_encode($mergedImages),
            'detail' => $request->detail,
            'company' => $request->company,
        ]);

        return redirect()->route('myproduct')->with('success', 'Cập nhật sản phẩm thành công!');
    }

}