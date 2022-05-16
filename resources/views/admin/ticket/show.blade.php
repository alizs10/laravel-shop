@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | نمایش تیکت</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="{{ route('admin.ticket.new-tickets') }}">تیکت ها</a></li>/
            <li>نمایش تیکت</li>

        </ol>
    </div>

    <div class="box-container">
        <div class="row-head">
            <h2>نمایش تیکت</h2>
            <a href="{{ route('admin.ticket.new-tickets') }}" class="button button-info">بازگشت</a>
        </div>

        @if ($errors->any())
            <div class="row-head bg-danger rounded">
                <ul class="flex-column flex-row-gap-1">
                    @foreach ($errors->all() as $error)
                        <li class="text-white text-size-1 mr-space">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row-head">


            <h3>{{ $ticket->user->fullName . ' - ' . $ticket->id }}</h3>

            <div class="messageCard bg-g-blue">
                <h4>موضوع: {{ $ticket->subject }}</h4>
                <p>{{ $ticket->description }}</p>
            </div>

            <form class="w-100" action="{{ route('admin.ticket.answer', $ticket->id) }}" method="POST">
                @csrf
                <div class="row-head">

                    <div class="form-input-full">
                        <label for="description" @if ($errors->has('answer'))
                            class="text-danger"
                            @endif>پاسخ تیکت</label>
                        <textarea name="description" id="description" rows="6"></textarea>
                    </div>

                </div>
                <div class="row-head">
                    <button class="button button-success">ثبت</button>
                </div>
            </form>


        </div>





    </div>
@endsection
@section('script')

    <script src="{{ asset('admin-assets/packages/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('admin-assets/js/ckreplace.js') }}"></script>

@endsection
