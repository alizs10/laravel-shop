<footer class="bg-gray-100 dark:bg-gray-800 dark:text-white relative shadow-md flex flex-col mt-24">
    <div class="absolute -top-10 md:-top-16 w-full flex justify-center z-0">
        <div class="h-10 md:h-16 w-5/6 bg-red-500 rounded-t-lg p-4 flex items-center">
            <span class="text-white text-sm md:text-lg">فروشگاه اینترنتی لاراول</span>
        </div>
    </div>

    <div class="p-4 grid grid-cols-12 gap-4">
        <div class="col-span-12 md:col-span-6 lg:col-span-3 flex flex-col gap-y-2">
            <span class="text-sm md:text-lg text-red-500"">درباره فروشگاه</span>

            <span class=" text-justify leading-5 text-xs md:text-base">
                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است،
                چاپگرها و
                متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و
                کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و
                آینده،
                شناخت فراوان جامعه و متخصصان را می طلبد.
            </span>
        </div>

        <div class="col-span-12 md:col-span-6 lg:col-span-3 flex flex-col md:mt-7 gap-y-2 text-xs md:text-base">
            <span class="">
                <i class="fa-solid fa-location-dot text-lg text-gray-700 dark:text-gray-400"></i>
                تهران بزرگ، تهران، شهرک صنعتی لاراول
            </span>
            <span class="">
                <i class="fa-solid fa-phone-rotary text-lg text-gray-700 dark:text-gray-400"></i>
                021-4578124
            </span>
            <span class="">
                <i class="fa-solid fa-envelope text-lg text-gray-700 dark:text-gray-400"></i>
                laravel@laravel.com
            </span>
        </div>

        <div class="col-span-12 lg:col-span-6 grid grid-cols-12 items-end sm:items-start gap-4 mt-2">

            <div class="col-span-6 flex flex-col justify-start gap-y-4 text-2xl md:text-4xl">
                <span class="text-xxs md:text-base">لاراول در شبکه های اجتماعی</span>

                <div class="flex gap-x-6">
                    <a href="" class="text-sky-400">
                        <i class="fa-brands fa-twitter"></i>
                    </a>

                    <a class="text-pink-500" href="">
                        <i class="fa-brands fa-instagram"></i>
                    </a>

                    <a href="" class="text-sky-500">
                        <i class="fa-solid fa-paper-plane"></i>
                    </a>
                </div>
            </div>


            <div class="col-span-6 grid grid-cols-3 gap-1">
                <div class="col-span-1 flex-center bg-white rounded-lg p-2">
                    <img class="w-full sm:w-20 md:w-40" src="{{ asset('app-assets/images/namad1.png') }}" alt="">
                </div>
                <div class="col-span-1 flex-center bg-white rounded-lg p-2">
                    <img class="w-full sm:w-20 md:w-40" src="{{ asset('app-assets/images/namad2.png') }}" alt="">
                </div>
                <div class="col-span-1 flex-center bg-white rounded-lg p-2">
                    <img class="w-full sm:w-20 md:w-40" src="{{ asset('app-assets/images/namad3.png') }}" alt="">
                </div>
            </div>



        </div>
    </div>

    <div class="col-span-12 text-center mt-5 mb-20 md:mb-2">
        <span class="text-xs">Copyright 2022 by laravel-shop - All Rights Reserved</span>
    </div>

</footer>