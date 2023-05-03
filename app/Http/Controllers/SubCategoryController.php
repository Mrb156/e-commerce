<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::get();

        return view('admin.subcategory', compact('subcategories'));
    }
}
