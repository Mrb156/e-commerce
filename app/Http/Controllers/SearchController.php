<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request): \Illuminate\Database\Eloquent\Collection|array
    {
        $search = $request->input('searchTerm');
        $categoryId = $request->input('categoryId');
        $subCategoryId = $request->input('subCategoryId');

        return Product::query()
            ->where('name', 'like', "%{$search}%")
//            ->where('category_id', 'like', $categoryId)
//            ->where('sub_category_id', 'like', $subCategoryId)
            ->get();
    }
}
