@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | محصولات</title>
@endsection
@section('breadcrumb')
    <section class="m-2 px-2 py-4 rounded-lg bg-slate-100 dark:bg-slate-800 dark:text-white flex items-center gap-x-2">

        <a href="{{ route('admin.home') }}" class="text-xs md:text-base text-purple-800 dark:text-purple-400">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">بخش فروش</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">محصولات</span>

    </section>
@endsection
@section('content')
    <section class="flex flex-col gap-y-2 p-2 w-full">
        <div class="flex justify-between items-center">
            <span class="text-sm md:text-lg">محصولات</span>
            <a href="{{ route('admin.market.product.create') }}" class="btn bg-blue-600 text-white">افزودن محصول جدید</a>
        </div>


        <section class="bg-slate-200 dark:bg-slate-700 rounded-lg w-full">

            <table class="table-auto w-full dark:text-white md:border-collapse">

                <thead class="text-xxs md:text-sm">
                    <tr>
                        <th>#</th>
                        <th>نام کالا</th>
                        <th>تصویر کالا</th>
                        <th>قیمت</th>
                        <th>دسته</th>
                        <th>تاریخ انتشار</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody class="text-xxs md:text-sm">
                    @foreach ($products as $product)
                        <tr>

                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $product->name }}</td>
                            <td>
                                <img src="{{ asset('storage\\' . $product->image['indexArray']['small']) }}" alt="">
                            </td>
                            <td>{{ $product->price . ' تومان' }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ showPersianDate($product->published_at, 'Y-m-d') }}</td>
                            <td>
                                <input type="checkbox" id="status-{{ $product->id }}"
                                    data-url="{{ route('admin.market.product.status', $product->id) }}"
                                    onchange="changeStatus({{ $product->id }})"
                                    @if ($product->status === 1) checked @endif>
                            </td>
                            <td>
                                <div class="relative">
                                    <button onclick="toggleDropdown('dropdown-{{ $product->id }}')"
                                        id="toggle-dropdown-{{ $product->id }}"
                                        class="btn bg-blue-600 text-white flex-center gap-1">
                                        عملیات
                                        <i class="fa-regular fa-angle-down mr-space"></i>
                                    </button>

                                    <div class="hidden absolute top-10 left-0 z-30 w-56 h-fit rounded-lg bg-white dark:bg-slate-900 flex flex-col overflow-hidden"
                                        id={{ "dropdown-{$product->id}" }}>
                                        <a href="{{ route('admin.market.product.color.index', $product->id) }}"
                                            class="py-2 w-full text-sm h-full flex items-center gap-x-2 hover-transition hover:bg-slate-100 dark:hover:bg-slate-800">
                                            <i class="fa-regular fa-palette mr-2"></i>
                                            رنگ ها ({{ count($product->colors) }})    
                                        </a>
                                        <a href="{{ route('admin.market.product.gallery.index', $product->id) }}"
                                            class="py-2 w-full text-sm h-full flex items-center gap-x-2 hover-transition hover:bg-slate-100 dark:hover:bg-slate-800">
                                            <i class="fa-regular fa-images mr-2"></i>
                                            گالری ({{ count($product->gallery) }})    
                                        </a>
                                        <a href="{{ route('admin.market.product.spec.index', $product->id) }}"
                                            class="py-2 w-full text-sm h-full flex items-center gap-x-2 hover-transition hover:bg-slate-100 dark:hover:bg-slate-800">
                                            <i class="fa-regular fa-info mr-2"></i>
                                            مشخصات کالا ({{ count($product->specs) }})    
                                        </a>
                                        <a href="{{ route('admin.market.product.edit', $product->id) }}"
                                            class="py-2 w-full text-sm h-full flex items-center gap-x-2 hover-transition hover:bg-slate-100 dark:hover:bg-slate-800">
                                            <i class="fa-regular fa-pen-to-square mr-2"></i>
                                           ویرایش   
                                        </a>
                                        
                                        <form class="w-full m-0"
                                        action="{{ route('admin.market.product.destroy', $product->id) }}" method="POST">
                                            @csrf
                                            {{ method_field('delete') }}
                                            <button
                                                class="py-2 w-full text-sm h-full flex items-center gap-x-2 hover-transition hover:bg-slate-100 dark:hover:bg-slate-800 delBtn">
                                                <i class="fa-regular fa-trash-can mr-2"></i>
                                                حذف</button>
                                        </form>

                                    </div>
                                </div>
                            </td>

                        </tr>
                    @endforeach

                </tbody>




            </table>

        </section>


    </section>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('admin-assets/js/dropdown-btn.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/ajax-change-status.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/ajax-destroy-data.js') }}"></script>
@endsection
