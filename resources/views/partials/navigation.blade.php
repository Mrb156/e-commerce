<script src="https://cdn.tailwindcss.com?plugins=forms"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js"></script>

<header class="relative bg-white">
    <nav aria-label="Top" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="border-b border-gray-200">
            <div class="flex h-16 items-center">
                <!-- Mobile menu toggle, controls the 'mobileMenuOpen' state. -->
                <button type="button" class="rounded-md bg-white p-2 text-gray-400 lg:hidden">
                    <span class="sr-only">Open menu</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                         aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                    </svg>
                </button>

                <!-- Logo -->
                <div class="ml-4 flex lg:ml-0">
                    <a href="/">
                        <span class="sr-only">Your Company</span>
                        <img class="h-8 w-auto"
                             src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="">
                    </a>
                </div>

                <!-- Flyout menus -->
                @foreach($categories as $category)
                    <div class="hidden lg:ml-8 lg:block lg:self-stretch">
                        <div class="flex h-full space-x-8">
                            <div class="flex" x-data="{ show: false }">
                                <div class="relative flex">
                                    <button @click="show = !show" type="button"
                                            :class="show ? 'border-indigo-600 text-indigo-600':'border-transparent text-gray-700 hover:text-gray-800'"
                                            class=" relative z-10 -mb-px flex items-center border-b-2 pt-px text-sm font-medium transition-colors duration-200 ease-out"
                                            aria-expanded="false">{{$category->name}}</button>
                                </div>

                                <div x-show="show" @click.outside="show = false"
                                     class="absolute inset-x-0 top-full text-sm text-gray-500">
                                    <!-- Presentational element used to render the bottom shadow, if we put the shadow on the actual panel it pokes out the top, so we use this shorter element to hide the top of the shadow -->
                                    <div class="absolute inset-0 top-1/2 bg-white shadow" aria-hidden="true"></div>

                                    <div class="relative bg-white">
                                        <div class="mx-auto max-w-7xl px-8">
                                            <div class="grid grid-cols-2 gap-y-10 gap-x-8 py-16">
                                                <div class="row-start-1 gap-y-10 gap-x-8 text-sm">
                                                    <p id="Clothing-heading" class="font-medium text-gray-900">
                                                        Alkategóriák</p>
                                                    <ul role="list" aria-labelledby="Clothing-heading"
                                                        class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                                                        @foreach($subcategories as $subcategory)
                                                            @if($subcategory->category_id == $category->id)
                                                                <li class="flex">
                                                                    <a href="/products/{{$category->name}}/{{$subcategory->name}}"
                                                                       class="hover:text-gray-800">{{$subcategory->name}}</a>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                @endforeach

                <div class="ml-auto flex items-center">
                    <div class="hidden lg:flex lg:flex-1 lg:items-center lg:justify-end lg:space-x-6">
                        <a href="/login" class="text-sm font-medium text-gray-700 hover:text-gray-800">Sign in</a>
                        <span class="h-6 w-px bg-gray-200" aria-hidden="true"></span>
                        <a href="#" class="text-sm font-medium text-gray-700 hover:text-gray-800">Create account</a>
                    </div>

                    <!-- Search -->
                    <div class="flex lg:ml-6">
                        @include('partials.search')
                    </div>

                    <!-- Cart -->
                    <div class="ml-4 flow-root lg:ml-6">
                        <a href="#" class="group -m-2 flex items-center p-2">
                            <svg class="h-6 w-6 flex-shrink-0 text-gray-400 group-hover:text-gray-500" fill="none"
                                 viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                            </svg>
                            <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-gray-800">0</span>
                            <span class="sr-only">items in cart, view bag</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

</header>
