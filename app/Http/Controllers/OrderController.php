<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function remove(Request $request)
    {

        $id = $request->only('id');
        $orderItem = OrderItem::select()->where('id', '=', $id)->first();
        $orderItem->delete();
        return redirect('/');
    }

    public function insert(Request $request)
    {
        $orderId = Order::select('*')->where('user_id', '=', Auth::user()->id)->first()['id'];
        $productId = $request->input('product_id');
        $productPrice = DB::table('products')->select('*')->where('id', '=', $productId)->first()['price'];
        $quantity = 1;
        $price = $quantity * $productPrice;
        $data = array(
            "order_id" => $orderId,
            "product_id" => $productId,
            "quantity" => $quantity,
            "price" => $price
        );

        OrderItem::create($data);
    }
}
