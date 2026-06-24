<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\MailNotify;
use App\Models\History;

class MailController extends Controller
{
    public function sendOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:50',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return back()->with('error', 'Giỏ hàng trống!');
        }

        $totalPrice = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        $cartWithUrl = collect($cart)->toArray();
        
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'cart' => $cartWithUrl,
            'total' => $totalPrice,
        ];

        // Lưu DB trước
        History::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'id_user' => Auth::id() ?? 0,
            'price' => $totalPrice,
        ]);

        // Gửi mail sau
        try {
            Mail::to($request->email)->send(new MailNotify($data));
        } catch (\Exception $e) {
            \Log::error('Mail error: ' . $e->getMessage());
            // dd('Mail error: ' . $e->getMessage()); 
        }

        session()->forget('cart');

        return redirect()->route('checkout')->with('success', 'Đặt hàng thành công! Vui lòng kiểm tra email.');
    }
}