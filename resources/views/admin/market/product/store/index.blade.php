@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | محصولات | انبار</title>
@endsection
@section('breadcrumb')
    <section class="m-2 px-2 py-4 rounded-lg bg-slate-100 dark:bg-slate-800 dark:text-white flex items-center gap-x-2">

        <a href="{{ route('admin.home') }}" class="text-xs md:text-base text-purple-800 dark:text-purple-400">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">بخش فروش</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <a href="{{ route('admin.market.product.index') }}"
            class="text-xs md:text-base text-purple-800 dark:text-purple-400">محصولات</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">انبار ({{ $product->name }})</span>


    </section>
@endsection
@section('content')
    <section class="flex flex-col gap-y-2 p-2 w-full">
        <div class="flex justify-between items-center">
            <span class="text-sm md:text-lg">انبار ({{ $product->name }})</span>
            <a href="{{ route('admin.market.product.index') }}"
                class="btn bg-blue-600 text-white">بازگشت</a>
        </div>


        <section class="bg-slate-200 dark:bg-slate-700 rounded-lg w-full">

            <table class="table-auto w-full dark:text-white md:border-collapse">

                <thead class="text-xxs md:text-sm">
                    <tr>
                        <th>#</th>
                        <th>خصوصیت</th>
                        <th>موجودی</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody class="text-xxs md:text-sm">
                    @if ($product->colors->count() > 0)
                        @foreach ($product->colors as $color)
                            <tr>

                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $color->color_name }}</td>
                             
                                <td>{{ $color->marketable_number }}</td>
                                <td>
                                    <span class="flex items-center gap-x-1">
                                        <a href="{{ route('admin.market.product.color.edit', $color->id) }}"
                                            class="btn bg-yellow-500 text-black flex-center gap-1">
                                            <i class="fa-light fa-pen-to-square"></i>
                                            ویرایش
                                        </a>

                                    </span>
                                </td>

                            </tr>
                        @endforeach
                    @endif
                    @if ($product->properties->count() > 0)
                        @foreach ($product->properties as $property)
                            <tr>

                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $property->attribute->name . ' ' . json_decode($property->value)->value }}</td>
                             
                                <td>{{ $property->marketable_number }}</td>
                                <td>
                                    <span class="flex items-center gap-x-1">
                                        <a href="{{ route('admin.market.property.value.edit', $property->id) }}"
                                            class="btn bg-yellow-500 text-black flex-center gap-1">
                                            <i class="fa-light fa-pen-to-square"></i>
                                            ویرایش
                                        </a>

                                    </span>
                                </td>

                            </tr>
                        @endforeach
                    @endif


                </tbody>




            </table>

        </section>


    </section>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('admin-assets/js/ajax-destroy-data.js') }}"></script>
@endsection
