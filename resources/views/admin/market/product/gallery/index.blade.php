@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | گالری محصول</title>
@endsection

@section('content')
    <div class="box-container">
        <ol class="route-map-group">
            <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
            <li><a class="text-primary" href="">بخش فروش</a></li>/
            <li><a class="text-primary" href="{{ route('admin.market.product.index') }}">محصولات</a></li>/
            <li>{{ $product->name }}</li>/
            <li>گالری محصول</li>


        </ol>
    </div>

    <div class="box-container flex-column flex-row-gap-2">
        <div class="row-head">
            <h2 class="text-size-titr">گالری محصول <span class="text-danger">"{{ $product->name }}"</span></h2>
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

        <form action="{{ route('admin.market.product.gallery.store', $product->id) }}" enctype="multipart/form-data"
            method="POST">
            @csrf
            <div class="row-head">
                <div class="form-input-half">
                    <label @if ($errors->has('image'))
                        class="text-danger"
                        @endif for="image">افزودن تصاویر محصول</label>
                    <input type="file" name="image[]" id="image" multiple>
                </div>
                <button type="submit" class="button button-success">آپلود</button>
            </div>
        </form>


        <div class="galleryBox">
            <div class="galleryImages">

                @if (count($product->gallery) > 0)
                    @foreach ($product->gallery as $image)
                        <div class="galleryImage">
                            <img src="{{ asset('storage\\' . $image->image['indexArray']['small']) }}" alt="">
                            <form action="{{ route('admin.market.product.gallery.destroy', $image->id) }}" method="POST">
                                @csrf
                                {{ method_field('delete') }}
                                <button type="submit" class="button button-danger delBtn">حذف</button>
                            </form>
                        </div>
                    @endforeach
                @else
                    <p class="w-100 text-center">گالری محصول خالی است ...</p>
                @endif


            </div>
        </div>

    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('admin-assets/js/ajax-destroy-data.js') }}"></script>
@endsection
