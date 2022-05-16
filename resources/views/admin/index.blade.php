@extends('admin.layouts.master')

@section('head-tag')
    <title>پنل ادمین پیشرفته</title>
@endsection

@section('content')
    <div class="box-container">

        <div class="statistics">

            <div class="statistics-card bg-g-blue">
                <span>
                    <i class="fas fa-chart-bar"></i>
                </span>

                <span>
                    <h3>بازدید ها</h3>
                    <p>3,500</p>
                    <span class="last-update-notice">
                        <i class="fas fa-clock"></i>آخرین بروز رسانی 30 دقیقه قبل
                    </span>
                </span>

            </div>
            <div class="statistics-card bg-g-green">
                <span>
                    <i class="fas fa-chart-bar"></i>
                </span>

                <span>
                    <h3>نظرات</h3>
                    <p>55</p>
                    <span class="last-update-notice">
                        <i class="fas fa-clock"></i>آخرین بروز رسانی لحظاتی قبل
                    </span>
                </span>
            </div>
            <div class="statistics-card bg-g-red">
                <span>
                    <i class="fas fa-chart-bar"></i>
                </span>

                <span>
                    <h3>نمونه کارها</h3>
                    <p>455</p>
                    <span class="last-update-notice">
                        <i class="fas fa-clock"></i>آخرین بروز رسانی لحظاتی قبل
                    </span>
                </span>
            </div>
            <div class="statistics-card bg-g-light">
                <span>
                    <i class="fas fa-chart-bar"></i>
                </span>

                <span>
                    <h3>مهارت ها</h3>
                    <p>4545</p>
                    <span class="last-update-notice">
                        <i class="fas fa-clock"></i>آخرین بروز رسانی لحظاتی قبل
                    </span>
                </span>
            </div>


        </div>


    </div>
@endsection
