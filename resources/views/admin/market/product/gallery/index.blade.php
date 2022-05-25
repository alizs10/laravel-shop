@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | محصولات | تصاویر محصول</title>
@endsection
@section('breadcrumb')
    <section class="m-2 px-2 py-4 rounded-lg bg-slate-100 dark:bg-slate-800 dark:text-white flex items-center gap-x-2">

        <a href="{{ route('admin.home') }}" class="text-xs md:text-base text-purple-800 dark:text-purple-400">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">بخش فروش</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <a href="{{ route('admin.market.product.index') }}"
            class="text-xs md:text-base text-purple-800 dark:text-purple-400">محصولات</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span class="text-xs md:text-base">تصاویر محصول ({{ $product->name }})</span>


    </section>
@endsection
@section('content')

    <section class="flex flex-col gap-y-2 p-2 w-full">


        <form action="{{ route('admin.market.product.gallery.store', $product->id) }}" enctype="multipart/form-data"
            method="POST">
            @csrf
            <div class="flex justify-between items-center">
                <span class="text-sm md:text-lg">تصاویر محصول ({{ $product->name }})</span>
                <button type="submit" class="btn bg-emerald-600 text-white">آپلود تصاویر جدید</button>
            </div>

            @if ($errors->any())
                <div class="flex flex-col gap-y-1 rounded-lg bg-red-200 p-2">
                    <span class="text-xs">خطا های فرم:</span>
                    @foreach ($errors->all() as $error)
                        <div class="flex gap-x-1 text-red-600 items-center">
                            <span class="text-base">
                                <i class="fa-light fa-diamond-exclamation"></i>
                            </span>
                            <span class="text-sm">{{ $error }}</span>
                        </div>
                    @endforeach

                </div>
            @endif

            <div class="flex flex-col gap-y-1">
                <label for="image"
                    class="text-xs {{ $errors->has('image') ? 'text-red-600 dark:text-red-400' : '' }}">افزودن
                    تصاویر
                    محصول</label>
                <input type="file" class="form-input" name="image[]" id="image" multiple>
            </div>
        </form>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-2">


            @if (count($product->gallery) > 0)
                @foreach ($product->gallery as $image)
                    <div class="flex flex-col gap-y-1">
                        <img class="w-full rounded-lg"
                            src="{{ asset('storage\\' . $image->image['indexArray']['small']) }}" alt="">
                        <form action="{{ route('admin.market.product.gallery.destroy', $image->id) }}" method="POST">
                            @csrf
                            {{ method_field('delete') }}
                            <button type="submit" class="btn bg-red-400 delBtn">حذف</button>
                        </form>
                    </div>
                @endforeach
            @else
                <p class="w-100 text-center">گالری محصول خالی است ...</p>
            @endif


        </div>


    </section>
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('admin-assets/js/ajax-destroy-data.js') }}"></script>
@endsection
