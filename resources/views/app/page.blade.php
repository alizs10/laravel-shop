@extends('app.layouts.master')

@section('head-tag')
    <title>{{ $page->title }}</title>
@endsection

@section('content')
    <!-- breadcrumb starts-->
    <section
        class="px-2 py-4 rounded-lg bg-gray-100 dark:bg-gray-800 dark:text-white flex flex-wrap items-center gap-1 md:gap-2">

        <a href="" class="text-xs md:text-base text-red-500">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span href="" class="text-xs md:text-base">{{ $page->title }}</span>

    </section>
    <!-- breadcrumb ends -->

    <!-- page's content starts -->

    <section class="mt-4 p-3 rounded-lg bg-gray-100 dark:bg-gray-800">
        {!! $page->body !!}
    </section>
    <!-- page's content ends -->
@endsection
