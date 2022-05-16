@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | روش ارسال جدید</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="#">بخش فروش</a></li>/
            <li><a class="text-primary" href="{{ route('admin.market.delivery.index') }}">روش های ارسال</a></li>/
            <li>روش ارسال جدید</li>

        </ol>
    </div>

    <div class="box-container flex-column flex-row-gap-2">
        <div class="row-head">
            <h2>روش ارسال جدید</h2>
            <a href="{{ route('admin.market.delivery.index') }}" class="button button-info">بازگشت</a>
        </div>

        @if ($errors->any())
            <div class="row-head bg-danger py-1 rounded">
                <ul class="flex-column flex-row-gap-1">
                    @foreach ($errors->all() as $error)
                        <li class="text-white text-size-1 mr-space">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.market.delivery.store') }}" method="POST" id="form">
            @csrf
            <div class="flex-wrap flex-gap-2">

                <div class="form-input-half">
                    <label @if ($errors->has('name'))
                        class="text-danger"
                        @endif for="name">نام روش ارسال</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('amount'))
                        class="text-danger"
                        @endif for="amount">هزینه ارسال</label>
                    <input type="text" name="amount" id="amount" value="{{ old('amount') }}">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('delivery_time'))
                        class="text-danger"
                        @endif for="delivery_time">زمان ارسال</label>
                    <input type="text" name="delivery_time" id="delivery_time" value="{{ old('delivery_time') }}">
                </div>

                <div class="form-input-half">
                    <label @if ($errors->has('delivery_time_unit'))
                        class="text-danger"
                        @endif for="">واحد زمان ارسال</label>
                    <input type="text" name="delivery_time_unit" id="delivery_time_unit" value="{{ old('delivery_time_unit') }}">
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

                <div class="row-head w-100">
                    <button type="submit" class="button button-success w-100">افزودن</button>
                </div>
            </div>


            
        </form>




    </div>
@endsection
