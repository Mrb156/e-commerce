<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthLoginRegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SubCategoryController;
use App\Models\Order;
use App\Models\Review;
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

Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/adminDashboard', [AdminController::class, 'index'])->name('admin.dashboard')->middleware('admin');
Route::post('/deleteProduct', [AdminController::class, 'deleteProduct'])->name('product.delete')->middleware('admin');

Route::get('/adminProducts', [AdminController::class, 'getProducts'])->name('admin.products')->middleware('admin');
Route::post('/addProduct', [AdminController::class, 'addProduct'])->name('product.add')->middleware('admin');


Route::get('/adminOrders', [AdminController::class, 'getOrders'])->name('admin.orders')->middleware('admin');
Route::post('/deleteOrder', [AdminController::class, 'deleteOrders'])->name('p_order.delete')->middleware('admin');

Route::get('/adminUsers', [AdminController::class, 'getUsers'])->name('admin.users')->middleware('admin');
Route::post('/deleteUser', [AdminController::class, 'deleteUser'])->name('user.delete')->middleware('admin');

Route::get('/register', [AuthLoginRegisterController::class, 'register'])->name('register');
Route::post('/store', [AuthLoginRegisterController::class, 'store'])->name('store');

Route::get('/login', [AuthLoginRegisterController::class, 'login'])->name('login');
Route::post('/authenticate', [AuthLoginRegisterController::class, 'authenticate'])->name('authenticate');

Route::post('/logout', [AuthLoginRegisterController::class, 'logout'])->name('logout')->middleware('auth');


Route::post('/removeItemFromCart', [OrderController::class, 'removeItemFromCart'])->name('item.remove')->middleware('auth');
Route::post('/insertItemToCart', [OrderController::class, 'insertItemToCart'])->name('item.insert')->middleware('auth');

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
    $reviews = Review::select('*')->where('product_id', 'like', $product->id)->get();
    return view('overview', [
        'subCategory' => $subCategory,
        'category' => $category,
        'product' => $product,
        'categories' => DB::table('categories')->select('*')->get(),
        'subcategories' => DB::table('sub_categories')->select('*')->get(),
        'order_items' => DB::table('order_items')->select('*')->where('order_id', '=', $orderId)->get(),
        'order' => DB::table('orders')->select('*')->where('id', '=', $orderId)->first(),
        'reviews' => $reviews,
    ]);
})->name('itemOverview');
Route::post('/addReview', [ReviewController::class, 'addReview'])->name('review.add')->middleware('auth');

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
        'products' => DB::table('products')->select('*')->where('sub_category_id', '=', $subCategoryID)->paginate(10),
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
        'products' => DB::table('products')->select('*')->where('category_id', '=', $categoryID)->paginate(10),
        'categories' => DB::table('categories')->select('*')->get(),
        'subcategories' => DB::table('sub_categories')->select('*')->get(),
        'order_items' => DB::table('order_items')->select('*')->where('order_id', '=', $orderId)->get(),
        'order' => DB::table('orders')->select('*')->where('id', '=', $orderId)->first(),
    ]);

});

Route::get('/checkout', [CheckOutController::class, 'index'])->name('checkout')->middleware('auth');
Route::post('/payment', [OrderController::class, 'archiveOrder'])->name('order.delete')->middleware('auth');


Route::get('cat', [CategoryController::class, 'index']);
Route::post('subcat', [CategoryController::class, 'subCat'])->name('subcat');
