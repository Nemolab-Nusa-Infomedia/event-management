@extends('layouts.user')

@section('content')
    <div class="flex">
        <div class="rounded-full size-20 outline-4 dark:outline-gray-500 outline-gray-300 p-1 box-content outline relative">
            <form action="{{ route('user.update.picture', Auth::user()) }}" method="POST" enctype="multipart/form-data" id="profilePictureForm">
                @csrf
                <input type="file" name="profile_pict" id="profile_pict" class="hidden" accept="image/*">
                <div class="absolute flex justify-center items-center -right-1 -top-1 outline outline-1 bg-gray-200 dark:bg-gray-700 rounded-full size-8 cursor-pointer" onclick="document.getElementById('profile_pict').click()">
                    <svg class="size-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linejoin="round" stroke-width="2"
                            d="M4 18V8a1 1 0 0 1 1-1h1.5l1.707-1.707A1 1 0 0 1 8.914 5h6.172a1 1 0 0 1 .707.293L17.5 7H19a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1Z" />
                        <path stroke="currentColor" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </div>
                <img src="{{ Auth::user()->profile_pict ? Storage::url('profile_pictures/' . Auth::user()->profile_pict) : 'https://flowbite.com/docs/images/people/profile-picture-5.jpg' }}" 
                    class="rounded-full size-20 cursor-pointer"
                    alt="Profile Picture"
                    onclick="document.getElementById('profile_pict').click()">
            </form>
        </div>
        <div class="grid grid-[repeat(auto-fit,_minmax(200px,_1fr))]">
            <div class="flex flex-col ml-4 gap-2 justify-center items-start">
                <p class="text-xl font-semibold text-gray-900 dark:text-white" role="none">
                    {{ Auth::user()->name }}
                </p>
                <p class="text-sm text-gray-500 dark:text-gray-400" role="none">
                    {{ Auth::user()->email }}
                </p>
            </div>
        </div>
    </div>
    <hr class="my-8 bg-gray-200 dark:border-gray-600">
    <div>
        <h2 class="text-center text-2xl font-semibold text-gray-900 dark:text-gray-200 mb-4">Events</h2>
        <div class="flex flex-wrap -mx-2 mb-4">
            <div class="w-full sm:w-1/2 md:w-1/3 px-2 mb-4">
                <div class="flex items-center bg-blue-500 text-white rounded-lg p-4 shadow-md">
                    <svg class="w-[48px] h-[48px] text-gray-800 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M5 5a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1 2 2 0 0 1 2 2v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a2 2 0 0 1 2-2ZM3 19v-7a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm6.01-6a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm-10 4a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z"
                            clip-rule="evenodd" />
                    </svg>
                    <div class="ml-4">
                        <p class="text-sm font-semibold">Event Joined</p>
                        <p class="text-lg font-bold"></p>
                    </div>
                </div>
            </div>
            <div class="w-full sm:w-1/2 md:w-1/3 px-2 mb-4">
                <div class="flex items-center bg-yellow-500 text-white rounded-lg p-4 shadow-md">
                    <svg class="w-[48px] h-[48px] text-gray-800 text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                            clip-rule="evenodd" />
                    </svg>
                    <div class="ml-4">
                        <p class="text-sm font-semibold">Event Created</p>
                        <p class="text-lg font-bold"></p>
                    </div>
                </div>
            </div>
            <div class="w-full sm:w-1/2 md:w-1/3 px-2 mb-4">
                <div class="flex items-center bg-red-500 text-white rounded-lg p-4 shadow-md">
                    <svg class="w-[48px] h-[48px] text-gray-800 text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M13.5 2c-.178 0-.356.013-.492.022l-.074.005a1 1 0 0 0-.934.998V11a1 1 0 0 0 1 1h7.975a1 1 0 0 0 .998-.934l.005-.074A7.04 7.04 0 0 0 22 10.5 8.5 8.5 0 0 0 13.5 2Z" />
                        <path d="M11 6.025a1 1 0 0 0-1.065-.998 8.5 8.5 0 1 0 9.038 9.039A1 1 0 0 0 17.975 13H11V6.025Z" />
                    </svg>
                    <div class="ml-4">
                        <p class="text-sm font-semibold">Total Participant Event</p>
                        <p class="text-lg font-bold"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <script>
    document.getElementById('profile_pict').addEventListener('change', function() {
        if (this.files && this.files[0]) {
            document.getElementById('profilePictureForm').submit();
        }
    });
    </script>
@stop
