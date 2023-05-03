<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 9 jquery ajax categories and subcategories, select dropdown</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
</head>

@include('admin.partials.navigation')
<script src="https://cdn.tailwindcss.com?plugins=forms"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js"></script>
@include('partials.alert')
<body>

<form method="POST" action="{{route("product.add")}}">
    @csrf
    <div class="min-h-screen p-6 bg-gray-100 flex justify-center">
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
                            <div x-data="{ showCat: 'new', showSubCat: 'new' }"
                                 class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
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
                                              class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"></textarea>
                                </div>
                                <div class="md:col-span-5">
                                    <label for="number">Termék ára (Ft)</label>
                                    <input type="number" name="price" id="price"
                                           class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value=""/>
                                </div>

                                <div
                                    class="md:col-span-5 grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-5">

                                    <div class="md:col-span-2">
                                        <label for="category">
                                            Főkategória
                                        </label>
                                        <select x-model="showCat" class="browser-default custom-select"
                                                name="category"
                                                id="category">
                                            <option value="new">Új főkategória hozzáadása</option>
                                            @foreach($categories as $category)
                                                <option
                                                    value="{{$category->id}}">{{$category->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label for="subcategory">
                                            Alkategória
                                        </label>
                                        <select x-model="showSubCat" class="browser-default custom-select"
                                                name="subcategory"
                                                id="subcategory">
                                            <option value="new">Új alkategória hozzáadása</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="md:col-span-2">
                                    <input x-bind:disabled="showCat!='new'" type="text" name="new_category"
                                           id="new_category"
                                           class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value=""
                                           x-bind:placeholder="showCat!='new' ? '' : 'Új főkategória neve'"/>
                                </div>

                                <div class="md:col-span-2">
                                    <input x-bind:disabled="showSubCat!='new'" type="text" name="new_sub_category"
                                           id="new_sub_category"
                                           class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value=""
                                           x-bind:placeholder="showSubCat!='new' ? '' : 'Új alkategória neve'"/>
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

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function () {
        $('#category').on('change', function (e) {
            var cat_id = e.target.value;
            $.ajax({
                url: "{{route('subcat')}}",
                type: "POST",
                data: {
                    cat_id: cat_id
                },
                success: function (data) {
                    $('#subcategory').empty();
                    $('#subcategory').append('<option value="new">Új alkategória hozzáadása</option>');
                    $.each(data.subcategories,
                        function (index, subcategory) {
                            $('#subcategory').append('<option value="' + subcategory.id + '">' + subcategory.name + '</option>');
                        })
                }
            })
        });
    });
</script>
</body>

