<form
    action="{{route("home")}}"
    {{--    action="{{route("all", ['categoryName'=>$category->name, 'subCategoryName'=>$subcategory->name])}}"--}}
    method="GET"
    role="search"
    class="w-full max-w-lg">
    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                First Name
            </label>
            <input
                type="text"
                id="searchTerm"
                name="searchTerm"
                class="relative m-0 block w-[100%] min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-1.5 text-base font-normal text-neutral-700 outline-none transition duration-300 ease-in-out focus:border-primary-600 focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200"
                placeholder="Search"
                aria-label="Search"
                aria-describedby="button-addon2"/>
        </div>
        {{--        <div class="w-full md:w-1/2 px-3">--}}
        {{--            <button type="submit" class="p-2 text-gray-400 hover:text-gray-500">--}}
        {{--                <span class="sr-only">Search</span>--}}
        {{--                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"--}}
        {{--                     stroke="currentColor" aria-hidden="true">--}}
        {{--                    <path stroke-linecap="round" stroke-linejoin="round"--}}
        {{--                          d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>--}}
        {{--                </svg>--}}
        {{--            </button>--}}

        {{--        </div>--}}
    </div>
</form>

