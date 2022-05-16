@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش محتوی | ایجاد منو</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="">بخش محتوی</a></li>/
            <li><a class="text-primary" href="{{ route('admin.content.menu.index') }}">منو ها</a></li>/
            <li>ایجاد منوی جدید</li>

        </ol>
    </div>

    <div class="box-container">
        <div class="row-head">
            <h2>ایجاد منو</h2>
            <a href="{{ route('admin.content.menu.index') }}" class="button button-info">بازگشت</a>
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

    <form action="{{ route('admin.content.menu.store') }}" method="POST" id="form">
        @csrf
        <div class="row-head">
            <div class="form-input-half">
                <label @if ($errors->has('name'))
                    class="text-danger"
                @endif for="name">نام منو</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}">
            </div>

            <div class="form-input-half">
                <label @if ($errors->has('slug'))
                    class="text-danger"
                @endif for="slug">اسلاگ</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug') }}">
            </div>

            <div class="form-input-half">
                <label @if ($errors->has('parent_id'))
                    class="text-danger"
                @endif for="parent_id">منوی والد</label>
                <select name="parent_id" id="parent_id">
                    <option value="">در صورت تمایل یک منو را انتخاب کنید</option>
                    @foreach ($menus as $menu)
                        <option value="{{ $menu->id }}" @if ($menu->id == old('parent_id')) selected @endif>{{ $menu->name }}</option>
                    @endforeach

                </select>
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
            <button type="submit" class="button button-primary">ثبت</button>
        </div>
    </form>

    </div>
@endsection
