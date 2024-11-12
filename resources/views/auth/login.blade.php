@include('layouts.components.header')

<body>
    <div class="h-screen bg-gradient-to-br from-blue-600 to-cyan-300 flex justify-center items-center w-full">

        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="bg-white px-10 py-8 rounded-xl w-screen shadow-xl max-w-sm">
                <div class="space-y-4">
                    <h1 class="text-center text-3xl font-semibold text-gray-600">Login</h1>
                    <hr>
                    <div class="flex items-center rounded-md mb-4 relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute left-4"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                        <input
                            class="border-2 pl-12 pr-2 py-2 outline-none w-full rounded-md valid:border-green-400 focus:invalid:border-red-600 peer"
                            type="email" name="email" value="" placeholder="Email" required />
                    </div>
                    <div class="flex items-center rounded-md relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute left-4"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <input
                            class="border-2 pl-12 pr-2 py-2 outline-none w-full rounded-md valid:border-green-400 focus:invalid:border-red-600"
                            type="password" name="password" id="" placeholder="Password" minlength="8"
                            required />
                    </div>
                </div>
                <p class="text-red-600 text-center mt-2 font-semibold text-xs">
                    @error('email')
                        {{ $message }}
                    @enderror
                </p>

                <div class="flex justify-between items-center mt-4">
                    <div class="flex justify-left items-center">
                        <input type="checkbox" id="rememberMeCheckbox" name="rememberMe" class="mr-2 cursor-pointer">
                        <label for="rememberMeCheckbox" class="text-xs font-semibold cursor-pointer">Remember me?</span>
                    </div>
                    <a href="{{ route('password.request') }}"
                        class="no-underline text-xs text-blue-500 hover:text-blue-600 active:text-blue-800 font-semibold">Forgot
                        Passowrd</a>
                </div>

                <button type="submit" value="login" id="login"
                    class="mt-6 w-full shadow-xl bg-blue-500 hover:bg-blue-600 active:bg-blue-800 text-indigo-100 py-2 rounded-md text-lg tracking-wide transition duration-300">Login</button>
                <hr>
                <div class="flex justify-center items-center mt-4">
                    <p class="inline-flex items-center text-gray-700 font-medium text-xs text-center">
                        <span class="ml-2">You don't have an account?<a href="{{ route('register') }}"
                                class="text-xs ml-2 text-blue-500 hover:text-blue-600 active:text-blue-800 font-semibold no-underline">Register
                                now &rarr;</a>
                        </span>
                    </p>
                </div>
            </div>
        </form>
    </div>
</body>
