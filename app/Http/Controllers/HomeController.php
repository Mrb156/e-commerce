<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function PHPUnit\TestFixture\func;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function index(Request $request)
    {
        if (Auth::check()) {
            $order = Order::select('*')->where('user_id', '=', Auth::user()->id)->first();
            $orderId = $order['id'];

        } else {
            $orderId = null;
        }

        $search = $request->input('searchTerm');

        $products = Product::query()->where('name', 'like', "%{$search}%")->paginate(10);


        return view('home', [
            'categories' => DB::table('categories')->select('*')->get(),
            'subcategories' => DB::table('sub_categories')->select('*')->get(),
            'products' => $products,
            'order_items' => DB::table('order_items')->select('*')->where('order_id', '=', $orderId)->get(),
            'order' => DB::table('orders')->select('*')->where('id', '=', $orderId)->first(),
        ]);
    }
}
