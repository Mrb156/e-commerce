<!-- component -->
<!DOCTYPE html>
<html class="border-l" lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        fieldset label span {
            min-width: 125px;
        }

        fieldset .select::after {
            content: '';
            position: absolute;
            width: 9px;
            height: 5px;
            right: 20px;
            top: 50%;
            margin-top: -2px;
            background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='9' height='5' viewBox='0 0 9 5'><title>Arrow</title><path d='M.552 0H8.45c.58 0 .723.359.324.795L5.228 4.672a.97.97 0 0 1-1.454 0L.228.795C-.174.355-.031 0 .552 0z' fill='%23CFD7DF' fill-rule='evenodd'/></svg>");
            pointer-events: none;
        }
    </style>
</head>
<body>
@include('partials.navigation')
<div class="h-screen grid grid-cols-3">
    <div class="lg:col-span-2 col-span-3 bg-indigo-50 space-y-8 px-12">
        <div class="mt-8 p-4 relative flex flex-col sm:flex-row sm:items-center bg-white shadow rounded-md">
            <div class="flex flex-row items-center border-b sm:border-b-0 w-full sm:w-auto pb-4 sm:pb-0">
                <div class="text-yellow-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 sm:w-5 h-6 sm:h-5" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="text-sm font-medium ml-3">Fizetés</div>
            </div>
            <div class="text-sm tracking-wide text-gray-500 mt-4 sm:mt-0 sm:ml-4">Töltsd ki az alábbi mezőket a
                fizetéshez.
            </div>
            <div
                class="absolute sm:relative sm:top-auto sm:right-auto ml-auto right-4 top-4 text-gray-400 hover:text-gray-800 cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </div>
        </div>
        <div class="rounded-md">
            <form id="payment-form" method="POST" action="{{route('order.delete')}}">
                @csrf
                <section>
                    <h2 class="uppercase tracking-wide text-lg font-semibold text-gray-700 my-2">Fizetési és szállítási
                        információk</h2>
                    <fieldset class="mb-3 bg-white shadow-lg rounded text-gray-600">
                        <label class="flex border-b border-gray-200 h-12 py-3 items-center">
                            <span class="text-right px-2">Név</span>
                            <input name="name" class="focus:outline-none px-3"
                                   required="" value="{{\Illuminate\Support\Facades\Auth::user()->name}}">
                        </label>
                        <label class="flex border-b border-gray-200 h-12 py-3 items-center">
                            <span class="text-right px-2">Email</span>
                            <input name="Email" class="focus:outline-none px-3"
                                   required="" value="{{\Illuminate\Support\Facades\Auth::user()->email}}">
                        </label>
                        <label class="flex border-b border-gray-200 h-12 py-3 items-center">
                            <span class="text-right px-2">Szállítási cím</span>
                            <input name="address" class="focus:outline-none px-3">
                        </label>
                        <label class="flex border-b border-gray-200 h-12 py-3 items-center">
                            <span class="text-right px-2">Város</span>
                            <input name="city" class="focus:outline-none px-3">
                        </label>
                        <label class="inline-flex w-2/4 border-gray-200 py-3">
                            <span class="text-right px-2">Megye</span>
                            <input name="county" class="focus:outline-none px-3">
                        </label>
                        <label
                            class="xl:w-1/4 xl:inline-flex py-3 items-center flex xl:border-none border-t border-gray-200 py-3">
                            <span class="text-right px-2 xl:px-0 xl:text-none">Irányítószám</span>
                            <input name="zip" class="focus:outline-none px-3">
                        </label>
                        <label class="flex border-t border-gray-200 h-12 py-3 items-center select relative">
                            <span class="text-right px-2">Ország</span>
                            <div id="country" class="focus:outline-none px-3 w-full flex items-center">
                                <select name="country"
                                        class="border-none bg-transparent flex-1 cursor-pointer appearance-none focus:outline-none">
                                    <option value="HU" selected="selected">Magyarország</option>
                                    <option value="AU">Ausztrália</option>
                                    <option value="BE">Belgium</option>
                                    <option value="BR">Brazília</option>
                                    <option value="CA">Kanada</option>
                                    <option value="CN">Kína</option>
                                    <option value="DK">Dánia</option>
                                    <option value="FI">Finnország</option>
                                    <option value="FR">Franciaország</option>
                                    <option value="DE">Németország</option>
                                    <option value="HK">Hongkong</option>
                                    <option value="IE">Írország</option>
                                    <option value="IT">Olaszország</option>
                                    <option value="JP">Japán</option>
                                    <option value="LU">Luxemburg</option>
                                    <option value="MX">Mexikó</option>
                                    <option value="NL">Hollandia</option>
                                    <option value="PL">Lengyelország</option>
                                    <option value="PT">Portugália</option>
                                    <option value="SG">Szingapúr</option>
                                    <option value="ES">Spanyolország</option>
                                    <option value="TN">Tunézia</option>
                                    <option value="GB">Egyesült Királyság</option>
                                    <option value="US">Egyesült Államok</option>
                                </select>
                            </div>
                        </label>
                    </fieldset>
                </section>
                <button
                    type="submit"
                    class="submit-button px-4 py-3 rounded-full bg-indigo-600 text-white focus:ring focus:outline-none w-full text-xl font-semibold transition-colors">
                    Fizetés {{$order->price}} Ft
                </button>
            </form>
        </div>
        <div class="rounded-md">
            <section>
                <h2 class="uppercase tracking-wide text-lg font-semibold text-gray-700 my-2">Fizetési információ</h2>
                <div>
                    Fizetni csak helyben kézpénzzel, vagy előre utalással lehetséges.
                </div>
            </section>
        </div>

    </div>
    <div class="col-span-1 bg-white lg:block hidden">
        <h1 class="py-6 border-b-2 text-xl text-gray-600 px-8">Rendelés</h1>
        <ul class="py-6 border-b space-y-6 px-8">
            @foreach($order_items as $order_item)
                <li class="grid grid-cols-6 gap-2 border-b-1">
                    <div class="col-span-1 self-center">
                        <img
                            src="/{{ DB::table('products')->select('*')->where('id', '=', $order_item->product_id)->first()->image }}"
                            alt="Product" class="rounded w-full">
                    </div>
                    <div class="flex flex-col col-span-3 pt-2">
                        <span
                            class="text-gray-600 text-md font-semi-bold">{{DB::table('products')->select('*')->where('id', '=', $order_item->product_id)->first()->name}}</span>

                    </div>
                    <div class="col-span-2 pt-3">
                        <div class="flex items-center space-x-2 text-sm justify-between">
                            <span class="text-gray-400">{{$order_item->quantity}} x {{DB::table('products')->select('*')->where('id', '=', $order_item->product_id)->first()->price}} Ft</span>
                            <span class="text-indigo-600 font-semibold inline-block">{{$order_item->price}} Ft</span>
                        </div>
                    </div>
                </li>
            @endforeach

        </ul>
        <div class="px-8 border-b">
            <div class="flex justify-between py-4 text-gray-600">
                <span>Részösszeg</span>
                <span class="font-semibold text-indigo-600">{{$order->price}} Ft</span>
            </div>
            <div class="flex justify-between py-4 text-gray-600">
                <span>Szállítás</span>
                <span class="font-semibold text-indigo-600">Ingyenes</span>
            </div>
        </div>
        <div class="font-semibold text-xl px-8 flex justify-between py-8 text-gray-600">
            <span>Teljes összeg</span>
            <span>{{$order->price}} Ft</span>
        </div>
    </div>
</div>
</body>
</html>
