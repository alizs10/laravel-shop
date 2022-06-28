@extends('app.layouts.master')

@section('content')
      <!-- shipping starts -->
      <section class="grid grid-cols-9 gap-4 mt-4">

        <div class="my-8 col-span-9 flex-center">
            <div class="flex justify-between items-center w-4/5 h-4 rounded-full bg-gray-100 dark:bg-gray-800">
                <span class="rounded-full flex-center bg-blue-600 dark:bg-blue-500 w-10 h-10 relative">
                    <span class="text-xxs xs:text-xs absolute -top-6 whitespace-nowrap">
                        اطلاعات ارسال
                    </span>
                    <i class="fa-regular fa-pen text-xs text-white"></i>
                </span>
                <span class="rounded-full flex-center bg-gray-100 dark:bg-gray-800 w-10 h-10 relative">
                    <span class="text-xxs xs:text-xs absolute -top-6 whitespace-nowrap">
                        پرداخت
                    </span>
                    <i class="fa-regular fa-flag text-xs text-gray-500 dark:text-gray-400"></i>
                </span>
                <span class="rounded-full flex-center bg-gray-100 dark:bg-gray-800 w-10 h-10 relative">
                    <span class="text-xxs xs:text-xs absolute -top-6 whitespace-nowrap">
                        اتمام خرید و ارسال
                    </span>
                    <i class="fa-regular fa-flag text-xs text-gray-500 dark:text-gray-400"></i>
                </span>
            </div>
        </div>

        <div
            class="col-span-9 md:col-span-6 lg:col-span-6 lg:h-fit flex flex-col gap-2 p-3 bg-gray-100 dark:bg-gray-800 rounded-lg">
            <span class="flex justify-between items-center gap-3">
                <span class="text-sm xs:text-base text-gray-500 dark:text-gray-400">
                    انتخاب آدرس
                </span>

                <button onclick="toggleAddNewAddress()"
                    class="px-4 py-2 bg-red-500 text-xxs xs:text-sm rounded-lg mt-2 text-white">
                    افزودن آدرس
                </button>
            </span>

            <div class="flex flex-col gap-2 mt-2">
                <div
                    class="w-full flex flex-col gap-2 leading-6 rounded-lg bg-white dark:bg-gray-700 shadow-md p-3">
                    <span class="text-xs xs:text-sm">
                        <i class="fa-light fa-city"></i>
                        خوزستان، اهواز</span>
                    <span class="flex gap-2 text-sm">
                        <i class="fa-light fa-map-pin"></i>
                        <span>میدان امام رضا، خیابان شهید اسلام، کوچه نرگس پلاک ۶۷</span>
                    </span>
                    <span class="text-xs xs:text-sm">
                        <i class="fa-light fa-mailbox"></i>
                        کدپستی: ۶۴۶۲۰۵۸۹۹
                    </span>
                    <span class="text-xs xs:text-sm">
                        <i class="fa-light fa-user"></i>
                        نام تحویل گیرنده: محمدحسین تقی زاده
                    </span>
                    <span class="text-xs xs:text-sm">
                        <i class="fa-light fa-mobile"></i>
                        موبایل تحویل گیرنده: ۰۹۱۲۳۴۵۶۹۸۷</span>

                    <div class="flex justify-end">
                        <div class="flex items-center gap-x-3">

                            <button onclick="selectAddress(this)"
                                class="px-3 py-2 border-2 flex-center gap-2 text-xs rounded-lg text-red-500 border-red-500">
                                انتخاب
                            </button>
                        </div>
                    </div>
                </div>
                <div
                    class="w-full flex flex-col gap-2 leading-6 rounded-lg bg-white dark:bg-gray-700 shadow-md p-3">
                    <span class="text-sm">
                        <i class="fa-light fa-city"></i>
                        خوزستان، اهواز</span>
                    <span class="flex gap-2 text-sm">
                        <i class="fa-light fa-map-pin"></i>
                        <span>میدان امام رضا، خیابان شهید اسلام، کوچه نرگس پلاک ۶۷</span>
                    </span>
                    <span class="text-sm">
                        <i class="fa-light fa-mailbox"></i>
                        کدپستی: ۶۴۶۲۰۵۸۹۹
                    </span>
                    <span class="text-sm">
                        <i class="fa-light fa-user"></i>
                        نام تحویل گیرنده: محمدحسین تقی زاده
                    </span>
                    <span class="text-sm">
                        <i class="fa-light fa-mobile"></i>
                        موبایل تحویل گیرنده: ۰۹۱۲۳۴۵۶۹۸۷</span>

                    <div class="flex justify-end">
                        <div class="flex items-center gap-x-3">

                            <button onclick="selectAddress(this)"
                                class="px-3 py-2 border-2 flex-center gap-2 text-xs rounded-lg text-red-500 border-red-500">
                                انتخاب
                            </button>
                        </div>
                    </div>
                </div>

            </div>


            <span class="my-4 text-sm xs:text-base text-gray-500 dark:text-gray-400">
                انتخاب شیوه ارسال
            </span>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                <div onclick="selectDelivery(this)"
                 class="col-span-1 rounded-lg cursor-pointer shadow-md p-3 selected-delivery bg-red-500 text-white flex flex-col gap-2">
                    <span class="flex gap-2">
                        <i class="fa-light fa-truck-bolt text-base"></i>
                        <span class="text-xs">پست پیشتاز</span>
                    </span>
                    <span class="flex gap-2">
                        <i class="fa-light fa-calendar-clock text-base"></i>
                        <span class="text-xs">ارسال از ۲ روز کاری</span>
                    </span>
                    <span class="text-sm">۳۵,۰۰۰ تومان</span>
                </div>
                <div onclick="selectDelivery(this)"
                 class="col-span-1 rounded-lg cursor-pointer shadow-md p-3 bg-gray-200 dark:bg-gray-700 flex flex-col gap-2">
                    <span class="flex gap-2">
                        <i class="fa-light fa-truck-bolt text-base"></i>
                        <span class="text-xs">چاپار</span>
                    </span>
                    <span class="flex gap-2">
                        <i class="fa-light fa-calendar-clock text-base"></i>
                        <span class="text-xs">ارسال از ۱ روز کاری</span>
                    </span>
                    <span class="text-sm">۸۵,۰۰۰ تومان</span>
                </div>
            </div>

        </div>

        <div
            class="col-span-9 md:col-span-3 lg:col-span-3 text-xs md:text-xxs lg:text-xs flex flex-col gap-2 h-fit p-3 bg-gray-100 dark:bg-gray-800 rounded-lg">

            <span class="flex justify-between items-center">
                <span>جمع سبد خرید شما</span>
                <span>۴۲۸٬۴۵۰ تومان</span>
            </span>
            <span
                class="text-red-500 flex justify-between items-center md:pb-2 md:border-b-2 border-gray-200 dark:border-gray-700">
                <span>سود شما از این خرید</span>
                <span>۲۸٬۴۵۰ تومان</span>
            </span>
            <span class="flex justify-between items-center">
                <span>هزینه ارسال</span>
                <span>۳۵,۰۰۰ تومان</span>
            </span>
            <div
                class="fixed drop-shadow-lg right-0 bottom-0 left-0 z-30 md:z-0 flex justify-between items-center md:block md:static bg-gray-200 dark:bg-gray-800 md:bg-transparent p-3 md:p-0">
               
                <span
                    class="flex flex-col md:flex-row gap-2 md:justify-between items-center text-xxs xs:text-xs md:text-xxs lg:text-xs">
                    <span>مبلغ پرداختی</span>
                    <span>۴۳۶,۲۰۰ تومان</span>
                </span>

                <button class="md:w-full px-4 py-2 bg-red-500 text-xxs xs:text-sm rounded-lg mt-2 text-white">
                    پرداخت
                </button>
            </div>

        </div>
    </section>
    <!-- shipping ends -->
