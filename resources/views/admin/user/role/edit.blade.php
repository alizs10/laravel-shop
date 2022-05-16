@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش کاربران | ویرایش نقش</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li>بخش کاربران</li>/
            <li><a class="text-primary" href="{{ route('admin.user.role.index') }}">سطوح دسترسی</a></li>/
            <li>ویرایش نقش</li>

        </ol>
    </div>

    <div class="box-container">
        <div class="row-head">
            <h2>ویرایش نقش</h2>
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

        <form action="{{ route('admin.user.role.update', $role->id) }}" method="POST" id="form">
            @csrf
            {{ method_field('put') }}
            <div class="row-head">
                <div class="form-input-half">
                    <label @if ($errors->has('name'))
                        class="text-danger"
                        @endif for="name">عنوان نقش</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $role->name) }}">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('description'))
                        class="text-danger"
                        @endif for="description">توضیحات نقش</label>
                    <input type="text" name="description" id="description" value="{{ old('description', $role->description) }}">
                </div>


                <div class="form-input-full">
                    <label @if ($errors->has('status'))
                        class="text-danger"
                        @endif for="status">وضعیت</label>
                    <select name="status" id="status">
                        <option value="1" @if (old('status', $role->status) == 1)
                            selected
                            @endif>فعال</option>
                        <option value="0" @if (old('status', $role->status) == 0)
                            selected
                            @endif>غیرفعال</option>
                    </select>
                </div>


            </div>

            <div class="row-head">
                <button type="submit" class="button button-warning">ویرایش</button>
            </div>
        </form>





    </div>
@endsection
