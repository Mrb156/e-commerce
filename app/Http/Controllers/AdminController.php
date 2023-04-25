<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
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
            'categories' => DB::table('categories')->select('*')->get(),
            'subcategories' => DB::table('sub_categories')->select('*')->get(),
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
        return view('admin.products');
    }

    public function getUsers()
    {
        return view('admin.products');
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
        ]);
        return redirect()->back();
    }
}
