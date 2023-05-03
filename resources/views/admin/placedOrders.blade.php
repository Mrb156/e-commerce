@include('admin.partials.navigation')
<script src="https://cdn.tailwindcss.com?plugins=forms"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js"></script>
@include('partials.alert')
<div class="mt-3" x-data="{dropDownShow : false}">
    <div class="relative px-4 sm:px-8 max-w-5xl m-auto">
        <h1 class="text-center font-semibold text-sm">Összes leadott rendelés</h1>
        <ul class="relative border border-gray-200 rounded overflow-hidden shadow-md">
            @foreach($placed_orders as $p_order)
                <li
                    class="px-4 py-2 bg-white border-b last:border-none border-gray-200 ">
                    <button @click="dropDownShow = !dropDownShow"
                            @click.outside="dropDownShow = false">
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-7">
                            <h3 class="mt-4 text-sm text-gray-700">{{\Illuminate\Support\Facades\DB::table('users')->select('*')->where('id', 'like',$p_order->user_id)->first()->name}}</h3>
                            <h3 class="mt-4 text-sm text-gray-700">{{$p_order->price}} Ft</h3>
                            <h3 class="mt-4 text-sm text-gray-700">{{$p_order->address}}</h3>
                            <h3 class="mt-4 text-sm text-gray-700">{{$p_order->city}}</h3>
                            <h3 class="mt-4 text-sm text-gray-700">{{$p_order->zip}}</h3>
                            <h3 class="mt-4 text-sm text-gray-700">{{$p_order->county}}</h3>
                        </div>
                    </button>
                    <div x-show="dropDownShow">
                        <ul
                            class="border border-gray-200 rounded overflow-hidden shadow-md lg:grid-cols-4">
                            @foreach($placed_order_items as $order_item)
                                <li class="px-4 py-2 bg-white border-b last:border-none border-gray-200">
                                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-4">
                                        <img class="h-25 w-20 object-fill object-center"
                                             src="{{\Illuminate\Support\Facades\DB::table('products')->select('*')->where('id', 'like', $order_item->product_id)->first()->imageUrl}}">
                                        <h3 class="mt-4 text-sm text-gray-700">{{\Illuminate\Support\Facades\DB::table('products')->select('*')->where('id', 'like', $order_item->product_id)->first()->name}}</h3>
                                        <h3 class="mt-4 text-sm text-gray-700">{{$order_item->quantity}}</h3>
                                        <h3 class="mt-4 text-sm text-gray-700">{{$order_item->price}}</h3>
                                    </div>
                                </li>
                            @endforeach
                            <form method="POST" action="{{route('p_order.delete',['order_id'=>$p_order->id])}}">
                                @csrf
                                <button
                                    type="submit"
                                    class="inline-block rounded bg-green-600 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-green-600 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-green-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]">
                                    Fizetve
                                </button>
                            </form>
                            <form method="POST" action="{{route('p_order.delete',['order_id'=>$p_order->id])}}">
                                @csrf
                                <button
                                    type="submit"
                                    class="inline-block rounded bg-red-600 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-red-600 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-red-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-red-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]">
                                    Rendelés törlése
                                </button>
                            </form>
                        </ul>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>

