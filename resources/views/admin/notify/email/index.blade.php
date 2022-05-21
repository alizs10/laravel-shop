@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش محتوی | اطلاعیه ایمیلی</title>
@endsection
@section('breadcrumb')
    <section class="m-2 px-2 py-4 rounded-lg bg-slate-100 dark:bg-slate-800 dark:text-white flex items-center gap-x-2">

        <a href="{{ route('admin.home') }}" class="text-xs md:text-base text-purple-800 dark:text-purple-400">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">بخش اطلاع رسانی</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">اطلاعیه ایمیلی</span>

    </section>
@endsection
@section('content')
    <section class="flex flex-col gap-y-2 p-2 w-full">
        <div class="flex justify-between items-center">
            <span class="text-sm md:text-lg">اطلاعیه ایمیلی</span>
            <a href="{{ route('admin.notify.email.create') }}" class="btn bg-blue-600 text-white">افزودن اعلامیه ایمیلی
                جدید</a>
        </div>


        <section class="bg-slate-200 dark:bg-slate-700 rounded-lg w-full">

            <table class="table-auto w-full dark:text-white md:border-collapse">

                <thead class="text-xxs md:text-sm">
                    <tr>
                        <th>#</th>
                        <th>عنوان اعلامیه</th>
                        <th>متن اعلامیه</th>
                        <th>تاریخ ارسال</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody class="text-xxs md:text-sm">
                    @foreach ($emails as $key => $email)
                        <tr>

                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $email->subject }}</td>
                            <td>{{ Str::limit(strip_tags(html_entity_decode($email->body)), 25, ' ...') }}</td>
                            <td>{{ showPersianDate($email->published_at, 'Y-m-d H:i:s') }}</td>
                            <td>
                                <input type="checkbox" id="status-{{ $email->id }}"
                                    data-url="{{ route('admin.notify.email.status', $email->id) }}"
                                    onchange="changeStatus({{ $email->id }})"
                                    @if ($email->status === 1) checked @endif>
                            </td>
                            <td>
                                <span class="flex items-center gap-x-1 text-xs">

                                    <a href="{{ route('admin.notify.email-files.index', $email->id) }}"
                                        class="btn bg-blue-600 text-white flex-center gap-1">
                                        <i class="fa-light fa-paperclip"></i>
                                        فایل های ضمیمه شده ({{ count($email->files) }})
                                    </a>
                                    <a href="{{ route('admin.notify.email.edit', $email->id) }}"
                                        class="btn bg-yellow-500 text-black flex-center gap-1">
                                        <i class="fa-light fa-pen-to-square"></i>
                                        ویرایش
                                    </a>
                                    <form class="m-0"
                                    action="{{ route('admin.notify.email.destroy', $email->id) }}" method="POST">
                                        @csrf
                                        {{ method_field('delete') }}
                                        <button class="btn bg-red-400 text-black flex-center gap-1 delBtn">
                                            <i class="fa-light fa-trash-can"></i>
                                            حذف
                                        </button>
                                    </form>


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
