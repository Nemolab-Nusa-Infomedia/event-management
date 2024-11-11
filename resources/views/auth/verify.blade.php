@include('layouts.header')

<body>
    <div class="h-screen bg-gradient-to-br from-blue-600 to-cyan-300 flex justify-center items-center w-full">

        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="bg-white px-10 py-8 rounded-xl w-screen shadow-xl max-w-sm">
                <div class="space-y-4">
                    <h1 class="text-center text-3xl font-semibold text-gray-600">Login</h1>
                    <hr>
                    <div class="mt-4">
                        You need to verify your account. Please check your email to verify
                    </div>
                </div>
                <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" value="login" id="login"
                        class="mt-6 w-full shadow-xl bg-blue-500 hover:bg-blue-600 active:bg-blue-800 text-indigo-100 py-2 rounded-md text-lg tracking-wide transition duration-300">Resend
                        Email</button>
                </form>
                <hr>
                <div class="flex justify-center items-center mt-4">
                    <p class="inline-flex items-center text-gray-700 font-medium text-xs text-center">
                        <span class="ml-2">Wrong email?<a href="{{route('change.email')}}" class="text-xs ml-2 text-blue-500 hover:text-blue-600 active:text-blue-800 font-semibold no-underline cursor-pointer">Back to Register &rarr;</a>
                        </span>
                    </p>
                </div>

            </div>
        </form>
    </div>
</body>
