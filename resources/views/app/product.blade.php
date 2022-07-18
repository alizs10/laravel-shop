@extends('app.layouts.master')

@section('head-tag')
    <meta name="csrf-token" content="{{ Session::token() }}">
@endsection

@section('content')
    <!-- breadcrumb starts-->
    <section
        class="px-2 py-4 rounded-lg bg-gray-100 dark:bg-gray-800 dark:text-white flex flex-wrap items-center gap-1 md:gap-2">

        <a href="" class="text-xs md:text-base text-red-500">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span href="" class="text-xs md:text-base text-red-500">محصولات</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span href="" class="text-xs md:text-base text-red-500">کالاهای دیجیتال</span>


    </section>
    <!-- breadcrumb ends -->


    <!-- product starts -->

    <section class="mt-4 px-3 py-4 rounded-lg bg-gray-100 dark:bg-gray-800 dark:text-white flex flex-col gap-4">

        <div class="flex flex-wrap items-center justify-between gap-4">
            <span class="text-xs xs:text-base md:text-lg text-red-500">{{ $product->name }}</span>

            <div class="flex items-center gap-x-4">
                <button onclick="addToFavorites(this, 'text-white')"
                    data-url="{{ route('app.user.favorites.toggle', $product->id) }}"
                    class="text-2xl @if (auth()->check()) @if ($product->isFavorite(auth()->user()->id)) text-red-500 @endif @endif">
                    <i class="fa-regular fa-heart"></i>
                </button>
                <button class="text-2xl">
                    <i class="fa-regular fa-bell"></i>
                </button>
                <a href="{{ route('app.compare.index', $product->id) }}" class="text-2xl">
                    <i class="fa-regular fa-code-compare"></i>
                </a>
                <button onclick="copyToClipboard('{{ route('app.product.index', $product->id) }}')" class="text-2xl">
                    <i class="fa-regular fa-share-nodes"></i>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-4">

            <!-- product images slider starts -->
            <section class="col-span-12 h-fit md:col-span-4 grid grid-cols-12 gap-2">

                <section class="relative z-0 col-span-12 bg-white rounded-lg ltr overflow-hidden">

                    <div id="slidershow-imgs" class="w-full flex flex-wrap overflow-hidden">

                        @php
                            $images = collect();
                            $images->push($product->image);
                            foreach ($product->gallery->toArray() as $image) {
                                $images->push($image['image']);
                            }
                            
                        @endphp

                        @foreach ($images as $key => $image)
                            <img id="slider-{{ $key + 1 }}"
                                src="{{ asset('storage\\' . $image['indexArray']['larger']) }}"
                                class="w-full @if ($key == 0) active @else hidden @endif"
                                alt="{{ $product->name }}">
                        @endforeach

                    </div>

                    <div id="s-btns"
                        class="absolute bottom-2 z-0 right-0 left-0 py-3 ml-4 flex justify-start items-center gap-x-2">
                        @foreach ($images as $key => $image)
                            <span id="s-btn-{{ $key + 1 }}"
                                class="transition-all duration-300 shadow-lg @if ($key == 0) bg-red-500 @else bg-white @endif w-4 h-3 rounded-lg cursor-pointer"></span>
                        @endforeach
                    </div>
                </section>

            </section>
            <!-- product images slider ends -->

            <!-- product details starts -->
            <div class="col-span-12 md:col-span-4 flex flex-col gap-3">
                <span class="text-base">ویژگی ها</span>

                @foreach ($product->metas as $meta)
                    <span class="mt-2 flex gap-x-2 items-center text-xxs">
                        <span class="flex gap-x-1 items-start">
                            <i class="fa-regular fa-circle-small text-xs"></i>
                            {{ $meta->meta_key }}:
                        </span>

                        <span class="text-sm"> {{ $meta->meta_value }}</span>
                    </span>
                @endforeach

                @if (count($product_attributes_simple_type) > 0)
                    @foreach ($product_attributes_simple_type as $attr => $attr_values)
                        <span class="mt-2 flex gap-x-2 items-center text-xxs">
                            <span class="flex gap-x-1 items-start">
                                <i class="fa-regular fa-circle-small text-xs"></i>
                                {{ $attr }}:
                            </span>
                            <input type="hidden" name="product_attributes[]" value="{{ $attr_values->id }}">
                            <span class="text-sm">
                                {{ json_decode($attr_values->value)->value . ' ' . $attr_values->attribute->unit }}</span>
                        </span>
                    @endforeach
                @endif

                <span class="mt-2 flex gap-x-2 items-center text-sm">
                    <span class="flex gap-x-1 items-center">
                        <i class="fa-regular fa-shield-check text-lg"></i>

                    </span>

                    <span>گارانتی اصالات و سلامت فیزیکی کالا</span>
                </span>
                <span class="mt-2 flex gap-x-2 items-center text-sm">
                    <span class="flex gap-x-1 items-center">
                        <i class="fa-regular fa-calendar-week text-lg"></i>

                    </span>

                    <span>ضمانت 7 روزه بازگشت کالا</span>
                </span>

                @php
                    $default_attributes = $product->defaultAttributes();
                @endphp

                @if (count($product_attributes_select_type) > 0)
                    @foreach ($product_attributes_select_type as $attr => $attr_values)
                        <span class="mt-2 flex flex-col gap-2 text-sm">
                            <span class="flex gap-x-1 items-center">
                                انتخاب {{ $attr }}
                            </span>


                            @php
                                
                                if ($cartItem && !empty($cartItem->cartItemSelectedAttributes->toArray())) {
                                    $selected_attr = $cartItem
                                        ->cartItemSelectedAttributes()
                                        ->where('category_attribute_id', $attr_values[0]->category_attribute_id)
                                        ->first();
                                }
                                
                            @endphp

                            <select onchange="changeAttributeValue(this)"
                                data-url="{{ route('app.product.get-price', $product->id) }}"
                                class="form-input dark:border-gray-700" name="product_attributes[]"
                                id="product-attribute-{{ $loop->iteration }}">
                                @foreach ($attr_values as $attr_value)
                                    <option class="text-black" value="{{ $attr_value->id }}"
                                        @if ($is_product_in_cart && $selected_attr->category_value_id == $attr_value->id) selected
                                        @elseif($attr_value->id == $default_attributes['category_values'][0]) selected @endif>
                                        {{ json_decode($attr_value->value)->value . ' ' . $attr_value->attribute->unit }}
                                    </option>
                                @endforeach
                            </select>

                        </span>
                    @endforeach
                @endif

                @if ($product->colors->count() > 0)
                    <span class="mt-2 flex flex-col gap-2 text-sm">
                        <span class="flex gap-x-1 items-center">
                            <i class="fa-regular fa-palette text-lg"></i>
                            انتخاب رنگ
                        </span>

                        <div class="flex flex-wrap gap-2" id="product-colors">

                            @foreach ($product->colors as $color)
                                <span onclick="colorSelector(this, {{ $color->id }})"
                                    data-url="{{ route('app.product.get-price', $product->id) }}"
                                    class="cursor-pointer text-xs rounded-lg px-2 py-1 border-2 flex items-center gap-2
                                    @if ($is_product_in_cart && $cartItem->color_id == $color->id) selected @elseif ($default_attributes['color_id'] == $color->id) selected @endif"
                                    style="border-color: {{ '#' . $color->color_code }}">
                                    @if ($is_product_in_cart && $cartItem->color_id == $color->id)
                                        <i class="fa-regular fa-check text-lg text-black dark:text-white"></i>
                                    @elseif ($default_attributes['color_id'] == $color->id)
                                        <i class="fa-regular fa-check text-lg text-black dark:text-white"></i>
                                    @endif
                                    <div class="rounded-full h-3 w-3 
                                    @if ($is_product_in_cart && $cartItem->color_id == $color->id) hidden @elseif ($default_attributes['color_id'] == $color->id) hidden @endif"
                                        style="background-color: {{ '#' . $color->color_code }}">
                                    </div>

                                    {{ $color->color_name }}
                                </span>
                            @endforeach


                        </div>
                    </span>

                    @if ($is_product_in_cart && !empty($cartItem->color_id))
                        <input type="hidden" name="color_id" id="color_id" value="{{ $cartItem->color_id }}" />
                    @else
                        <input type="hidden" name="color_id" id="color_id"
                            value="{{ $product->colors->first()->id }}" />
                    @endif
                @endif

                @php
                    if ($cartItem) {
                        $cartItemAttributes = $cartItem->itemAttributes();
                        $is_marketable = $product->isMarketable($cartItemAttributes, false);
                    } else {
                        $is_marketable = $product->isMarketable([], true);
                    }
                    
                @endphp
                @if ($is_marketable)
                    <span id="marketable-status"
                        class="mt-2 flex gap-x-2 items-center text-sm font-bold text-emerald-700 dark:text-emerald-600">
                        <span class="flex gap-x-1 items-center">
                            <i class="fa-regular fa-check-double text-lg"></i>
                        </span>

                        <span id="marketable-text-status">موجود در انبار</span>
                    </span>
                @else
                    <span id="marketable-status" class="mt-2 flex gap-x-2 items-center text-sm font-bold text-red-500">

                        <span class="flex gap-x-1 items-center">
                            <i class="fa-regular fa-xmark text-lg"></i>
                        </span>

                        <span id="marketable-text-status">نا موجود</span>
                    </span>
                @endif
            </div>
            <!-- product details ends -->

            <!-- add to cart starts -->
            <div class="hidden md:col-span-4 md:block">
                <div class="p-4 rounded-lg overflow-hidden bg-white dark:bg-gray-900 flex flex-col gap-4">
                    @if ($product->ultimate_price > 0)
                        <span class="flex items-start justify-between">
                            <span class="flex items-center gap-2 text-sm">
                                <i class="fa-regular fa-tag text-lg"></i>
                                قیمت محصول
                            </span>

                            <span class="flex flex-col gap-2">
                                @if (!empty($product->amazingSale) || $product->has_public_discount)
                                    <span class="flex gap-2">
                                        <span id="product-price"
                                            class="line-through">{{ price_formater($product->product_price) }}</span>
                                        @if (!empty($product->amazingSale))
                                            <span
                                                class="flex-center rounded-full h-7 w-7 bg-red-500 text-white text-xs">{{ e2p_numbers($product->amazingSale->percentage) }}٪</span>
                                        @else
                                            <span
                                                class="flex-center rounded-full h-7 w-7 bg-red-500 text-white text-xs">{{ e2p_numbers($product->has_public_discount->percentage) }}٪</span>
                                        @endif
                                    </span>
                                @endif
                                @if (!empty($product->amazingSale) || $product->has_public_discount)
                                    <span id="ultimate-price">{{ price_formater($product->ultimate_price) }}
                                        تومان</span>
                                @else
                                    <span id="ultimate-price">{{ price_formater($product->product_price) }} تومان</span>
                                @endif
                            </span>
                        </span>
                    @else
                        <span class="text-xs text-gray-500 flex gap-x-2 items-center">
                            <i class="fa-regular fa-xmark"></i>
                            <span>این محصول ناموجود می باشد</span>
                        </span>
                    @endif


                    <button id="product-toggle-product-btn" onclick="addToCart(this)"
                        data-url="{{ route('app.product.toggle-product', $product->id) }}"
                        class="block py-2 text-center rounded-lg @if ($is_marketable) bg-red-500 @else bg-gray-500 @endif text-white text-sm"
                        @if (!$is_marketable) disabled @endif>

                        @if (!$is_marketable)
                            <span class="flex-center gap-2">
                                <i class="fa-regular fa-bell"></i>
                                <span>موجود شد اطلاع بده!</span>
                            </span>
                        @else
                            @if ($is_product_in_cart)
                                <span class="flex-center gap-2">
                                    <i class="fa-solid fa-check"></i>
                                    <span>موجود در سبد شما</span>
                                </span>
                            @else
                                <span class="flex-center gap-2">
                                    <i class="fa-solid fa-plus"></i>
                                    <span>افزودن به سبد خرید</span>
                                </span>
                            @endif
                        @endif

                    </button>

                </div>
            </div>

            <!-- add to cart ends -->

        </div>

    </section>
    <!-- product ends -->

    <!-- related products starts -->
    @if (count($related_products) > 0)
        <section class="flex flex-col gap-y-2 p-2 rounded-lg mt-4 bg-gray-100 dark:bg-gray-800 text-white">
            <div class="flex justify-between items-center text-black dark:text-white text-base">
                <span>محصولات مرتبط</span>
                <a href="" class="flex-center gap-x-2">
                    <span>بیشتر</span>
                    <i class="fa-duotone fa-arrow-left text-base"></i>
                </a>
            </div>

            <div class="flex flex-row gap-x-2 overflow-x-scroll no-scrollbar">

                @foreach ($related_products as $relatedProduct)
                    <a href="{{ route('app.product.index', $relatedProduct->id) }}"
                        class="flex flex-col gap-y-2 p-2 rounded-lg bg-white text-black">
                        <img class="w-32"
                            src="{{ asset('storage\\' . $relatedProduct->image['indexArray']['medium']) }}"
                            alt="">
                        <div class="flex justify-between items-center">
                            @if (!is_null($relatedProduct->amazingSale))
                                <span class="flex flex-col gap-y-1 text-xs">
                                    <span class="flex gap-x-2 items-center">
                                        <span class="line-through">{{ $relatedProduct->price }}</span>
                                        <div class="h-7 w-7 rounded-lg bg-red-600 text-white flex-center text-xs">
                                            {{ $relatedProduct->amazingSale->percentage }}%</div>
                                    </span>
                                    <span
                                        class="text-red-500 font-bold">{{ $relatedProduct->amazingSale->price }}</span>
                                    <span class="text-red-500 font-bold">تومان</span>
                                </span>
                            @else
                                <span class="flex flex-col gap-y-1 text-xs">
                                    <span>{{ $relatedProduct->price }}</span>
                                    <span class="font-bold">تومان</span>
                                </span>
                            @endif
                            <div class="flex flex-col items-center gax-y-2">
                                <button onclick="addToFavorites(this)"
                                    class="text-gray-700 w-10 h-10 rounded-lg text-xl hover-transition hover:bg-gray-200">
                                    <i class="fa-regular fa-heart"></i>
                                </button>
                                <button onclick="addToCart(this)"
                                    class="text-gray-700 w-10 h-10 rounded-lg text-xl hover-transition hover:bg-gray-200">
                                    <i class="fa-solid fa-cart-circle-plus"></i>
                                </button>
                            </div>
                        </div>
                    </a>
                @endforeach


            </div>
        </section>
    @endif
    <!-- related products ends -->

    <!-- product introduction starts -->
    <section class="flex flex-col gap-y-2 p-2 rounded-lg mt-4 bg-gray-100 dark:bg-gray-800 dark:text-white">

        <div class="flex flex-col gap-2 mt-2 p-2">
            <span class="text-base md:text-lg text-red-500 flex flex-wrap gap-1">
                <span>معرفی</span>
            </span>

            <p class="text-justify text-xs md:text-sm leading-6 md:leading-7">
                {{ html_entity_decode(strip_tags($product->introduction)) }}
            </p>
        </div>
        <div class="flex flex-col gap-2 mt-2 p-2">
            <span class="text-base md:text-lg text-red-500 flex flex-wrap gap-1">
                <span>مشخصات</span>
            </span>

            <div class="mt-2">
                <ol class="flex flex-col rounded-lg leading-5 overflow-hidden">

                    @foreach ($product->specs as $key => $spec)
                        <li class="grid grid-cols-6 {{ $key > 3 ? 'hidden' : '' }}">
                            <span class="col-span-2 md:col-span-1 p-4 bg-gray-200 dark:bg-gray-700 text-xxs md:text-sm">
                                {{ $spec->name }}
                            </span>
                            <span class="col-span-4 md:col-span-5 p-4 bg-gray-50 dark:bg-gray-900 text-xs">
                                {{ $spec->value }}

                            </span>
                        </li>
                    @endforeach

                    <li class="flex-center p-4 bg-gray-50 dark:bg-gray-900">
                        <span id="show-full-product-details"
                            class="flex gap-x-2 cursor-pointer text-black dark:text-white  text-xs">
                            <span>مشاهده کامل مشخصات کالا</span>
                            <i class="fa-light fa-angle-down"></i>
                        </span>
                    </li>
                </ol>
            </div>

        </div>
    </section>
    <!-- product introduction ends -->

    <!-- comments starts -->
    @php
    $comments = $product
        ->comments()
        ->where('approved', 1)
        ->get();
    @endphp
    <section class="flex flex-col gap-y-2 px-2 py-4 rounded-lg mt-4 bg-gray-100 dark:bg-gray-800 dark:text-white">
        <span class="text-base md:text-lg flex justify-between items-center gap-1">
            <span>نظرات کاربران ({{ $comments->count() }})</span>



            @guest
                <span class="text-red-500 text-xs md:text-sm">برای ثبت نظر وارد شوید</span>
            @endguest

            @auth

                <button onclick="toggleSendComment()"
                    class="flex items-center gap-x-2 text-xs md:text-sm bg-red-500 text-white rounded-lg px-4 py-2">
                    <i class="fa-light fa-comment-pen text-xl"></i>
                    ثبت نظر
                </button>
            @endauth
        </span>

        <div class="flex flex-col gap-2">


            @foreach ($comments as $comment)
                @if (empty($comment->parent_id))
                    <div class="px-3 py-4 rounded-lg bg-white dark:bg-gray-900">
                        <span class="flex items-start justify-between">
                            <span class="flex flex-col gap-2">
                                <span class="text-sm">
                                    {{ $comment->user->fullName }}
                                    <span class="rounded-lg px-3 py-1 text-white bg-red-500 text-xxs">خریدار</span>
                                </span>
                                <span
                                    class="text-xs text-gray-400">{{ showPersianDate($comment->created_at, '%A, %d %B %y') }}</span>
                            </span>

                            <span
                                class="text-sm flex items-center gap-1
                            @if (in_array($comment->id, $user_comment_likes_ids)) text-emerald-600
                            @else
                            text-black dark:text-white @endif
                            ">

                                <span>
                                    <a href="{{ route('app.product.like-comment', $comment->id) }}" class="text-base">
                                        <i class="fa-regular fa-thumbs-up"></i>
                                    </a>
                                </span>
                                <span>

                                    @if (empty($comment->likes->first()))
                                        0
                                    @else
                                        @foreach ($comment->likes as $like)
                                            {{ $like->likes }}
                                        @endforeach
                                    @endif

                                </span>
                            </span>
                        </span>

                        <p class="mt-2 text-xs md:text-base text-justify leading-5">
                            {!! $comment->body !!}
                        </p>

                        @if ($comment->children->count() > 0)
                            @foreach ($comment->children as $replay)
                                <div class="grid grid-cols-10 gap-2 items-center">
                                    <span class="col-span-1 text-center text-lg md:text-2xl text-red-500">
                                        <i class="fa-regular fa-reply"></i>
                                    </span>
                                    <div class="col-span-9 px-3 py-4 mr-8 mt-4 rounded-lg bg-gray-100 dark:bg-gray-800">
                                        <span class="flex items-start justify-between">
                                            <span class="flex flex-col gap-2">
                                                <span class="text-sm">
                                                    پاسخ ادمین
                                                </span>

                                            </span>
                                        </span>

                                        <p class="mt-2 text-xs md:text-base text-justify leading-5">
                                            {!! $replay->body !!}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>
                @endif
            @endforeach

        </div>

    </section>
    <!-- comments ends -->
