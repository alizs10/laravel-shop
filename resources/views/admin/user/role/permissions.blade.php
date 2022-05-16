@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش کاربران | ویرایش دسترسی های نقش</title>
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
            <h2>ویرایش دسترسی های نقش</h2>
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

        <div class="flex-column bg-g-light text-info flex-row-gap-2 p-1 rounded">

            <p>نقش: {{ $role->name }}</p>
            <p>توضیح نقش: {{ $role->description }}</p>



        </div>
        <form action="{{ route('admin.user.permission.update', $role->id) }}" method="post" id="form">
            @csrf
            @method('put')
            <div class="row-head">

                <div class="row-head">
                    <h3 class="mr-space text-primary">دسترسی ها:</h3>
                </div>
                <div class="flex-wrap">

                    @foreach ($permissions as $permission)
                        <div class="form-input-sm">
                            <input type="checkbox" name="permission_id[]" value="{{ $permission->id }}"
                                id="permission-{{ $permission->id }}" {{ in_array($permission->id, $permissionsRoleIDsArray) ? 'checked' : '' }}>
                            <label class="w-100"
                                for="permission-{{ $permission->id }}">{{ $permission->name }}</label>

                        </div>
                    @endforeach
                </div>


                <div class="row-head">
                    <button type="submit" class="button button-warning">ویرایش</button>
                </div>

            </div>


        </form>







    </div>
@endsection
