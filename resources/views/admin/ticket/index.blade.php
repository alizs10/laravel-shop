@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | تیکت ها</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li>تیکت ها</li>


        </ol>
    </div>

    <div class="box-container">
        <div class="row-head">
            <h2>تیکت ها</h2>
        </div>


        <div class="row-head">
            <select name="" id="">
                <option value="10">10</option>
                <option value="100">100</option>
                <option value="1000">1000</option>
            </select>
            <div class="searchBox">
                <a><i class="fas fa-search"></i></a>
                <input type="text">
            </div>
        </div>

        <table class="styled-table">
            <thead>
                <tr>
                    <td>#</td>
                    <td>نویسنده تیکت</td>
                    <td>عنوان تیکت</td>
                    <td>دسته تیکت</td>
                    <td>اولویت</td>
                    <td>ارجاع شده به</td>
                    <td>پاسخ به</td>
                    <td>عملیات</td>
                </tr>
            </thead>
            <tbody>

                @foreach ($tickets as $key => $ticket)

                    <tr>
                        <td @if ($key + (1 % 2) !== 0)
                            class="active-row"
                @endif>{{ $key + 1 }}</td>
                <td>{{ $ticket->user->fullName }}</td>
                <td>{{ $ticket->subject }}</td>
                <td>{{ $ticket->category->name }}</td>
                <td>{{ $ticket->priority->name }}</td>
                <td>{{ $ticket->referencedTo->user->fullName }}</td>
                <td>{{ $ticket->parent->user->fullName ?? '-' }}</td>
                <td>
                    <span>
                        <a href="{{ route('admin.ticket.show', $ticket->id) }}" class="button button-success">مشاهده</a>
                        <a @if ($ticket->parent == null)
                            href="{{ route('admin.ticket.status', $ticket->id) }}"
                            @endif

                            class="{{ $ticket->parent ? 'disabled' : '' }} button button-{{ $ticket->status == 1 ? 'primary' : 'warning'}}">
                            {{ $ticket->status == 1 ? 'باز کردن' : 'بستن' }}
                        </a>
                    </span>
                </td>

                </tr>

                @endforeach

            </tbody>
        </table>

    </div>
@endsection
