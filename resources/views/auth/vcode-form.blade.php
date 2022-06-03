<form class="flex flex-col w-3/4 lg:w-2/5 mt-4 self-center" action="{{ route('auth.check-verification-code') }}"
    method="POST">
    @csrf
    <label class="text-xs text-gray-500 dark:text-gray-100 mb-2" for="">کد تایید</label>
    <div class="grid grid-cols-6 gap-x-2" style="direction:ltr">
        <input type="text" maxlength="1" name="vcode[]"
            class="col-span-1 text-center form-control block w-full px-1 py-2 text-base font-normal text-gray-700 dark:text-gray-100 bg-transparent bg-clip-padding border-2 border-solid rounded-lg transition ease-in-out m-0 focus:border-red-500 focus:outline-none" />
        <input type="text" maxlength="1" name="vcode[]"
            class="col-span-1 text-center form-control block w-full px-1 py-2 text-base font-normal text-gray-700 dark:text-gray-100 bg-transparent bg-clip-padding border-2 border-solid rounded-lg transition ease-in-out m-0 focus:border-red-500 focus:outline-none" />
        <input type="text" maxlength="1" name="vcode[]"
            class="col-span-1 text-center form-control block w-full px-1 py-2 text-base font-normal text-gray-700 dark:text-gray-100 bg-transparent bg-clip-padding border-2 border-solid rounded-lg transition ease-in-out m-0 focus:border-red-500 focus:outline-none" />
        <input type="text" maxlength="1" name="vcode[]"
            class="col-span-1 text-center form-control block w-full px-1 py-2 text-base font-normal text-gray-700 dark:text-gray-100 bg-transparent bg-clip-padding border-2 border-solid rounded-lg transition ease-in-out m-0 focus:border-red-500 focus:outline-none" />
        <input type="text" maxlength="1" name="vcode[]"
            class="col-span-1 text-center form-control block w-full px-1 py-2 text-base font-normal text-gray-700 dark:text-gray-100 bg-transparent bg-clip-padding border-2 border-solid rounded-lg transition ease-in-out m-0 focus:border-red-500 focus:outline-none" />
        <input type="text" maxlength="1" name="vcode[]"
            class="col-span-1 text-center form-control block w-full px-1 py-2 text-base font-normal text-gray-700 dark:text-gray-100 bg-transparent bg-clip-padding border-2 border-solid rounded-lg transition ease-in-out m-0 focus:border-red-500 focus:outline-none" />

    </div>
    <input type="hidden" name="email" value="{{ request()->get('email') }}" />

    <button type="submit" class="btn bg-red-500 text-white mt-2">تایید</button>

</form>
