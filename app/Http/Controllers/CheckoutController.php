<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function Webmozart\Assert\Tests\StaticAnalysis\length;

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
        $order_items = DB::table('order_items')->select('*')->where('order_id', '=', $orderId)->get();
        if ($order_items->isEmpty()) {
            return redirect(route('home'))->with('message', 'Nincs semmi a kosaradban.');
        } else {
            return view('checkout', [
                'categories' => DB::table('categories')->select('*')->get(),
                'subcategories' => DB::table('sub_categories')->select('*')->get(),
                'order_items' => $order_items,
                'order' => DB::table('orders')->select('*')->where('id', '=', $orderId)->first(),
            ]);
        }
    }
}
