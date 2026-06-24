<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // Lấy thông tin product từ DB để lưu vào session
            $product = Product::find($productId);
            if (!$product) {
                return response()->json(['success' => false, 'message' => 'Product not found'], 404);
            }

            $images = json_decode($product->image, true);
            $img = $images[0]['thumb'] ?? null;

            $cart[$productId] = [
                'product_id' => $productId,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $img,
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);

        $totalCount = array_sum(array_column($cart, 'quantity'));

        return response()->json([
            'success' => true,
            'cart_count' => $totalCount,
        ]);
    }

    public function updateCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = (int) $request->input('quantity', 1);

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            if ($quantity <= 0) {
                unset($cart[$productId]);
            } else {
                $cart[$productId]['quantity'] = $quantity;
            }
            session()->put('cart', $cart);
        }

        // Tính lại tổng
        $subtotal = 0;
        $totalCount = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
            $totalCount += $item['quantity'];
        }

        $rowTotal = isset($cart[$productId])
            ? $cart[$productId]['price'] * $cart[$productId]['quantity']
            : 0;

        return response()->json([
            'success' => true,
            'row_total' => number_format($rowTotal, 2),
            'subtotal' => number_format($subtotal, 2),
            'cart_count' => $totalCount,
        ]);
    }

    public function removeCart(Request $request)
    {
        $productId = $request->input('product_id');

        $cart = session()->get('cart', []);
        unset($cart[$productId]);
        session()->put('cart', $cart);

        $subtotal = 0;
        $totalCount = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
            $totalCount += $item['quantity'];
        }

        return response()->json([
            'success' => true,
            'subtotal' => number_format($subtotal, 2),
            'cart_count' => $totalCount,
        ]);
    }

    public function getCount()
    {
        $cart = session()->get('cart', []);
        $totalCount = array_sum(array_column($cart, 'quantity'));
        return response()->json(['cart_count' => $totalCount]);
    }

    public function showCart()
    {
        // Chưa login → redirect về trang login
        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('error', 'Vui lòng đăng nhập để xem giỏ hàng.');
        }

        $cart = session()->get('cart', []);
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        return view('frontend.cart.cart', compact('cart', 'subtotal'));
    }
}