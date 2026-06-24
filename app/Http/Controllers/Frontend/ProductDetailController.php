<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
class ProductDetailController extends Controller
{
    public function detail($id)
    {
        $product = Product::findOrFail($id);
        $images = json_decode($product->image, true) ?? [];
        return view('frontend.product.product-details',compact('product','images'));
    }
}
