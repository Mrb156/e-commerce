<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - E-commerce Website</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<!-- Navigation bar -->
<nav class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center">
                <a href="#" class="flex-shrink-0">
                    <img class="h-8 w-8" src="https://tailwindui.com/img/logos/workflow-mark-on-white.svg"
                         alt="Workflow">
                </a>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="#"
                           class="px-3 py-2 rounded-md text-sm font-medium text-gray-900 bg-gray-200 hover:bg-gray-300">Dashboard</a>
                        <a href="#"
                           class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Products</a>
                        <a href="#"
                           class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Orders</a>
                        <a href="#"
                           class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Customers</a>
                    </div>
                </div>
            </div>
            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">
                    <button
                        class="p-1 border-2 border-transparent text-gray-400 rounded-full hover:text-gray-500 focus:outline-none focus:text-gray-500 focus:bg-gray-100 transition duration-150 ease-in-out">
                        <span class="sr-only">View notifications</span>
                        <!-- Heroicon name: bell -->
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </button>

                    <!-- Profile dropdown -->
                    <div class="ml-3 relative">
                        <div>
                            <button
                                class="max-w-xs bg-gray-800 rounded-full flex items-center text-sm focus:outline-none focus:shadow-solid"
                                id="user-menu" aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>
                                <img class="h-8 w-8 rounded-full" src="https://randomuser.me/api/portraits/women/68.jpg"
                                     alt="">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
