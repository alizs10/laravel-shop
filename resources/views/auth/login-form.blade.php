<a href="{{ route('auth.redirect-to-google') }}"
    class="btn mt-4 bg-gray-200 dark:bg-gray-600 dark:text-gray-100 w-3/4 lg:w-2/5 flex self-center justify-between items-center">
    <span class="text-xs lg:text-sm">ورود با گوگل</span>
    <img src="{{ asset('app-assets/images/google.svg') }}" class="w-6" alt="">
</a>

<form class="flex flex-col w-3/4 lg:w-2/5 mt-4 self-center" action="{{ route('auth.check-email') }}" method="POST">
    @csrf
    <label class="text-xs text-gray-500 mb-2" for="">ایمیل</label>
    <input type="email" name="email"
        class="form-control block w-full px-3 py-2 text-base font-normal text-gray-700 dark:text-gray-100 bg-transparent bg-clip-padding border-2 border-solid rounded-lg transition ease-in-out m-0 focus:border-red-500 focus:outline-none"
        placeholder="abc@example.com" />

    <button type="submit" class="btn bg-red-500 text-white mt-2">ورود</button>
</form>
