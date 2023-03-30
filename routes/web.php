<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productcontroller;
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

Route::get('/', function () {

    //Product::factory()->count(20)->create();
    //Category::factory()->count(6)->create();
    return view('home', [
        'categories' => DB::table('categories')->select('*')->get(),
        'subcategories' => DB::table('sub_categories')->select('*')->get(),
        'products' => DB::table('products')->select('*')->get(),
    ]);
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/products/{categoryName}/{subCategoryName}', function (string $categoryName, string $subCategoryName) {
    $category = Category::select('*')->where('name', '=', $categoryName)->first();
    $categoryID = $category['id'];
    //return $category;
    $subCategory = SubCategory::select('id')->where('name', '=', $subCategoryName)->where('category_id', '=', $categoryID)->first();
    $subCategoryID = $subCategory['id'];
    return view('itemList', [
        'products' => DB::table('products')->select('*')->where('sub_category_id', '=', $subCategoryID)->get(),
    ]);

});