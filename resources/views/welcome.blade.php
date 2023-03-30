<?php
require base_path('resources/partials/navigation.blade.php');
use Illuminate\Support\Facades\DB;
$products = DB::select('select * from products');
?>
<div class="bg-white">
    <div class="mx-auto max-w-2xl py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
        <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
            @foreach($products as $product)
            <div class="group relative">
                <div class="min-h-80 aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md bg-gray-200 group-hover:opacity-75 lg:aspect-none lg:h-80">
                    <img src="https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-01.jpg" alt="Front of men&#039;s Basic Tee in black." class="h-full w-full object-cover object-center lg:h-full lg:w-full">
                </div>
                <div class="mt-4 flex justify-between">
                    <div>
                        <h3 class="text-sm text-gray-700">
                            <a href="#">
                                <span aria-hidden="true" class="absolute inset-0"></span>
                                {{$product->name}}
                            </a>
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">{{$product->desc}}</p>
                    </div>
                    <p class="text-sm font-medium text-gray-900">{{$product->price}} Ft</p>
                </div>
            </div>
            @endforeach
            <!-- More products... -->
        </div>
    </div>
</div>