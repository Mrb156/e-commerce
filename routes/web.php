<?php

use App\Http\Controllers\AuthLoginRegisterController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Support\Facades\DB;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
//Route::get('/', function () {
//    return redirect()->route('all', ['categoryName' => null, 'subCategoryName' => null]);
//})->name('home');

Route::get('/register', [AuthLoginRegisterController::class, 'register'])->name('register');
Route::post('/store', [AuthLoginRegisterController::class, 'store'])->name('store');

Route::get('/login', [AuthLoginRegisterController::class, 'login'])->name('login');
Route::post('/authenticate', [AuthLoginRegisterController::class, 'authenticate'])->name('authenticate');

Route::post('/logout', [AuthLoginRegisterController::class, 'logout'])->name('logout');


Route::post('/removeItemFromCart', [OrderController::class, 'removeItemFromCart'])->name('item.remove');
Route::post('/insertItemToCart', [OrderController::class, 'insertItemToCart'])->name('item.insert');

Route::get('/itemOverview/{id}', function (int $id) {
    if (Auth::check()) {
        $order = Order::select('*')->where('user_id', '=', Auth::user()->id)->first();
        $orderId = $order['id'];

    } else {
        $orderId = null;
    }
    $product = Product::select('*')->where('id', 'like', $id)->first();
    $subCategory = SubCategory::select('*')->where('id', 'like', $product->sub_category_id)->first();
    $category = Category::select('*')->where('id', 'like', $subCategory->category_id)->first();
    return view('overview', [
        'subCategory' => $subCategory,
        'category' => $category,
        'product' => $product,
        'categories' => DB::table('categories')->select('*')->get(),
        'subcategories' => DB::table('sub_categories')->select('*')->get(),
        'order_items' => DB::table('order_items')->select('*')->where('order_id', '=', $orderId)->get(),
        'order' => DB::table('orders')->select('*')->where('id', '=', $orderId)->first(),
    ]);
})->name('itemOverview');


Route::get('/products/{categoryName}/{subCategoryName}', function (string $categoryName, string $subCategoryName) {
    if (Auth::check()) {
        $order = Order::select('*')->where('user_id', '=', Auth::user()->id)->first();
        $orderId = $order['id'];

    } else {
        $orderId = null;
    }
    if ($categoryName != null) {
        $category = Category::select('*')->where('name', 'like', "%{$categoryName}%")->first();
        $categoryID = $category['id'];
    } else {
        $categoryID = '*';
    }
    if ($subCategoryName != null) {
        $subCategory = SubCategory::select('id')->where('name', 'like', "%{$subCategoryName}%")->where('category_id', '=', $categoryID)->first();
        $subCategoryID = $subCategory['id'];
    } else {
        $subCategoryID = '*';
    }
    return view('home', [
        'products' => DB::table('products')->select('*')->where('sub_category_id', '=', $subCategoryID)->get(),
        'categories' => DB::table('categories')->select('*')->get(),
        'subcategories' => DB::table('sub_categories')->select('*')->get(),
        'subcategory' => $subCategory,
        'category' => $category,
        'order_items' => DB::table('order_items')->select('*')->where('order_id', '=', $orderId)->get(),
        'order' => DB::table('orders')->select('*')->where('id', '=', $orderId)->first(),
    ]);

})->name('all');

Route::get('/products/{categoryName}', function (string $categoryName) {
    if (Auth::check()) {
        $order = Order::select('*')->where('user_id', '=', Auth::user()->id)->first();
        $orderId = $order['id'];

    } else {
        $orderId = null;
    }
    $category = Category::select('*')->where('name', '=', $categoryName)->first();
    $categoryID = $category['id'];

    return view('home', [
        'products' => DB::table('products')->select('*')->where('category_id', '=', $categoryID)->get(),
        'categories' => DB::table('categories')->select('*')->get(),
        'subcategories' => DB::table('sub_categories')->select('*')->get(),
        'order_items' => DB::table('order_items')->select('*')->where('order_id', '=', $orderId)->get(),
        'order' => DB::table('orders')->select('*')->where('id', '=', $orderId)->first(),
    ]);

});

Route::get('/checkout', [CheckOutController::class, 'index'])->name('checkout');
Route::post('/payment', [OrderController::class, 'archiveOrder'])->name('order.delete');
