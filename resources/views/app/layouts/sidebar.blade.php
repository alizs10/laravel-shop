<aside
    class="fixed top-0 lg:top-24 lg:mt-2 z-30 bottom-0 lg:bottom-auto lg:p-0 -right-full lg:right-0 w-3/4 sm:w-1/3 lg:w-full grid grid-cols-12 lg:items-center lg:justify-end lg:shadow-md bg-white dark:bg-gray-800 transition-all duration-300 overflow-y-scroll lg:overflow-visible">
    <div class="lg:hidden col-span-12 pt-2 pb-3  border-gray-100 dark:border-gray-700">
        <span class="text-red-500 font-bold flex items-center gap-x-4 text-xl mr-2">
            <i class="fa-duotone fa-bag-shopping text-2xl"></i>
            فروشگاه لاراول
        </span>
    </div>

    <span class="lg:hidden col-span-12 text-xs font-bold mr-2">منوهای اصلی</span>

    <ul
        class="col-span-12 lg:col-span-11 lg:order-last flex flex-col lg:flex-row lg:gap-x-2 lg:p-0 border-b lg:border-none border-gray-100 text-gray-500 dark:text-gray-400 dark:border-gray-700 h-fit">

        @foreach ($menus as $menu)
            <a href="{{ config('app.url') . '/' . $menu->url }}"
                class="text-sm lg:text-xxs flex items-center gap-x-4 lg:gap-x-2 py-2 lg:p-0 mr-2 lg:pb-1 lg:border-b-2 lg:border-white dark:lg:border-gray-800 lg:hover-transition lg:hover:border-red-500 dark:lg:hover:border-red-500">
                <i class="{{ $menu->icon }} text-lg lg:text-xs"></i>
                {{ $menu->name }}</a>
        @endforeach
       

    </ul>


    <div class="col-span-12 lg:col-span-1 mt-3 lg:m-0">
        <span id="toggleCategories"
            class="col-span-12 lg:col-span-1 lg:block lg:pt-1 lg:flex-center lg:pb-2 lg:text-center text-xxs font-bold lg:cursor-pointer lg:self-center lg:border-l-2 lg:border-b-2 border-gray-100 dark:border-gray-800">دسته
            بندی ها</span>


        <!-- categories for small screens -->
        <ul class="col-span-12 flex flex-col mt-3 lg:hidden">

            {{ categoriesForSmallScreens($product_categories) }}

        </ul>
        <!-- categories for small screens -->



        <!-- categories for big screens -->
        <div id="categories"
            class="hidden absolute top-4 z-20 right-4 left-4 bottom-auto rounded-b-lg overflow-hidden
            col-span-12 flex-col lg:grid-cols-12 bg-white dark:bg-gray-800">

            <!-- cats -->
            <div class="flex flex-col col-span-3 bg-gray-100 dark:bg-gray-900">
                @foreach ($product_categories as $key => $cat)
                    <span id="c-{{ $cat->id }}"
                        class="cat  flex flex-col items-center py-2 cursor-pointer hover-transition @if ($key == 0) cat-active  text-red-500 @endif">
                        <div class="flex justify-between w-full py-2">
                            <span class="text-xs mr-2">{{ $cat->name }}</span>
                            <span class="ml-2 text-xs">
                                <i class="fa-solid fa-angle-left"></i>
                            </span>
                        </div>
                    </span>
                @endforeach
                {{-- <span id="c-1"
                    class="cat cat-active flex flex-col items-center py-2 cursor-pointer hover-transition text-red-500">
                    <div class="flex justify-between w-full py-2">
                        <span class="text-xs mr-2">کالاهای دیجیتال</span>
                        <span class="ml-2 text-xs">
                            <i class="fa-solid fa-angle-left"></i>
                        </span>
                    </div>
                </span>
                <span id="c-2" class="cat flex flex-col items-center py-2 cursor-pointer hover-transition">
                    <div class="flex justify-between w-full py-2">
                        <span class="text-xs mr-2">کالاهای دیجیتال</span>
                        <span class="ml-2 text-xs">
                            <i class="fa-solid fa-angle-left"></i>
                        </span>
                    </div>
                </span> --}}

            </div>
            <!-- cats -->

            <!-- subs -->
            <div class="col-span-9 grid grid-cols-9">
                @foreach ($product_categories as $key => $cat)
                    @foreach ($cat->children as $cat_child)
                        <ul
                            class="cat-sub c-s-{{ $cat_child->parent_id }} @if ($key == 0) c-s-active @else hidden @endif col-span-3 flex flex-col">
                            <span class="flex justify-between py-3 text-red-500 cursor-pointer">
                                <span class="text-xs mr-6">{{ $cat_child->name }}</span>
                            </span>
                            <ul class="w-full flex flex-col">
                                @foreach ($cat_child->children as $cat_child_child)
                                    <a href="" class="mr-10 text-xs py-3">{{ $cat_child_child->name }}</a>
                                @endforeach

                            </ul>
                        </ul>
                    @endforeach
                @endforeach
                {{-- <ul id="c-s-2" class="cat-sub hidden col-span-3 flex flex-col">
                    <span class="flex justify-between py-3 text-red-500 cursor-pointer">
                        <span class="text-xs mr-6">یشبیسبشیب</span>
                    </span>
                    <ul class="w-full flex flex-col">
                        <a href="" class="mr-10 text-xs py-3">شیبشیب</a>
                        <a href="" class="mr-10 text-xs py-3">شسیب</a>
                        <a href="" class="mr-10 text-xs py-3">ییبی</a>
                    </ul>
                </ul> --}}

            </div>
            <!-- subs -->

        </div>
        <!-- categories for big screens -->

    </div>

</aside>
