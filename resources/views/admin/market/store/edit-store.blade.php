@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | اصلاح موجودی انبار</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="">بخش فروش</a></li>/
            <li><a class="text-primary" href="{{ route('admin.market.store.index') }}">انبار</a></li>/
            <li>اصلاح موجودی انبار</li>

        </ol>
    </div>

    <div class="box-container flex-column flex-row-gap-2">
        <div class="row-head">
            <h2>اصلاح موجودی انبار</h2>
            <a href="{{ route('admin.market.store.index') }}" class="button button-info">بازگشت</a>
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

        <form action="{{ route('admin.market.store.update', $product->id) }}" method="POST" id="form">
            @csrf
            @method('put')
            <div class="flex-wrap flex-gap-2">
                <div class="form-input-full">
                    <label for="marketable_number">تعداد قابل فروش</label>
                    <input type="text" name="marketable_number" id="marketable_number"
                        value="{{ old('marketable_number',$product->marketable_number) }}">
                </div>
                <div class="form-input-full">
                    <label for="frozen_number">تعداد در سبد خرید</label>
                    <input type="text" name="frozen_number" id="frozen_number"
                        value="{{ old('frozen_number',$product->frozen_number) }}">
                </div>

                <div class="form-input-full">
                    <label for="sold_number">تعداد فروخته شده</label>
                    <input type="text" name="sold_number" id="sold_number"
                        value="{{ old('sold_number',$product->sold_number) }}">
                </div>


            </div>


            <div class="row-head">
                <button type="submit" class="button button-primary">ثبت</button>
            </div>
        </form>



    </div>
@endsection
