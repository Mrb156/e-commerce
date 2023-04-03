<script src="https://cdn.tailwindcss.com?plugins=forms"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js"></script>
<div x-data="{ cartShow : false }">
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
                            @if(!\Illuminate\Support\Facades\Auth::check())
                                <a href="{{route('login')}}"
                                   class="text-sm font-medium text-gray-700 hover:text-gray-800">Sign
                                    in</a>
                                <span class="h-6 w-px bg-gray-200" aria-hidden="true"></span>
                                <a href="{{route('register')}}"
                                   class="text-sm font-medium text-gray-700 hover:text-gray-800">Create
                                    account</a>
                                <span class="h-6 w-px bg-gray-200" aria-hidden="true"></span>
                            @endif

                            <!-- Search -->
                            <div class="flex lg:ml-6">
                                @include('partials.search')
                            </div>


                            @if(\Illuminate\Support\Facades\Auth::check())
                                <div x-data="{dropDownShow : false}">
                                    <div class="relative inline-block text-left">
                                        <div>
                                            <button @click="dropDownShow = !dropDownShow"
                                                    @click.outside="dropDownShow = false"
                                                    type="button"
                                                    class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                                                    id="menu-button" aria-expanded="true" aria-haspopup="true">
                                                Fiók
                                                <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                                                     fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                          d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                                          clip-rule="evenodd"/>
                                                </svg>
                                            </button>
                                        </div>

                                        <div x-show="dropDownShow"
                                             class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                             role="menu" aria-orientation="vertical" aria-labelledby="menu-button"
                                             tabindex="-1">
                                            <div class="py-1" role="none">
                                                <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                                                <a class="text-gray-700 block px-4 py-2 text-sm"
                                                   role="menuitem" tabindex="-1"
                                                   id="menu-item-0">{{\Illuminate\Support\Facades\Auth::user()->name}}</a>
                                                <a class="text-gray-700 block px-4 py-2 text-sm"
                                                   role="menuitem" tabindex="-1"
                                                   id="menu-item-1">{{\Illuminate\Support\Facades\Auth::user()->email}}</a>
                                                <form method="POST" action="{{route('logout')}}" role="none">
                                                    @csrf
                                                    <button type="submit"
                                                            class="text-gray-700 block w-full px-4 py-2 text-left text-sm"
                                                            role="menuitem" tabindex="-1" id="menu-item-3">Kijelentkezés
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!-- Cart -->
                                <div class="ml-4 flow-root lg:ml-6">
                                    <button @click="cartShow = true" class="group -m-2 flex items-center p-2">
                                        <svg class="h-6 w-6 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
                                             fill="none"
                                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                             aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                                        </svg>
                                        <span
                                            class="ml-2 text-sm font-medium text-gray-700 group-hover:text-gray-800">0</span>
                                        <span class="sr-only">items in cart, view bag</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
        </nav>

    </header>
    <div x-show="cartShow" @click.outside="cartShow = false">
        <div class="relative z-10" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
            <!--
              Background backdrop, show/hide based on slide-over state.

              Entering: "ease-in-out duration-500"
                From: "opacity-0"
                To: "opacity-100"
              Leaving: "ease-in-out duration-500"
                From: "opacity-100"
                To: "opacity-0"
            -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

            <div class="fixed inset-0 overflow-hidden">
                <div class="absolute inset-0 overflow-hidden">
                    <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                        <!--
                          Slide-over panel, show/hide based on slide-over state.

                          Entering: "transform transition ease-in-out duration-500 sm:duration-700"
                            From: "translate-x-full"
                            To: "translate-x-0"
                          Leaving: "transform transition ease-in-out duration-500 sm:duration-700"
                            From: "translate-x-0"
                            To: "translate-x-full"
                        -->
                        <div class="pointer-events-auto w-screen max-w-md">
                            <div class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
                                <div class="flex-1 overflow-y-auto px-4 py-6 sm:px-6">
                                    <div class="flex items-start justify-between">
                                        <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">Shopping
                                            cart</h2>
                                        <div class="ml-3 flex h-7 items-center">
                                            <button type="button" @click="cartShow = false"
                                                    class="-m-2 p-2 text-gray-400 hover:text-gray-500">
                                                <span class="sr-only">Close panel</span>
                                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                     stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="mt-8">
                                        <div class="flow-root">
                                            <ul role="list" class="-my-6 divide-y divide-gray-200">
                                                <li class="flex py-6">
                                                    <div
                                                        class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                                                        <img
                                                            src="https://tailwindui.com/img/ecommerce-images/shopping-cart-page-04-product-01.jpg"
                                                            alt="Salmon orange fabric pouch with match zipper, gray zipper pull, and adjustable hip belt."
                                                            class="h-full w-full object-cover object-center">
                                                    </div>

                                                    <div class="ml-4 flex flex-1 flex-col">
                                                        <div>
                                                            <div
                                                                class="flex justify-between text-base font-medium text-gray-900">
                                                                <h3>
                                                                    <a href="#">Throwback Hip Bag</a>
                                                                </h3>
                                                                <p class="ml-4">$90.00</p>
                                                            </div>
                                                            <p class="mt-1 text-sm text-gray-500">Salmon</p>
                                                        </div>
                                                        <div class="flex flex-1 items-end justify-between text-sm">
                                                            <p class="text-gray-500">Qty 1</p>

                                                            <div class="flex">
                                                                <button type="button"
                                                                        class="font-medium text-indigo-600 hover:text-indigo-500">
                                                                    Remove
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="flex py-6">
                                                    <div
                                                        class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                                                        <img
                                                            src="https://tailwindui.com/img/ecommerce-images/shopping-cart-page-04-product-02.jpg"
                                                            alt="Front of satchel with blue canvas body, black straps and handle, drawstring top, and front zipper pouch."
                                                            class="h-full w-full object-cover object-center">
                                                    </div>

                                                    <div class="ml-4 flex flex-1 flex-col">
                                                        <div>
                                                            <div
                                                                class="flex justify-between text-base font-medium text-gray-900">
                                                                <h3>
                                                                    <a href="#">Medium Stuff Satchel</a>
                                                                </h3>
                                                                <p class="ml-4">$32.00</p>
                                                            </div>
                                                            <p class="mt-1 text-sm text-gray-500">Blue</p>
                                                        </div>
                                                        <div class="flex flex-1 items-end justify-between text-sm">
                                                            <p class="text-gray-500">Qty 1</p>

                                                            <div class="flex">
                                                                <button type="button"
                                                                        class="font-medium text-indigo-600 hover:text-indigo-500">
                                                                    Remove
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>

                                                <!-- More products... -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-t border-gray-200 px-4 py-6 sm:px-6">
                                    <div class="flex justify-between text-base font-medium text-gray-900">
                                        <p>Subtotal</p>
                                        <p>$262.00</p>
                                    </div>
                                    <p class="mt-0.5 text-sm text-gray-500">Shipping and taxes calculated at
                                        checkout.</p>
                                    <div class="mt-6">
                                        <a href="#"
                                           class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700">Checkout</a>
                                    </div>
                                    <div class="mt-6 flex justify-center text-center text-sm text-gray-500">
                                        <p>
                                            or
                                            <button type="button" @click="cartShow = false"
                                                    class="font-medium text-indigo-600 hover:text-indigo-500">
                                                Continue Shopping
                                                <span aria-hidden="true"> &rarr;</span>
                                            </button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


