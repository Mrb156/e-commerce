@include('admin.partials.navigation')
<script src="https://cdn.tailwindcss.com?plugins=forms"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js"></script>
@include('partials.alert')
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
                                <div class="md:col-span-5">
                                    <label for="number">Termék ára (Ft)</label>
                                    <input type="number" name="price" id="price"
                                           class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value=""/>
                                </div>

                                <div
                                    class="md:col-span-5 grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-5">

                                    <div class="md:col-span-1">
                                        <label for="category">
                                            Főkategória
                                        </label>
                                        <select name="category" id="category">
                                            @foreach($categories as $category)
                                                <option
                                                    value="{{$category->name}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="md:col-span-1">
                                        <label for="subcategory">
                                            Alkategória
                                        </label>
                                        <select name="subcategory" id="subcategory">
                                            @foreach($subcategories as $subcategory)
                                                <option value="{{$subcategory->name}}">{{$subcategory->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="md:col-span-3">
                                    <label for="new_category">Új kategória hozzáadása</label>
                                    <input type="text" name="new_category" id="new_category"
                                           class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value=""/>
                                </div>

                                <div class="md:col-span-2">
                                    <label for="new_sub_category">Új alkategória hozzáadása</label>
                                    <input type="text" name="new_sub_category" id="new_sub_category"
                                           class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value=""/>
                                </div>


                                <script>
                                    function selectConfigs() {
                                        return {
                                            filter: '',
                                            show: false,
                                            selected: null,
                                            focusedOptionIndex: null,
                                            options: {{$categories}},
                                            close() {
                                                this.show = false;
                                                this.filter = this.selectedName();
                                                this.focusedOptionIndex = this.selected ? this.focusedOptionIndex : null;
                                            },
                                            open() {
                                                this.show = true;
                                                this.filter = '';
                                            },
                                            toggle() {
                                                if (this.show) {
                                                    this.close();
                                                } else {
                                                    this.open()
                                                }
                                            },
                                            isOpen() {
                                                return this.show === true
                                            },
                                            selectedName() {
                                                return this.selected ? this.selected.name.first + ' ' + this.selected.name.last : this.filter;
                                            },
                                            classOption(id, index) {
                                                const isSelected = this.selected ? (id == this.selected.login.uuid) : false;
                                                const isFocused = (index == this.focusedOptionIndex);
                                                return {
                                                    'cursor-pointer w-full border-gray-100 border-b hover:bg-blue-50': true,
                                                    'bg-blue-100': isSelected,
                                                    'bg-blue-50': isFocused
                                                };
                                            },
                                            {{--fetchOptions() {--}}
                                                {{--    this.options = {{$categories}}--}}
                                                {{--},--}}
                                            filteredOptions() {
                                                return this.options
                                                    ? this.options.results.filter(option => {
                                                        return (option.name.first.toLowerCase().indexOf(this.filter) > -1)

                                                    })
                                                    : {}
                                            },
                                            onOptionClick(index) {
                                                this.focusedOptionIndex = index;
                                                this.selectOption();
                                            },
                                            selectOption() {
                                                if (!this.isOpen()) {
                                                    return;
                                                }
                                                this.focusedOptionIndex = this.focusedOptionIndex ?? 0;
                                                const selected = this.filteredOptions()[this.focusedOptionIndex]
                                                if (this.selected && this.selected.login.uuid == selected.login.uuid) {
                                                    this.filter = '';
                                                    this.selected = null;
                                                } else {
                                                    this.selected = selected;
                                                    this.filter = this.selectedName();
                                                }
                                                this.close();
                                            },
                                            focusPrevOption() {
                                                if (!this.isOpen()) {
                                                    return;
                                                }
                                                const optionsNum = Object.keys(this.filteredOptions()).length - 1;
                                                if (this.focusedOptionIndex > 0 && this.focusedOptionIndex <= optionsNum) {
                                                    this.focusedOptionIndex--;
                                                } else if (this.focusedOptionIndex == 0) {
                                                    this.focusedOptionIndex = optionsNum;
                                                }
                                            },
                                            focusNextOption() {
                                                const optionsNum = Object.keys(this.filteredOptions()).length - 1;
                                                if (!this.isOpen()) {
                                                    this.open();
                                                }
                                                if (this.focusedOptionIndex == null || this.focusedOptionIndex == optionsNum) {
                                                    this.focusedOptionIndex = 0;
                                                } else if (this.focusedOptionIndex >= 0 && this.focusedOptionIndex < optionsNum) {
                                                    this.focusedOptionIndex++;
                                                }
                                            }
                                        }

                                    }
                                </script>


                                <div class="md:col-span-5">
                                    <div class="w-full px-4">
                                        <div x-data="selectConfigs()"
                                             class="flex flex-col items-center relative">
                                            <div class="w-full">
                                                <div @click.away="close()"
                                                     class="my-2 p-1 bg-white flex border border-gray-200 rounded">
                                                    <input
                                                        x-model="filter"
                                                        x-transition:leave="transition ease-in duration-100"
                                                        x-transition:leave-start="opacity-100"
                                                        x-transition:leave-end="opacity-0"
                                                        @mousedown="open()"
                                                        {{--                                                        @keydown.enter.stop.prevent="selectOption()"--}}
                                                        @keydown.arrow-up.prevent="focusPrevOption()"
                                                        @keydown.arrow-down.prevent="focusNextOption()"
                                                        class="p-1 px-2 appearance-none outline-none w-full text-gray-800">
                                                    <div
                                                        class="text-gray-300 w-8 py-1 pl-2 pr-1 border-l flex items-center border-gray-200">
                                                        <button @click="toggle()"
                                                                class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="100%"
                                                                 height="100%" fill="none" viewBox="0 0 24 24"
                                                                 stroke="currentColor" stroke-width="2"
                                                                 stroke-linecap="round" stroke-linejoin="round">
                                                                <polyline x-show="!isOpen()"
                                                                          points="18 15 12 20 6 15"></polyline>
                                                                <polyline x-show="isOpen()"
                                                                          points="18 15 12 9 6 15"></polyline>
                                                            </svg>

                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div x-show="isOpen()"
                                                 class="absolute shadow bg-white top-100 z-40 w-full lef-0 rounded max-h-select overflow-y-auto svelte-5uyqqj">
                                                <div class="flex flex-col w-full">
                                                    <template x-for="(option, index) in filteredOptions()"
                                                              :key="index">
                                                        <div @click="onOptionClick(index)"
                                                             :class="classOption(option.login.uuid, index)"
                                                             :aria-selected="focusedOptionIndex === index">
                                                            <div
                                                                class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative hover:border-teal-100">
                                                                <div class="w-6 flex flex-col items-center">
                                                                    <div
                                                                        class="flex relative w-5 h-5 bg-orange-500 justify-center items-center m-1 mr-2 w-4 h-4 mt-1 rounded-full ">
                                                                        <img class="rounded-full" alt="A"
                                                                             x-bind:src="option.picture.thumbnail">
                                                                    </div>
                                                                </div>
                                                                <div class="w-full items-center flex">
                                                                    <div class="mx-2 -mt-1"><span
                                                                            x-text="option.name.first + ' ' + option.name.last"></span>
                                                                        <div
                                                                            class="text-xs truncate w-full normal-case font-normal -mt-1 text-gray-500"
                                                                            x-text="option.email"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
