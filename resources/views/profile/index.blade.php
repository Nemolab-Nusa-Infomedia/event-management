@extends('layouts.user')

@section('content')

    @include('layouts.components.profile.app')
    
    <div class="text-black dark:text-white ">
        <div class="flex flex-col xl:flex-row gap-4">
            <div class="grow ">
                <h2 class="text-center text-2xl font-semibold text-gray-900 dark:text-gray-200 mb-4">Profile</h2>
                <div class=" grid grid-cols-4 gap-4">
                    <div class="lg:col-span-2 col-span-4">
                        <div class="mb-2 ml-2">Name</div>
                        <div class="relative p-2 rounded-lg border-2 dark:border-gray-600 h-12">{{ Auth::user()->name }}
                        </div>
                    </div>
                    <div class="lg:col-span-2 col-span-4">
                        <div class="mb-2 ml-2">Email</div>
                        <div class="relative p-2 rounded-lg border-2 dark:border-gray-600 h-12">{{ Auth::user()->email }}
                        </div>
                    </div>
                    <div class="lg:col-span-1 col-span-4">
                        <div class="mb-2 ml-2">Phone</div>
                        <div class="relative p-2 rounded-lg border-2 dark:border-gray-600 h-12">{{ Auth::user()->no_telp }}
                        </div>
                    </div>
                    <div class="lg:col-span-3 col-span-4">
                        <div class="mb-2 ml-2">Address</div>
                        <div class="relative p-2 rounded-lg border-2 dark:border-gray-600 h-12">{{ Auth::user()->alamat }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="border border-1 dark:border-gray-600"></div>
            <div class="grow flex flex-col gap-4">
                <a href="{{route('profileData')}}"
                    class="p-2 h-12 flex items-center justify-center text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600">Change
                    Profile Data</a>
                <button
                    class="p-2 h-12 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600">Change
                    Email</button>
                <button
                    class="p-2 h-12 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600">Change
                    Password</button>
                <button
                    class="p-2 h-12 focus:outline-none text-white font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 bg-red-600 hover:bg-red-700">Delete
                    Account</button>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
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
