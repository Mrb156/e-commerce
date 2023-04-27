<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PlacedOrder;
use App\Models\PlacedOrderItem;
use App\Models\Product;
use App\Models\Review;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        return view('admin.dashboard', [
            'products' => DB::table('products')->select('*')->get(),
        ]);
    }

    public function getProducts()
    {
        return view('admin.products', [
            'categories' => DB::table('categories')->select('*')->get(),
            'subcategories' => DB::table('sub_categories')->select('*')->get(),
        ]);
    }

    public function getOrders()
    {
        return view('admin.placedOrders', [
            'placed_orders' => PlacedOrder::select('*')->get(),
            'placed_order_items' => PlacedOrderItem::select('*')->get()
        ]);
    }

    public function deleteOrders(Request $request)
    {
        $input = $request->all();
        $order = PlacedOrder::select('*')->where('id', 'like', $input['order_id'])->first();
        $p_order_items = PlacedOrderItem::select('*')->where('placed_order_id', 'like', $order->id)->get();
        foreach ($p_order_items as $item) {
            $item->delete();
        }
        $order->delete();
        return redirect()->back();
    }

    public function getUsers()
    {
        return view('admin.users', [
            'users' => User::select('*')->get(),
        ]);
    }

    public function addProduct(Request $request)
    {
        $input = $request->all();
        $category_id = Category::select('*')->where('name', 'like', $input['category'])->first()->id;
        $sub_category_id = SubCategory::select('*')->where('name', 'like', $input['subcategory'])->first()->id;
        Product::create([
            'name' => $input['prod_name'],
            'description' => $input['description'],
            'price' => $input['price'],
            'imageUrl' => $input['link'],
            'category_id' => $category_id,
            'sub_category_id' => $sub_category_id,
            'review_count' => 0,
            'avg_stars' => 0,
        ]);
        return redirect()->back();
    }

    public function deleteProduct(Request $request)
    {
        $input = $request->all();
        $product = Product::select('*')->where('id', 'like', $input['prod_id'])->first();
        $reviews = Review::select('*')->where('product_id', 'like', $product->id)->get();
        foreach ($reviews as $review) {
            $review->delete();
        }
        $product->delete();
        return redirect()->back();
    }

    public function deleteUser(Request $request)
    {
        $input = $request->all();
        if (Auth::user()->id != $input['user_id']) {
            $user = User::select('*')->where('id', 'like', $input['user_id'])->first();
            $order = Order::select('*')->where('user_id', 'like', $user->id)->first();
            $orderItems = OrderItem::select('*')->where('order_id', 'like', $order->id)->get();
            foreach ($orderItems as $orderItem) {
                $orderItem->delete();
            }
            $order->delete();
            $user->delete();
        }
        return redirect()->back();
    }
}
