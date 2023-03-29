<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class productcontroller extends Controller
{
    public function index($category){
        $products = DB::table('products')->select('*')->where('categories', '=', $category)->get();
        $data = compact('products');
        return view('itemList')->with('$data');
    }
}
