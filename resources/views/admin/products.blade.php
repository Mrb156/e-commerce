@include('admin.partials.navigation')
<script src="https://cdn.tailwindcss.com?plugins=forms"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js"></script>
<!-- component -->
<form method="POST" action="{{route("product.add")}}">
    @csrf
    <div class="min-h-screen p-6 bg-gray-100 flex items-center justify-center">
        <div class="container max-w-screen-lg mx-auto">
            <div>
                <h2 class="font-semibold text-xl text-gray-600">Termék hozzáadása</h2>
                <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                        <div class="text-gray-600">
                            <p class="font-medium text-lg">Termék információi</p>
                            <p>Töltse ki az összes mezőt</p>
                        </div>

                        <div class="lg:col-span-2">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                <div class="md:col-span-5">
                                    <label for="full_name">Termék neve</label>
                                    <input type="text" name="prod_name" id="prod_name"
                                           class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value=""/>
                                </div>
                                <div class="md:col-span-5">
                                    <label for="link">Kép linkje</label>
                                    <input type="text" name="link" id="link"
                                           class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value=""/>
                                </div>

                                <div class="md:col-span-5">
                                    <label for="text">Termék leírása</label>
                                    <textarea name="description" id="description"
                                              class="h-10 border mt-1 rounded px-4 w-full bg-gray-50">
                                </textarea>
                                </div>
                                <div class="md:col-span-4">
                                    <label for="number">Termék ára</label>
                                    <input type="number" name="price" id="price"
                                           class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" Ft/>
                                </div>
                                <div class="md:col-span-1 text-3xl font-medium leading-tight content-center">
                                    <div>
                                        <h1>
                                            Ft
                                        </h1>
                                    </div>

                                </div>

                                <div class="md:col-span-2">
                                    <label for="category">
                                        Főkategória
                                    </label>
                                    <select name="category" id="category">
                                        @foreach($categories as $category)
                                            <option value="{{$category->name}}">{{$category->name}}</option>
                                        @endforeach
                                        {{--                                    <option value="add">Új hozzáadása</option>--}}
                                    </select>
                                </div>
                                <div class="md:col-span-2">
                                    <label for="subcategory">
                                        Alkategória
                                    </label>
                                    <select name="subcategory" id="subcategory">
                                        @foreach($subcategories as $subcategory)
                                            <option value="{{$subcategory->name}}">{{$subcategory->name}}</option>
                                        @endforeach
                                        {{--                                    <option value="add">Új hozzáadása</option>--}}
                                    </select>
                                </div>

                                <div class="md:col-span-5 text-right">
                                    <div class="inline-flex items-end">
                                        <button type="submit"
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Feltöltés
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
