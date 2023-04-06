@include('partials.navigation')
<div class="bg-white">
    <!--
Mobile menu

      Off - canvas menu for mobile, show / hide based on off - canvas menu state .
-->

    <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
        <div class="grid grid-cols-1 gap-x-6 gap-y-20 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
            @foreach($products as $product)
                <a href="/itemOverview/{{$product->id}}" class="group">
                    <div
                        class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">
                        <img src="{{$product->imageUrl}}"
                             class="h-full w-full object-cover object-center group-hover:opacity-75">
                    </div>
                    <h3 class="mt-4 text-sm text-gray-700">{{$product->name}}</h3>
                    <p class="mt-1 text-lg font-medium text-gray-900">{{$product->price}} Ft</p>
                </a>
            @endforeach
        </div>
    </div>
</div>
