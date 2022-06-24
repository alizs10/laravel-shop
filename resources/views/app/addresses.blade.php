@extends('app.layouts.master')

@section('content')
    <!-- breadcrumb starts-->
    <section
        class="px-2 py-4 rounded-lg bg-gray-100 dark:bg-gray-800 dark:text-white flex flex-wrap items-center gap-1 md:gap-2">

        <a href="" class="text-xs xs:text-sm md:text-base text-red-500">خانه</a>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span href="" class="text-xs xs:text-sm md:text-base text-red-500">پروفایل</span>
        <i class="fa-light fa-angles-left text-xs md:text-sm"></i>
        <span href="" class="text-xs xs:text-sm md:text-base text-red-500">آدرس های شما</span>


    </section>
    <!-- breadcrumb ends -->

    <!-- addresses starts -->
    <section class="grid grid-cols-9 gap-4 mt-4">

        <div id="profile-section"
            class="hidden lg:block col-span-9 lg:col-span-2 flex flex-col gap-2 h-fit p-3 bg-gray-100 dark:bg-gray-800 rounded-lg">
            <span class="flex items-center gap-2 text-xs xs:text-base">

                <span class="text-gray-500 dark:text-gray-400">
                    پروفایل
                </span>
            </span>

            <ul class="flex flex-col gap-4 xs:gap-y-4 py-3 mx-2 mt-2">
                <li>
                    <a href="{{ route('app.user.profile') }}" class="flex items-center gap-3 py-2">
                        <i class="fa-light fa-user text-sm xs:text-2xl"></i>
                        <span class="text-xs xs:text-base">
                            مشخصات کاربری
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('app.user.orders') }}" class="flex items-center gap-3 py-2">
                        <i class="fa-light fa-list-alt text-sm xs:text-2xl"></i>
                        <span class="text-xs xs:text-base">
                            لیست سفارشات
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('app.user.favorites') }}" class="flex items-center gap-3 py-2">
                        <i class="fa-light fa-heart text-sm xs:text-2xl"></i>
                        <span class="text-xs xs:text-base">
                            لیست علاقه مندی ها
                        </span>
                    </a>
                </li>
                <li>
                    <button onclick="profileBack()" class="flex items-center gap-3 py-2 text-red-500">
                        <i class="fa-light fa-map-location text-sm xs:text-2xl"></i>
                        <span class="text-xs xs:text-base">
                            آدرس های شما
                        </span>
                    </button>
                </li>
                <li>
                    <a href="{{ route('auth.logout') }}" class="flex items-center gap-3 py-2">
                        <i class="fa-light fa-right-from-bracket text-sm xs:text-2xl"></i>
                        <span class="text-xs xs:text-base">
                            خروج از حساب کاربری
                        </span>
                    </a>
                </li>
            </ul>

        </div>
        <div id="addresses-section"
            class="lg:block col-span-9 lg:col-span-7 lg:h-fit flex flex-col gap-2 p-3 bg-gray-100 dark:bg-gray-800 rounded-lg">
            <span class="flex items-center gap-3">
                <button onclick="profileBack()" class="lg:hidden text-lg">
                    <i class="fa fa-arrow-right"></i>
                </button>
                <span class="text-sm xs:text-base text-gray-500 dark:text-gray-400">
                    آدرس های شما
                </span>
            </span>

            <div class="flex flex-col gap-2 mt-2">

                @foreach ($user->addresses as $address)
                    <div class="w-full flex flex-col gap-2 leading-6 rounded-lg bg-white dark:bg-gray-700 shadow-md p-3">
                        <span class="text-sm">
                            <i class="fa-light fa-city"></i>
                            {{ $address->city->province->name }}، {{ $address->city->name }}</span>
                        <span class="flex gap-2 text-sm">
                            <i class="fa-light fa-map-pin"></i>
                            <span>{{ $address->address . ($address->unit ? ' واحد ' . $address->unit : '') . ' پلاک ' . $address->no }}</span>
                        </span>
                        <span class="text-sm">
                            <i class="fa-light fa-mailbox"></i>
                            کدپستی: {{ $address->postal_code }}
                        </span>
                        <span class="text-sm">
                            <i class="fa-light fa-user"></i>
                            نام تحویل گیرنده: {{ $address->receiver_name }}
                        </span>
                        <span class="text-sm">
                            <i class="fa-light fa-mobile"></i>
                            موبایل تحویل گیرنده: {{ $address->receiver_mobile }}</span>

                        <div class="flex justify-end">
                            <div class="flex items-center gap-x-3">
                                <form class="m-0" action="{{ route('app.user.addresses.destroy', $address->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="text-gray-500 dark:text-gray-400 text-xl py-3">
                                        <i class="fa-light fa-trash-alt"></i>
                                    </button>
                                </form>
                                <button onclick="setDefaultAddress(this, {{ $address->id }})"
                                data-url="{{ route('app.user.addresses.change-status', $address) }}"
                                    class="px-3 py-2 border-2 flex-center gap-2 text-xs rounded-lg text-red-500 border-red-500 @if ($address->status == 1) selected-address @endif">
                                    @if ($address->status == 1)
                                    <i class="fa-regular fa-check"></i>
                                        پیش فرض
                                    @else
                                        انتخاب پیش فرض
                                    @endif
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach


                <div class="w-full mt-4">
                    <button onclick="toggleAddNewAddress()"
                        class="w-full lg:w-fit lg:px-4 col-span-2 flex-center gap-2 rounded-lg bg-red-500 text-white py-3 text-center text-sm">
                        <i class="fa-regular fa-plus"></i>
                        <span>افزودن آدرس</span>
                    </button>
                </div>
            </div>

        </div>

    </section>
    <!-- addresses ends -->
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
    <script src="{{ asset('app-assets/js/addresses-page.js') }}"></script>
    @if ($errors->any())
        <script>
            toggleAddNewAddress();
        </script>
    @endif
@endsection
