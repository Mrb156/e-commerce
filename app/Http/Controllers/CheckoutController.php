<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $order = Order::select('*')->where('user_id', '=', Auth::user()->id)->first();
            $orderId = $order['id'];

        } else {
            $orderId = null;
        }
        return view('checkout', [
            'categories' => DB::table('categories')->select('*')->get(),
            'subcategories' => DB::table('sub_categories')->select('*')->get(),
            'order_items' => DB::table('order_items')->select('*')->where('order_id', '=', $orderId)->get(),
            'order' => DB::table('orders')->select('*')->where('id', '=', $orderId)->first(),
        ]);
    }
}
