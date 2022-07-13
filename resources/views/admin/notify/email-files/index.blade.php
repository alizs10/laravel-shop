@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش اطلاع رسانی | فایل های اطلاعیه ایمیلی</title>
@endsection
@section('breadcrumb')
    <section class="m-2 px-2 py-4 rounded-lg bg-slate-100 dark:bg-slate-800 dark:text-white flex items-center gap-x-2">

        <a href="{{ route('admin.home') }}" class="text-xs md:text-base text-purple-800 dark:text-purple-400">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">بخش اطلاع رسانی</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <a href="{{ route('admin.notify.email.index') }}"
            class="text-xs md:text-base text-purple-800 dark:text-purple-400">اطلاعیه ایمیلی</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">فایل های اطلاعیه ایمیلی</span>

    </section>
@endsection
@section('content')
    <section class="flex flex-col gap-y-2 p-2 w-full">
        <div class="flex justify-between items-center">
            <span class="text-sm md:text-lg">فایل های اطلاعیه ایمیلی</span>
            <a href="{{ route('admin.notify.email-files.create', $email->id) }}" class="btn bg-blue-600 text-white">
                افزودن فایل جدید
            </a>
        </div>


        <section class="bg-slate-200 dark:bg-slate-700 rounded-lg w-full">

            <table class="table-auto w-full dark:text-white md:border-collapse">

                <thead class="text-xxs md:text-sm">
                    <tr>
                        <th>#</th>
                        <th>نام فایل</th>
                        <th>محل ذخیره فایل</th>
                        <th>توضیحات فایل</th>
                        <th>نوع فایل</th>
                        <th>حجم فایل</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody class="text-xxs md:text-sm">
                    @foreach ($email->files as $key => $file)
                        <tr>

                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $file->file_name }}</td>
                            <td>{{ $file->file_save_path === 1 ? 'خصوصی' : 'عمومی' }}</td>
                            <td>{{ $file->file_description }}</td>
                            <td>{{ $file->file_type }}</td>
                            <td>{{ $file->file_size . ' بایت' }}</td>
                            <td>
                                <span class="flex items-center gap-x-1 text-xs">
                                    @can('update', \App\Models\Notify\EmailFile::class)
                                        <a href="{{ route('admin.notify.email-files.edit', $file->id) }}"
                                            class="btn bg-yellow-500 text-black flex-center gap-1">
                                            <i class="fa-light fa-pen-to-square"></i>
                                            ویرایش
                                        </a>
                                    @endcan
                                    @can('delete', \App\Models\Notify\EmailFile::class)
                                        <form class="m-0"
                                            action="{{ route('admin.notify.email-files.destroy', $file->id) }}"
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
