@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین | بخش فروش | دسته بندی</title>
@endsection

@section('content')
<div class="box-container">
    <ol class="route-map-group">
        <li><a class="text-primary" href="">خانه</a></li>/
        <li><a class="text-primary" href="">بخش فروش</a></li>/
        <li><a class="text-primary" href="">دسته بندی</a></li>/
        <li>ایجاد دسته بندی جدید</li>

    </ol>
</div>

<div class="box-container">
    <div class="row-head">
        <h2>دسته بندی</h2>
        <a href="#" class="button button-info">افزودن دسته بندی جدید</a>
    </div>

    <div class="addCatBox hidden">
        <label for="">نام دسته</label>
        <input type="text">
        <label for="">دسته والد</label>
        <select name="" id="">
            <option value="">دسته اول</option>
            <option value="">دسته اول</option>
            <option value="">دسته اول</option>
        </select>
        <button class="button button-success">افزودن</button>
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
                <td>نام دسته</td>
                <td>دسته والد</td>
                <td>عملیات</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>۱</td>
                <td>خبری</td>
                <td>بله</td>
                <td>
                    <span>
                        <a href="" class="button button-warning">ویرایش</a>
                        <button type="submit" class="button button-danger">حذف</button>
                    </span>
                </td>
            </tr>
            <tr class="active-row">
                <td>۲</td>
                <td>مسکن</td>
                <td>خیر</td>
                <td>
                    <span>
                        <a href="" class="button button-warning">ویرایش</a>
                        <button type="submit" class="button button-danger">حذف</button>
                    </span>
                </td>
            </tr>

        </tbody>
    </table>

</div>
@endsection
