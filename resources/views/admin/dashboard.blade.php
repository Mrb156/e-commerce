@include('admin.partials.navigation')
<script src="https://cdn.tailwindcss.com?plugins=forms"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js"></script>
<!-- component -->
<div class="mt-3">
    <div class="px-4 sm:px-8 max-w-5xl m-auto">
        <h1 class="text-center font-semibold text-sm">Összes termék</h1>
        <ul class="border border-gray-200 rounded overflow-hidden shadow-md lg:grid-cols-3">
            @foreach($products as $product)
                <li class="px-4 py-2 bg-white border-b last:border-none border-gray-200">
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-4 items-center">
                        <img src="{{$product->imageUrl}}" alt=""
                             class="h-25 w-20 object-fill object-center">
                        <h3 class="mt-4 text-sm text-gray-700">{{$product->name}}</h3>
                        <h3 class="mt-4 text-sm text-gray-700">{{$product->description}}</h3>
                        <form method="POST" action="{{route('product.delete', ['prod_id'=>$product->id])}}">
                            @csrf
                            <button
                                type="submit"
                                class="inline-block rounded bg-red-600 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-red-600 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-red-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-red-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]">
                                Törlés
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>

