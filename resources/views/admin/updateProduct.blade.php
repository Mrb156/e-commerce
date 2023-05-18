@include('admin.partials.navigation')
@include('partials.alert')
<script src="https://cdn.tailwindcss.com?plugins=forms"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js"></script>
<form class="mt-10"
      action="{{route('product.update')}}"
      method="POST"
      enctype="multipart/form-data">
    @csrf
    <div class="bg-white">
        <div class="pt-6">
            <nav aria-label="Breadcrumb">
                <ol role="list" class="mx-auto flex max-w-2xl items-center space-x-2 px-4 sm:px-6 lg:max-w-7xl lg:px-8">

                    <li>
                        <div class="flex items-center">
                            <a href="/products/{{$category->name}}"
                               class="mr-2 text-sm font-medium text-gray-900">{{$category->name}}</a>
                            <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" aria-hidden="true"
                                 class="h-5 w-4 text-gray-300">
                                <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z"/>
                            </svg>
                        </div>
                    </li>

                    <li>
                        <div class="flex items-center">
                            <a href="/products/{{$category->name}}/{{$subCategory->name}}"
                               class="mr-2 text-sm font-medium text-gray-900">{{$subCategory->name}}</a>
                            <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" aria-hidden="true"
                                 class="h-5 w-4 text-gray-300">
                                <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z"/>
                            </svg>
                        </div>
                    </li>

                    <li class="text-sm">
                        <a href="#" aria-current="page"
                           class="font-medium text-gray-500 hover:text-gray-600">{{$product->name}}</a>
                    </li>
                </ol>
            </nav>

            <!-- Image gallery -->
            <div class="mx-auto mt-6 max-w-2xl sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:gap-x-8 lg:px-8">

                <div class="aspect-h-4 aspect-w-3 hidden overflow-hidden rounded-lg lg:block">
                    <img src="/{{$product->image}}"
                         alt="Kép nem található"
                         class="h-full w-full object-cover object-center">
                </div>

            </div>

            <!-- Product info -->
            <div
                class="mx-auto max-w-2xl px-4 pb-16 pt-10 sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:grid-rows-[auto,auto,1fr] lg:gap-x-8 lg:px-8 lg:pb-24 lg:pt-16">
                <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
                    <div class="md:col-span-5">
                        <label for="full_name">Termék neve</label>
                        <input type="text" name="prod_name" id="prod_name" required
                               class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="{{$product->name}}"/>
                        <input type="hidden" name="product_id" id="product_id"
                               class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="{{$product->id}}"/>
                    </div>
                </div>

                <!-- Options -->
                <div class="mt-4 lg:row-span-3 lg:mt-0">
                    <div class="md:col-span-5">
                        <label for="number">Termék ára (Ft)</label>
                        <input type="number" name="price" id="price" required
                               class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="{{$product->price}}"/>
                    </div>


                    <!-- Reviews -->
                    <div class="mt-6">
                        <h3 class="sr-only">Vélemények</h3>
                        <div class="flex items-center">
                            <div class="flex items-center">
                                <!-- Active: "text-gray-900", Default: "text-gray-200" -->
                                @for($i = 0; $i < $product->avg_stars; $i++)
                                    <svg class="text-gray-900 h-5 w-5 flex-shrink-0" viewBox="0 0 20 20"
                                         fill="currentColor"
                                         aria-hidden="true">
                                        <path fill-rule="evenodd"
                                              d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                @endfor
                                <p
                                    class="ml-3 text-sm font-medium hover:text-indigo-500">{{$product->avg_stars}}
                                    csillag</p>
                            </div>
                            <a href="#reviews"
                               class="ml-3 text-sm font-medium text-indigo-600 hover:text-indigo-500">{{$product->review_count}}
                                értékelés</a>
                        </div>
                    </div>


                    <button type="submit"
                            class="mt-10 flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Szerkesztés
                    </button>
                    <a href="{{route('admin.dashboard')}}"
                       class="mt-10 flex w-full items-center justify-center rounded-md border border-transparent bg-red-600 px-8 py-3 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        Mégse
                    </a>

                </div>

                <div class="py-10 lg:col-span-2 lg:col-start-1 lg:border-r lg:border-gray-200 lg:pb-16 lg:pr-8 lg:pt-6">
                    <!-- Description and details -->
                    <div>
                        <h3 class="sr-only">Description</h3>

                        <div class="md:col-span-5">
                            <label for="text">Termék leírása</label>
                            <textarea name="description" id="description"
                                      class="h-10 border mt-1 rounded px-4 w-full bg-gray-50">{{$product->description}}</textarea>
                        </div>
                    </div>
                    <div class="md:col-span-5">
                        <label for="imageUp">Új kép feltöltése</label>
                        <input type="file" name="imageUp" id="imageUp"
                               class="w-full"/>
                    </div>
                </div>

            </div>

        </div>
    </div>
</form>
{{--Reviews section--}}
@if(!$reviews->isEmpty())
    @foreach($reviews as $review)
        <div class="m-3" id="reviews">
            <div
                class="grid lg:grid-cols-7 grid-cols-1 items-center px-4 sm:px-8 max-w-5xl m-auto border border-gray-200 rounded overflow-hidden shadow-md">
                <article class="md:col-span-6">
                    <div class="flex items-center mb-4 space-x-4">
                        <div class="space-y-1 font-medium text-sm text-gray-700">
                            <p>{{$review->user_name}}
                                <time datetime="2014-08-16 19:00"
                                      class="block text-sm text-gray-500 dark:text-gray-400">
                                    {{$review->created_at}}
                                </time>
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center mb-1">
                        @for($i = 0; $i < $review->star; $i++)
                            <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor"
                                 viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg"><title></title>
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        @endfor
                    </div>
                    <p class="mb-2 text-gray-500 dark:text-gray-400">{{$review->description}}</p>

                </article>
                <form action="{{route('review.delete')}}" method="POST">
                    @csrf
                    <input type="hidden" value="{{$review->id}}" id="id" name="id">
                    <button type="submit"
                            class="mt-10 flex items-center justify-center rounded-md border border-transparent bg-red-600 px-8 py-3 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        Törlés
                    </button>
                </form>
            </div>
        </div>
    @endforeach
@endif
