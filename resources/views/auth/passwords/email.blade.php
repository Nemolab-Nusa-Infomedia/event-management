@include('layouts.components.header')

<body>

    @if (session('status'))
        <div id="alert"
            class="absolute p-4 mb-4 text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800 left-1/2 -translate-x-1/2 top-10"
            role="alert">
            <div class="flex items-baseline">
                <svg class="flex-shrink-0 w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <h3 class="text-lg font-medium">Check message in your Email</h3>
            </div>
            <div class="mt-2 mb-4 text-sm">
                {{ session('status') }}
            </div>
            <div class="flex">
                <button type="button" onclick="$('#alert').remove()"
                    class="text-white bg-green-800 hover:bg-green-900 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-xs px-3 py-1.5 me-2 text-center inline-flex items-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    Ok
                </button>
            </div>
        </div>
    @endif

    <div class="h-screen bg-gradient-to-br dark:from-blue-800 dark:to-cyan-800 from-blue-600 to-cyan-300 flex justify-center items-center w-full">

        <form action="{{ route('password.email') }}" method="post">
            @csrf
            <div class="bg-white px-10 py-8 rounded-xl w-screen shadow-xl max-w-sm">
                <div class="space-y-4">
                    <h1 class="text-center text-3xl font-semibold text-gray-600">Login</h1>
                    <hr>
                    <div class="flex items-center rounded-md mb-2 relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute left-4"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                        <input
                            class="border-2 pl-12 pr-2 py-2 outline-none w-full rounded-md valid:border-green-400 focus:invalid:border-red-600 peer"
                            type="email" name="email" value="" placeholder="Email" required />
                    </div>
                </div>
                <p class="text-red-600 text-center mt-2 text-xs font-semibold">
                    @error('email')
                        {{ $message }}
                    @enderror
                </p>

                <button type="submit" value="login" id="login"
                    class="mt-2 w-full shadow-xl bg-blue-500 hover:bg-blue-600 active:bg-blue-800 text-indigo-100 py-2 rounded-md text-lg tracking-wide transition duration-300">Send
                    Email</button>
                <hr>

                <div class="flex flex-col justify-center items-center mt-4">
                    <p class="inline-flex items-center text-gray-700 font-medium text-xs text-center">
                        <span class="ml-2">Remember password?<a href="{{ route('login') }}"
                                class="text-xs ml-2 text-blue-500 hover:text-blue-600 active:text-blue-800 font-semibold no-underline">Login
                                now &rarr;</a>
                        </span>
                    </p>
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

@include('layouts.components.footer')