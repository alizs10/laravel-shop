@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | تیکت ها</title>
@endsection
@section('breadcrumb')
    <section class="m-2 px-2 py-4 rounded-lg bg-slate-100 dark:bg-slate-800 dark:text-white flex items-center gap-x-2">

        <a href="{{ route('admin.home') }}" class="text-xs md:text-base text-purple-800 dark:text-purple-400">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">بخش تیکت ها</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">{{ $page }}</span>

    </section>
@endsection
@section('content')
    <section class="flex flex-col gap-y-2 p-2 w-full">
        <div class="flex justify-between items-center">
            <span class="text-sm md:text-lg">{{ $page }}</span>
         
        </div>


        <section class="bg-slate-200 dark:bg-slate-700 rounded-lg w-full">

            <table class="table-auto w-full dark:text-white md:border-collapse">

                <thead class="text-xxs md:text-sm">
                    <tr>
                        <th>#</th>
                        <th>نویسنده تیکت</th>
                        <th>عنوان تیکت</th>
                        <th>دسته تیکت</th>
                        <th>اولویت</th>
                        <th>ارجاع شده به</th>
                        <th>پاسخ به</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody class="text-xxs md:text-sm">
                    @foreach ($tickets as $ticket)
                        <tr>

                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $ticket->user->fullName }}</td>
                            <td>{{ $ticket->subject }}</td>
                            <td>{{ $ticket->category->name }}</td>
                            <td>{{ $ticket->priority->name }}</td>
                            <td>{{ $ticket->referencedTo->user->fullName }}</td>
                            <td>{{ $ticket->parent->user->fullName ?? '-' }}</td>
                            <td>
                                <span class="flex items-center gap-x-1">

                                    <a href="{{ route('admin.ticket.show', $ticket->id) }}"
                                        class="btn bg-blue-600 text-white flex-center gap-1">
                                        <i class="fa-light fa-eye"></i>
                                        مشاهده
                                    </a>
                                    @if ($ticket->parent == null)
                                        <a href="{{ route('admin.ticket.status', $ticket->id) }}"
                                            class="btn {{ $ticket->status == 1 ? 'bg-emerald-400' : 'bg-yellow-500'}} text-white flex-center gap-1">
                                            <i class="fa-light fa-arrows-repeat"></i>
                                            {{ $ticket->status == 1 ? 'باز کردن' : 'بستن' }}
                                        </a>
                                    @endif



                                </span>
                            </td>

                        </tr>
                    @endforeach

                </tbody>




            </table>

        </section>


    </section>
@endsection
