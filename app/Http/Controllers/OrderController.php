<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PlacedOrder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PlacedOrderItem;
use App\Models\Product;
use Database\Factories\OrderFactory;
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

    public function archiveOrder(Request $request)
    {
        $input = $request->all();
        $order = Order::select('*')->where('user_id', '=', Auth::user()->id)->first();
        $orderItems = OrderItem::select('*')->where('order_id', 'like', $order->id)->get();
        PlacedOrder::create([
            'user_id' => Auth::user()->id,
            'price' => $order->price,
            'item_count' => $order->item_count,
            'address' => $input['address'],
            'city' => $input['city'],
            'zip' => $input['zip'],
            'county' => $input['county'],
        ]);
        $placedOrder = PlacedOrder::select('*')->where('user_id', 'like', Auth::user()->id)->first();
        foreach ($orderItems as $orderItem) {
            PlacedOrderItem::create([
                "placed_order_id" => $placedOrder->id,
                "product_id" => $orderItem->product_id,
                "quantity" => $orderItem->quantity,
                "price" => $orderItem->price
            ]);
            $orderItem->delete();
        }
        $order->delete();
        Order::factory()->create();
        return redirect()->route('home')->with('message', 'Megrendelés leadva!');
    }
}