@endsection

@section('add-to-body')
    <!-- send comment modal starts -->
    <div id="send-comment-backdrop" onclick="toggleSendComment()"
        class="hidden fixed top-0 bottom-0 left-0 right-0 bg-gray-500/70 z-40 transition-all duration-300">
        <form class="w-full flex-center" action="{{ route('app.product.send-comment', $product->id) }}"
            method="POST">
            <div class="w-5/6 md:w-2/3 rounded-lg p-3 bg-white dark:bg-gray-700 flex flex-col gap-y-3"
                onclick="event.stopPropagation()">
                <div class="flex justify-between">
                    <span class="text-red-500 text-xs xs:text-base md:text-lg">ثبت نظر</span>
                    <button type="button" onclick="toggleSendComment()">
                        <i class="fa-solid fa-xmark text-xl md:text-2xl"></i>
                    </button>
                </div>
                <textarea class="form-input h-20" name="body" rows="10" placeholder="نظر خود را در این کادر بنویسید"
                    required></textarea>


                @guest
                    <span class="text-red-500 text-sm md:text-lg">برای ثبت نظر وارد شوید</span>
                @endguest

                @auth

                    <button type="submit" class="block bg-red-500 text-sm text-center md:text-base py-3 rounded-lg">ثبت
                        نظر</button>
                @endauth
            </div>
            @csrf
        </form>

    </div>
    <!-- send comment modal ends -->

    <!-- buy product button starts -->

    <section
        class="fixed z-10 right-0 bottom-0 left-0 flex justify-between items-center shadow-lg md:hidden px-4 py-3 bg-white dark:bg-gray-900 dark:text-white">

        <span class="flex flex-col gap-y-2 text-xs xs:text-base">
            <span class="flex items-center gap-x-2">
                <span class="line-through">{{ $product->price }}</span>
                <span class="w-6 h-6 rounded-lg text-xxs bg-red-500 text-white flex-center">2%</span>
            </span>
            <span class="">43,230,000 تومان</span>
        </span>

        <button class="rounded-lg bg-red-500 text-xs xs:text-base text-white py-3 px-6">
            افزودن به سبد خرید
        </button>
    </section>

    <!-- buy product button ends -->
@endsection

@section('scripts')
    <script src="{{ asset('app-assets/js/products.js') }}"></script>
    <script src="{{ asset('app-assets/js/product-images-slider.js') }}"></script>
    <script src="{{ asset('app-assets/js/product-details.js') }}"></script>
    <script src="{{ asset('app-assets/js/product-comment.js') }}"></script>
    <script src="{{ asset('app-assets/js/get-product-price.js') }}"></script>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                iqwerty.toast.toast('لینک محصول با موفقیت کپی شد');
            })
        }
    </script>
@endsection
