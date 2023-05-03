<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {

        $categoris = Category::where('parent_id', 0)->get();

        return view('category', ["categoris" => $categoris]);
    }

    public function subCat(Request $request)
    {
        $input = $request->all();
        $parent_id = $input['cat_id'];

        $subcategories = SubCategory::select('*')->where('category_id', 'like', $parent_id)->get();
        return response()->json([
            'subcategories' => $subcategories
        ]);
    }
}
