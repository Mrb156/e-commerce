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
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\GraphViz\Exception;

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
        return redirect()->back()->with('message', 'Megrendelés törölve!');
    }

    public function getUsers()
    {
        return view('admin.users', [
            'users' => User::select('*')->get(),
        ]);
    }

    public function addProduct(Request $request)
    {
        try {
            $request->validate([
                'prod_name' => ['required'],
                'description' => ['required'],
                'price' => ['required'],
            ]);
        } catch (\Throwable $e) {
            return redirect()->back()->with('message', 'Terméklétrehozás nem sikerült!');
        }

        $input = $request->all();
        if ($input['category'] == "new" and !$request->has('new_category') or $input['category'] != "new" and $request->has('new_category')) {
            return redirect()->back()->with('message', 'Adj meg főkategóriát!');
        } else if ($input['subcategory'] == "new" and !$request->has('new_sub_category') or $input['subcategory'] != "new" and $request->has('new_sub_category')) {
            return redirect()->back()->with('message', 'Adj meg alkategóriát!');
        }

        try {

            if (!$request->has('new_category')) {
                $category_id = Category::select('*')->where('id', 'like', $input['category'])->first()->id;
                if (!$request->has('new_sub_category')) {
                    $sub_category_id = SubCategory::select('*')->where('id', 'like', $input['subcategory'])->first()->id;
                } else {
                    $new_sub = SubCategory::create([
                        'name' => $input['new_sub_category'],
                        'category_id' => $category_id,
                    ]);
                    $sub_category_id = $new_sub->id;
                }
            } else {
                $new_cat = Category::create([
                    'name' => $input['new_category'],
                ]);
                $category_id = $new_cat->id;
                if (!$request->has('new_sub_category')) {
                    $sub_category_id = SubCategory::select('*')->where('id', 'like', $input['subcategory'])->first()->id;
                } else {
                    $new_sub = SubCategory::create([
                        'name' => $input['new_sub_category'],
                        'category_id' => $category_id,
                    ]);
                    $sub_category_id = $new_sub->id;
                }
            }

        } catch (\Throwable $e) {
            return redirect()->back()->with('message', 'Rosszul adtad meg a kategóriát vagy az alkategóriát!');

        }
        $product = Product::create([
            'name' => $input['prod_name'],
            'description' => $input['description'],
            'price' => $input['price'],
            'category_id' => $category_id,
            'sub_category_id' => $sub_category_id,
            'review_count' => 0,
            'avg_stars' => 0,
        ]);

        try {
            if ($request->hasFile('imageUp')) {
                $request->validate([
                    'imageUp' => ['nullable', 'image'],
                ]);
                $imageFile = $request->file('imageUp');
                $basePath = 'uploads/products';
                $extension = $imageFile->getClientOriginalExtension();
                $fileName = time() . '.' . $extension;
                $imageFile->move($basePath, $fileName);
                $finalImagePathName = $basePath . '/' . $fileName;

                $product->update([
                    'image' => $finalImagePathName,
                ]);

            }
        } catch (\Throwable $e) {
            return redirect()->back()->with('message', 'Fájlfeltöltés nem sikerült');
        }
        return redirect()->back()->with('message', 'Termék létrehozva!');

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
        if (File::exists($product->image)) {
            File::delete($product->image);
        }
        return redirect()->back()->with('message', 'Termék törölve!');
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
        return redirect()->back()->with('message', 'Felhasználó törölve!');
    }
}
