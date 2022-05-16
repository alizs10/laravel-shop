@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش کاربران | ایجاد نقش</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="">بخش کاربران</a></li>/
            <li><a class="text-primary" href="{{ route('admin.user.role.index') }}">سطوح دسترسی</a></li>/
            <li>ایجاد نقش جدید</li>

        </ol>
    </div>

    <div class="box-container">
        <div class="row-head">
            <h2>ایجاد نقش جدید</h2>
            <a href="{{ route('admin.user.role.index') }}" class="button button-info">بازگشت</a>
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
        <form action="{{ route('admin.user.role.store') }}" method="post" id="form">
            @csrf
            <div class="row-head">
                <div class="form-input-half">
                    <label for="">عنوان نقش</label>
                    <input name="name" type="text">
                </div>

                <div class="form-input-half">
                    <label for="">توضیح نقش</label>
                    <input name="description" type="text">
                </div>

                <div class="form-input-full">
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


                <div class="row-head">
                    <h3 class="mr-space text-primary">دسترسی ها:</h3>
                </div>
                <div class="flex-wrap">

                    @foreach ($permissions as $permission)
                        <div class="form-input-sm">
                            <input type="checkbox" name="permission_id[]" value="{{ $permission->id }}"
                                id="permission-{{ $permission->id }}">
                            <label class="w-100"
                                for="permission-{{ $permission->id }}">{{ $permission->name }}</label>

                        </div>
                    @endforeach
                </div>


                <div class="row-head">
                    <button type="submit" class="button button-success">افزودن</button>
                </div>

            </div>


        </form>







    </div>
@endsection
