<form class="flex flex-col w-3/4 lg:w-2/5 mt-4 self-center" action="{{ route('auth.login') }}" method="POST">
    @csrf
    <label class="text-xs text-gray-500 mb-2" for="password">کلمه عبور</label>
    <input type="password" name="password"
        class="form-control block w-full px-3 py-2 text-base font-normal text-gray-700 dark:text-gray-100 bg-transparent bg-clip-padding border-2 border-solid rounded-lg transition ease-in-out m-0 focus:border-red-500 focus:outline-none" />
    <input type="hidden" name="email" value="{{ request()->get('email') }}" />

    <button type="submit" class="btn bg-red-500 text-white mt-2">ورود</button>
</form>
