<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productcontroller;
use App\Models\Product;
use App\Models\Category;


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

Route::get('/', function () {

    //Product::factory()->count(20)->create();
    //Category::factory()->count(6)->create();
    return view('home');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/products/{category}', function (string $category) {
    //$products = Product::with('category')->where('id', 'categoryId')->get();
    //return view('itemList', compact('products'));
    return view('itemList', [
        //'products2' => Product::with('category')->where('category_id', $category)->get(),
        'products' => DB::table('products')->select('*')->where('category_id', '=',$category)->get(),
    ]);

});
