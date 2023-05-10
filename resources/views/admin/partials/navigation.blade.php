<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - E-commerce Website</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js"></script>
</head>
<!-- Navigation bar -->
<nav class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center">
                <a href="{{route('home')}}" class="flex-shrink-0">
                    <img class="h-8 w-8" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                         alt="Workflow">
                </a>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="{{route('admin.dashboard')}}"
                           class="{{Route::is('admin.dashboard') ? 'text-indigo-600 hover:text-indigo-600' : 'text-grey-600 hover:text-indigo-400'}} px-3 py-2 rounded-md text-sm font-medium">Kezelőfelület</a>
                        <a href="{{route('admin.products')}}"
                           class="{{Route::is('admin.products') ? 'text-indigo-600 hover:text-indigo-600' : 'text-grey-600 hover:text-indigo-400'}} px-3 py-2 rounded-md text-sm font-medium">Termék
                            hozzáadása </a>
                        <a href="{{route('admin.orders')}}"
                           class="{{Route::is('admin.orders') ? 'text-indigo-600 hover:text-indigo-600' : 'text-grey-600 hover:text-indigo-400'}} px-3 py-2 rounded-md text-sm font-medium">Rendelések</a>
                        <a href="{{route('admin.users')}}"
                           class="{{Route::is('admin.users') ? 'text-indigo-600 hover:text-indigo-600' : 'text-grey-600 hover:text-indigo-400'}} px-3 py-2 rounded-md text-sm font-medium">Felhasználók</a>
                    </div>
                </div>
            </div>
            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">
                    <!-- Profile dropdown -->
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
                                       id="menu-item-0">{{Auth::user()->name}}</a>
                                    <a class="text-gray-700 block px-4 py-2 text-sm"
                                       role="menuitem" tabindex="-1"
                                       id="menu-item-1">{{Auth::user()->email}}</a>
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
                </div>
            </div>
        </div>
    </div>
</nav>
