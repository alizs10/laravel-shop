@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش کاربران | تعیین نقش ادمین</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="">بخش کاربران</a></li>/
            <li><a class="text-primary" href="{{ route('admin.user.admin-user.index') }}">ادمین ها</a></li>/
            <li>تعیین نقش ادمین</li>

        </ol>
    </div>

    <div class="box-container">
        <div class="row-head">
            <h2>تعیین نقش ادمین</h2>
            <a href="{{ route('admin.user.admin-user.index') }}" class="button button-info">بازگشت</a>
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

        <div class="flex-column bg-g-light text-info flex-row-gap-2 p-1 rounded mt-space">

            <p>نام: {{ $admin->fullName }}</p>
            <p>ایمیل: {{ $admin->email }}</p>



        </div>
        <form action="{{ route('admin.user.admin-user.set-role', $admin->id) }}" method="post" id="form">
            @csrf
            <div class="row-head">

                <div class="row-head w-100">
                    <h3 class="mr-space text-primary">نقش ها:</h3>
                </div>
                <div class="row-head w-100">
                    <div class="flex-wrap w-100">

                        @foreach ($roles as $role)
                            <div class="form-input-sm">
                                <input type="checkbox" name="role_id[]" value="{{ $role->id }}"
                                    id="role-{{ $role->id }}" {{ in_array($role->id, $adminRolesIdArray) ? 'checked' : '' }}>
                                <label class="w-100"
                                    for="role-{{ $role->id }}">{{ $role->name }}</label>
    
                            </div>
                        @endforeach
                    </div>
                </div>


                <div class="row-head w-100">
                    <button type="submit" class="button button-warning">ویرایش</button>
                </div>

            </div>


        </form>







    </div>
@endsection
