<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Webmozart\Assert\Tests\StaticAnalysis\length;

class ReviewController extends Controller
{
    public function addReview(Request $request)
    {
        try {
            $request->validate([
                'rating' => ['required', 'numeric', 'min:1'],
            ]);
        } catch (\Throwable $e) {
            return redirect()->back()->with('message', 'Véleményezés nem sikerült!');
        }

        $input = $request->all();
        $desc = '';
        if ($request->has('description')) {
            $desc = $input['description'];
        }
        Review::create([
            'user_name' => Auth::user()->name,
            'product_id' => $input['product_id'],
            'description' => $desc,
            'star' => $input['rating']
        ]);
        $product = Product::find($input['product_id']);
        if ($product->avg_stars == 0) {
            $product->avg_stars = $input['rating'];
        } else {
            $reviews = Review::select('*')->where('product_id', 'like', $product->id)->get();
            $sum = 0;
            foreach ($reviews as $review) {
                $sum += $review->star;
            }
            $product->avg_stars = $sum / count($reviews);
        }
        $product->review_count++;
        $product->save();
        return redirect()->back()->with('message', 'Értékelés hozzáadva');
    }
}
