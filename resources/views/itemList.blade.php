
@foreach($products as $product)
    <a href="#" class="group pb-200">
        <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">
            <img src="https://tailwindui.com/img/ecommerce-images/category-page-04-image-card-01.jpg" alt="Tall slender porcelain bottle with natural clay textured body and cork stopper." class="h-full w-full object-cover object-center group-hover:opacity-75">
        </div>
        <h3 class="mt-4 text-sm text-gray-700">{{$product->name}}</h3>
        <p class="mt-1 text-lg font-medium text-gray-900">{{$product->price}} Ft</p>
    </a>
@endforeach
