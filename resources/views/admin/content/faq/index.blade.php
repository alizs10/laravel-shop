@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش محتوی | سوالات متداول</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="">بخش محتوی</a></li>/
            <li>سوالات متداول</li>


        </ol>
    </div>

    <div class="box-container">
        <div class="row-head">
            <h2>سوالات متداول</h2>
            <a href="{{ route('admin.content.faq.create') }}" class="button button-info">افزودن سوال متداول</a>
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
                    <td>شناسه</td>
                    <td>سوال</td>
                    <td>پاسخ</td>
                    <td>اسلاگ</td>
                    <td>تگ ها</td>
                    <td>وضعیت</td>
                    <td>عملیات</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($faqs as $key => $faq)

                    <tr>
                        <td @if ($key += 1 % 2 !== 0)
                            class="active-row"
                @endif>{{ $key }}</td>
                <td>{{ $faq->question }}</td>
                <td>{{ substr(strip_tags(html_entity_decode($faq->answer)), 0, 50) . '...' }}</td>
                <td>{{ $faq->slug }}</td>
                <td>{{ $faq->tags }}</td>
                <td>
                    <input type="checkbox" id="status-{{ $faq->id }}"
                        data-url="{{ route('admin.content.faq.status', $faq->id) }}"
                        onchange="changeStatus({{ $faq->id }})" @if ($faq->status === 1)
                    checked
                    @endif>
                </td>
                <td>
                    <span>
                        <a href="{{ route('admin.content.faq.edit', $faq->id) }}"
                            class="button button-warning">ویرایش</a>
                        <form action="{{ route('admin.content.faq.destroy', $faq->id) }}" method="post">
                            @csrf
                            {{ method_field('delete') }}
                            <button type="submit" class="button button-danger delBtn">حذف</button>
                        </form>
                    </span>
                </td>

                </tr>

                @endforeach

            </tbody>
        </table>

    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('admin-assets/js/ajax-change-status.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/ajax-destroy-data.js') }}"></script>
@endsection
