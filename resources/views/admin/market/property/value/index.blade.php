@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | فرم کالا | مقادیر فرم کالا</title>
@endsection
@section('breadcrumb')
    <section class="m-2 px-2 py-4 rounded-lg bg-slate-100 dark:bg-slate-800 dark:text-white flex items-center gap-x-2">

        <a href="{{ route('admin.home') }}" class="text-xs md:text-base text-purple-800 dark:text-purple-400">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">بخش فروش</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <a href="{{ route('admin.market.property.index') }}"
            class="text-xs md:text-base text-purple-800 dark:text-purple-400">فرم کالا</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">مقادیر فرم کالا</span>

    </section>
@endsection
@section('content')
    <section class="flex flex-col gap-y-2 p-2 w-full">
        <div class="flex justify-between items-center">
            <span class="text-sm md:text-lg">مقادیر فرم کالا ({{ $property->name }})</span>
            @can('update', \App\Models\Market\Product::class)
                <a href="{{ route('admin.market.property.value.create', $property->id) }}"
                    class="btn bg-blue-600 text-white">افزودن مقدار جدید</a>
            @endcan
        </div>


        <section class="bg-slate-200 dark:bg-slate-700 rounded-lg w-full">

            <table class="table-auto w-full dark:text-white md:border-collapse">

                <thead class="text-xxs md:text-sm">
                    <tr>
                        <th>#</th>
                        <th>نام محصول</th>
                        <th>فرم کالا</th>
                        <th>مقدار</th>
                        <th>افزایش قیمت</th>
                        <th>موجودی</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody class="text-xxs md:text-sm">
                    @foreach ($property->values as $value)
                        <tr>

                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $value->product->name }}</td>
                            <td>{{ $value->attribute->name }}</td>
                            <td>{{ json_decode($value->value)->value }}</td>
                            <td>{{ json_decode($value->value)->price_increase . ' تومان' }}</td>
                            <td>{{ $value->marketable_number == 0 ? 'ناموجود' : $value->marketable_number }}</td>
                            <td>
                                <span class="flex items-center gap-x-1">
                                    @can('update', \App\Models\Market\Product::class)
                                        <a href="{{ route('admin.market.property.value.edit', $value->id) }}"
                                            class="btn bg-yellow-500 text-black flex-center gap-1">
                                            <i class="fa-light fa-pen-to-square"></i>
                                            ویرایش
                                        </a>
                                        <form class="m-0"
                                            action="{{ route('admin.market.property.value.destroy', $value->id) }}"
                                            method="POST">
                                            @csrf
                                            {{ method_field('delete') }}
                                            <button class="btn bg-red-400 text-black flex-center gap-1 delBtn">
                                                <i class="fa-light fa-trash-can"></i>
                                                حذف
                                            </button>
                                        </form>
                                    @endcan

                                </span>
                            </td>

                        </tr>
                    @endforeach

                </tbody>




            </table>

        </section>


    </section>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('admin-assets/js/ajax-destroy-data.js') }}"></script>
@endsection
