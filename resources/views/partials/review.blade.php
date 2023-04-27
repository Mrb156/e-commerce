{{--Add review--}}
<script src="https://cdn.tailwindcss.com?plugins=forms"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js"></script>
<div x-data="{rating: 0, hovering: 0}">
    <form method="POST" action="{{route('review.add',['product_id'=>$product->id] )}}">
        @csrf
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12 px-4 sm:px-8 max-w-5xl m-auto">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Értékelés</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">Mondd el, hogy mit gondolsz erről a termékről!</p>
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <h1 class="font-bold text-indigo-600 text-xl">Hogyan értékeled a terméket?</h1>
                        <div>
                            <div class="flex items-center"
                            >
                                <svg aria-hidden="true" class="w-10 h-10" fill="currentColor"
                                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                                     x-bind:class="rating >= 1 ? 'text-yellow-400' : 'text-gray-300'"
                                     x-on:click="rating = 1"
                                     x-on:mouseover="hovering = 1"
                                     x-on:mouseleave="hovering = 0"
                                ><title>First star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                <svg aria-hidden="true" class="w-10 h-10" fill="currentColor"
                                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                                     x-bind:class="rating >= 2 ? 'text-yellow-400' : 'text-gray-300'"
                                     x-on:click="rating = 2"
                                     x-on:mouseover="hovering = 2"
                                     x-on:mouseleave="hovering = 0"
                                ><title>First star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                <svg aria-hidden="true" class="w-10 h-10" fill="currentColor"
                                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                                     x-bind:class="rating >= 3 ? 'text-yellow-400' : 'text-gray-300'"
                                     x-on:click="rating = 3"
                                     x-on:mouseover="hovering = 3"
                                     x-on:mouseleave="hovering = 0"
                                ><title>First star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                <svg aria-hidden="true" class="w-10 h-10" fill="currentColor"
                                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                                     x-bind:class="rating >= 4 ? 'text-yellow-400' : 'text-gray-300'"
                                     x-on:click="rating = 4"
                                     x-on:mouseover="hovering = 4"
                                     x-on:mouseleave="hovering = 0"
                                ><title>First star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                <svg aria-hidden="true" class="w-10 h-10" fill="currentColor"
                                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                                     x-bind:class="rating >= 5 ? 'text-yellow-400' : 'text-gray-300'"
                                     x-on:click="rating = 5"
                                     x-on:mouseover="hovering = 5"
                                     x-on:mouseleave="hovering = 0"
                                ><title>First star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>

                                <input type="hidden" name="rating" id="rating" x-bind:value='rating'>

                            </div>
                        </div>
                    </div>


                    <div class="col-span-full">
                        <label for="description"
                               class="block text-sm font-medium leading-6 text-gray-900">Leírás</label>
                        <div class="mt-2">
                            <textarea id="description" name="description" rows="3"
                                      class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                        </div>
                    </div>

                </div>
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="submit"
                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Értékelés küldése
                    </button>
                </div>
            </div>
        </div>

    </form>
</div>
