<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Symfony\Component\Console\Input\Input;
class IndexController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $brands = Brand::all();

        $query = Product::query()->with(['category', 'brand']);
        if ($request->filled('q')) {
            $query->where('name', 'LIKE', '%' . $request->get('q') . '%');
        }

        if ($request->filled('price')) {
            [$min, $max] = explode('-', $request->get('price'));
            $query->whereBetween('price', [(int) $min, (int) $max]);
        }

        if ($request->filled('category')) {
            $query->where('id_category', $request->get('category'));
        }

        if ($request->filled('brand')) {
            $query->where('id_brand', $request->get('brand'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->get('status'));
        }
        
        //price silder
        if ($request->filled('min_price')) {
            $query->where('price', '>=', (int) $request->get('min_price'));
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', (int) $request->get('max_price'));
        }
        $latestProducts = $query->latest()->paginate(6);

        // Trả về AJAX
        if ($request->ajax()) {
            return view('frontend.client.product._list', compact('latestProducts'));
        }



        $recommendedProducts = Product::with(['category', 'brand',])
            ->where('status', 0)->latest()->take(6)->get();

        return view('frontend.index.index', compact(
            'latestProducts',
            'recommendedProducts',
            'categories',
            'brands',
        ));
    }


}
