<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function removeItemFromCart(Request $request)
    {
        $order = Order::select('*')->where('user_id', '=', Auth::user()->id)->first();
        $id = $request->only('id');
        $orderItem = OrderItem::select()->where('id', '=', $id)->first();
        $updatedOrderPrice = $order->price - $orderItem->price;
        $order->price = $updatedOrderPrice;
        $order->item_count--;
        $order->save();
        $orderItem->delete();
        return redirect()->back();
    }

    public function insertItemToCart(Request $request)
    {
        $order = Order::select('*')->where('user_id', '=', Auth::user()->id)->first();
        $orderId = $order->id;
        $productId = $request->all()['id'];
        $product = Product::select('*')->where('id', 'like', $productId)->first();
        $productPrice = $product->price;
        $quantity = $request->all()['db'];
        $price = $quantity * $productPrice;
        $data = array(
            "order_id" => $orderId,
            "product_id" => $productId,
            "quantity" => $quantity,
            "price" => $price
        );
        $updatedOrderPrice = $order->price + $price;
        OrderItem::create($data);
        $order->price = $updatedOrderPrice;
        $order->item_count++;
        $order->save();

        return redirect()->back();
    }
}