@endsection

@section('add-to-body')
    <!-- add new address modal starts -->
    <div id="new-address-backdrop" onclick="toggleAddNewAddress()"
        class="hidden fixed top-0 bottom-0 left-0 right-0 bg-gray-500/70 z-40 transition-all duration-300">
        <form class="w-full flex-center" action="{{ route('app.user.addresses.store') }}" method="POST">
            @csrf
            <div class="w-5/6 md:w-2/3 rounded-lg p-3 shadow-md bg-white dark:bg-gray-700 flex flex-col gap-y-3"
                onclick="event.stopPropagation()">
                <div class="flex justify-between">
                    <span class="text-red-500 text-xs xs:text-base md:text-lg">ثبت آدرس جدید</span>
                    <button type="button" onclick="toggleAddNewAddress()">
                        <i class="fa-solid fa-xmark text-xl md:text-2xl"></i>
                    </button>
                </div>
                <div class="w-full max-h-[calc(100vh_-_14rem)] overflow-y-scroll no-scrollbar grid grid-cols-2 gap-2">
                    <div class="col-span-2 md:col-span-1 flex flex-col gap-1 relative mt-4">
                        <label class="text-xs absolute bg-white dark:bg-gray-700 px-2 -top-2 right-2"
                            for="province">استان</label>
                        <select class="form-input" name="province" id="province">
                            <option class="text-black" value="">استان خود را انتخاب کنید</option>
                            @foreach ($provinces as $province)
                                <option class="text-black" value="{{ $province->id }}">{{ $province->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('province'))
                            <span class="text-xs text-red-500">{{ $errors->first('province') }}</span>
                        @endif
                    </div>
                    <div class="col-span-2 md:col-span-1 flex flex-col gap-1 relative mt-4">
                        <label class="text-xs absolute bg-white dark:bg-gray-700 px-2 -top-2 right-2"
                            for="city_id">شهر</label>
                        <select class="form-input" name="city_id" id="city_id">
                            <option class="text-black" value="">شهر خود را انتخاب کنید</option>
                        </select>
                        @if ($errors->has('city_id'))
                            <span class="text-xs text-red-500">{{ $errors->first('city_id') }}</span>
                        @endif
                    </div>
                    <div class="col-span-2 flex flex-col gap-1 relative mt-4">
                        <label class="text-xs absolute bg-white dark:bg-gray-700 px-2 -top-2 right-2"
                            for="address">آدرس</label>
                        <textarea class="form-input" name="address" id="address" rows="3" placeholder="آدرس دقیق خود را وارد کنید">{{ old('address') }}</textarea>
                        @if ($errors->has('address'))
                            <span class="text-xs text-red-500">{{ $errors->first('address') }}</span>
                        @endif
                    </div>
                    <div class="col-span-2 md:col-span-1 flex flex-col gap-1 relative mt-4">
                        <label class="text-xs absolute bg-white dark:bg-gray-700 px-2 -top-2 right-2"
                            for="unit">واحد</label>
                        <input class="form-input" name="unit" id="unit" value="{{ old('unit') }}" />
                        @if ($errors->has('unit'))
                            <span class="text-xs text-red-500">{{ $errors->first('unit') }}</span>
                        @endif
                    </div>
                    <div class="col-span-2 md:col-span-1 flex flex-col gap-1 relative mt-4">
                        <label class="text-xs absolute bg-white dark:bg-gray-700 px-2 -top-2 right-2"
                            for="no">پلاک</label>
                        <input class="form-input" name="no" id="no" value="{{ old('no') }}" />
                        @if ($errors->has('no'))
                            <span class="text-xs text-red-500">{{ $errors->first('no') }}</span>
                        @endif
                    </div>
                    <div class="col-span-2 md:col-span-1 flex flex-col gap-1 relative mt-4">
                        <label class="text-xs absolute bg-white dark:bg-gray-700 px-2 -top-2 right-2"
                            for="postal_code">کدپستی</label>
                        <input class="form-input" name="postal_code" id="postal_code"
                            value="{{ old('postal_code') }}" />
                        @if ($errors->has('postal_code'))
                            <span class="text-xs text-red-500">{{ $errors->first('postal_code') }}</span>
                        @endif
                    </div>
                    <div class="col-span-2 md:col-span-1 flex flex-col gap-1 relative mt-4">
                        <label class="text-xs absolute bg-white dark:bg-gray-700 px-2 -top-2 right-2"
                            for="receiver_name">نام
                            تحویل گیرنده</label>
                        <input class="form-input" name="receiver_name" id="receiver_name"
                            value="{{ old('receiver_name') }}" />
                        @if ($errors->has('receiver_name'))
                            <span class="text-xs text-red-500">{{ $errors->first('receiver_name') }}</span>
                        @endif
                    </div>
                    <div class="col-span-2 md:col-span-1 flex flex-col gap-1 relative mt-4">
                        <label class="text-xs absolute bg-white dark:bg-gray-700 px-2 -top-2 right-2"
                            for="receiver_mobile">شماره
                            تماس تحویل
                            گیرنده</label>
                        <input class="form-input" name="receiver_mobile" id="receiver_mobile"
                            value="{{ old('receiver_mobile') }}" />
                        @if ($errors->has('receiver_mobile'))
                            <span class="text-xs text-red-500">{{ $errors->first('receiver_mobile') }}</span>
                        @endif
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-red-500 text-white text-sm text-center md:text-base py-3 rounded-lg">ثبت
                    آدرس</button>
            </div>
        </form>

    </div>
    <!-- add new address modal ends -->
@endsection

@section('scripts')
    <script src="{{ asset('app-assets/js/shipping-page.js') }}"></script>
    @if ($errors->any())
        <script>
            toggleAddNewAddress();
        </script>
    @endif
@endsection
