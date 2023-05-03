<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function addReview(Request $request)
    {
        $input = $request->all();
        Review::create([
            'user_name' => Auth::user()->name,
            'product_id' => $input['product_id'],
            'description' => $input['description'],
            'star' => $input['rating']
        ]);
        $product = Product::find($input['product_id']);
        if ($product->avg_stars == 0) {
            $product->avg_stars = $input['rating'];
        } else {

            $product->avg_stars = ($product->star + $input['rating']) / 2;
        }
        $product->review_count++;
        $product->save();
        return redirect()->back()->with('message', 'Értékelés hozzáadva');
    }
}
