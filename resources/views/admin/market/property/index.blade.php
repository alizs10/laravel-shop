@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | فرم کالا</title>
@endsection
@section('breadcrumb')
    <section class="m-2 px-2 py-4 rounded-lg bg-slate-100 dark:bg-slate-800 dark:text-white flex items-center gap-x-2">

        <a href="{{ route('admin.home') }}" class="text-xs md:text-base text-purple-800 dark:text-purple-400">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">بخش فروش</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">فرم کالا</span>

    </section>
@endsection
@section('content')
    <section class="flex flex-col gap-y-2 p-2 w-full">
        <div class="flex justify-between items-center">
            <span class="text-sm md:text-lg">فرم کالا</span>
            <a href="{{ route('admin.market.property.create') }}" class="btn bg-blue-600 text-white">افزودن فرم کالای
                جدید</a>
        </div>


        <section class="bg-slate-200 dark:bg-slate-700 rounded-lg w-full">

            <table class="table-auto w-full dark:text-white md:border-collapse">

                <thead class="text-xxs md:text-sm">
                    <tr>
                        <th>#</th>
                        <th>عنوان فرم</th>
                        <th>نوع فرم</th>
                        <th>واحد فرم</th>
                        <th>فرم والد</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody class="text-xxs md:text-sm">
                    @foreach ($properties as $property)
                        <tr>

                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $property->name }}</td>
                            <td>{{ $property->type == 0 ? 'ساده' : 'انتخابی' }}</td>
                            <td>{{ $property->unit }}</td>
                            <td>{{ $property->category->name }}</td>
                            <td>
                                <span class="flex items-center gap-x-1">
                                    @can('index', \App\Models\MArket\Product::class)
                                        <a href="{{ route('admin.market.property.value.index', $property->id) }}"
                                            class="btn bg-blue-600 text-white flex-center gap-1">
                                            <i class="fa-regular fa-circle-info"></i>
                                            ویژگی ها ({{ count($property->values) }})
                                        </a>
                                    @endcan
                                    @can('update', \App\Models\MArket\Product::class)
                                        <a href="{{ route('admin.market.property.edit', $property->id) }}"
                                            class="btn bg-yellow-500 text-black flex-center gap-1">
                                            <i class="fa-light fa-pen-to-square"></i>
                                            ویرایش
                                        </a>
                                        <form class="m-0"
                                            action="{{ route('admin.market.property.destroy', $property->id) }}"
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
    <script type="text/javascript" src="{{ asset('admin-assets/js/ajax-change-status.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/ajax-destroy-data.js') }}"></script>
@endsection
