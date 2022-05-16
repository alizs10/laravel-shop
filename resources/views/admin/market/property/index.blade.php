@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | فرم کالا</title>
@endsection

@section('content')
<div class="box-container">
    <ol class="route-map-group">
        <li><a class="text-primary" href="{{ route('admin.home') }}">خانه</a></li>/
        <li><a class="text-primary" href="">بخش فروش</a></li>/
        <li>فرم کالا</li>
        

    </ol>
</div>

<div class="box-container flex-column flex-row-gap-2">
    <div class="row-head">
        <h2 class="text-size-titr">فرم کالا</h2>
        <a href="{{ route('admin.market.property.create') }}" class="button button-info">افزودن فرم کالای جدید</a>
    </div>


    <div class="row-head">
        <select name="" id="">
            <option value="10">10</option>
            <option value="100">100</option>
            <option value="1000">1000</option>
        </select>
        <div class="searchBox">
            <a><i class="fas fa-search"></i></a>
            <input type="text">
        </div>
    </div>

    <table class="styled-table">
        <thead>
            <tr>
                <td>شناسه</td>
                <td>عنوان فرم</td>
                <td>نوع فرم</td>
                <td>واحد فرم</td>
                <td>فرم والد</td>
                <td>عملیات</td>
            </tr>
        </thead>
        <tbody>
            
            @foreach ($properties as $key => $property)

                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $property->name }}</td>
                        <td>{{ $property->type == 0 ? 'ساده' : 'انتخابی' }}</td>
                        <td>{{ $property->unit }}</td>
                        <td>{{ $property->category->name }}</td>
                     
                <td>
                    <span>
                        <a href="{{ route('admin.market.property.value.index', $property->id) }}"
                            class="button button-success">ویژگی ها ({{ count($property->values) }})</a>
                        <a href="{{ route('admin.market.property.edit', $property->id) }}"
                            class="button button-warning">ویرایش</a>
                        <form action="{{ route('admin.market.property.destroy', $property->id) }}" method="POST">
                            @csrf
                            {{ method_field('delete') }}
                            <button type="submit" class="button button-danger delBtn">حذف</button>
                        </form>
                    </span>
                </td>

                </tr>

                @endforeach

        </tbody>
    </table>

</div>
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('admin-assets/js/ajax-change-status.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/ajax-destroy-data.js') }}"></script>
@endsection
