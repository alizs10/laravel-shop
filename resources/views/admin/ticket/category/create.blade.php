@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش تیکت ها | دسته بندی</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li class="text-primary">بخش تیکت ها</li>/
            <li><a class="text-primary" href="{{ route('admin.ticket.category.index') }}">دسته بندی</a></li>/
            <li>ایجاد دسته بندی جدید</li>

        </ol>
    </div>

    <div class="box-container">
        <div class="row-head">
            <h2>دسته بندی</h2>
            <a href="{{ route('admin.ticket.category.index') }}" class="button button-info">بازگشت</a>
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

        <form action="{{ route('admin.ticket.category.store') }}" method="POST" id="form">
            @csrf
            <div class="row-head">

                <div class="form-input-half">
                    <label @if ($errors->has('name'))
                        class="text-danger"
                        @endif for="name">نام دسته</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}">
                </div>


                <div class="form-input-half">
                    <label @if ($errors->has('status'))
                        class="text-danger"
                        @endif for="status">وضعیت</label>
                    <select name="status" id="status">
                        <option value="1" @if (old('status') == 1)
                            selected
                            @endif>فعال</option>
                        <option value="0" @if (old('status') == 0)
                            selected
                            @endif>غیرفعال</option>
                    </select>
                </div>



            </div>

            <div class="row-head">
                <button type="submit" class="button button-success">افزودن</button>
            </div>
        </form>





    </div>
@endsection
