@extends('layouts.app')

@section('title', 'Detail Event (' . $event->name . ')')

@section('content')
    @if (session('fail'))
    <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
          <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Fail</span>
        <div>
          {{session('fail')}}
        </div>
      </div>
    @endif

    <div class="container mx-auto p-4 sm:p-8 mb-4">
        <div class="w-full h-64 rounded-lg shadow-lg overflow-hidden mb-4" data-aos="fade-up" data-aos-offset="100">
            <div class="scroll-container w-full">
                <img src="{{ $event->thumbnail_img ? asset('storage/' . $event->thumbnail_img) : 'https://placehold.co/1700x1000/f3f4f6/000000/webp?text=Event+Image' }}"
                    alt="{{ $event->name }}" alt="Event Image" class="w-full h-full object-cover">
            </div>
        </div>
        <p class="text-gray-500 dark:text-gray-300" data-aos="fade-right" data-aos-delay="100">
            <strong>{{ $formattedDate }}</strong>
        </p>
        <h1 class="text-3xl sm:text-5xl dark:text-gray-200 font-bold text-gray-700 mb-8" data-aos="fade-right"
            data-aos-offset="100">{{ $event->name }}</h1>
        <div class="flex items-center" data-aos="fade-right" data-aos-offset="100">
            <img class="w-8 h-8 rounded-full"
                src="{{ $creator->profile_pict ? asset('storage/profile_pictures/' . $creator->profile_pict) : 'https://flowbite.com/docs/images/people/profile-picture-5.jpg' }}"
                alt="user photo">
            <p class="mx-4 dark:text-gray-200 ">by <strong>{{ $creator->name }}</strong></p>
        </div>
    </div>

    <section id="info"
        class="container mx-auto p-4 sm:p-16 md:p-24 mb-4 bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-100"
        data-aos="fade-up" data-aos-offset="100">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
            <div>
                <div class="p-4 sm:p-8 mb-6">
                    <h1 class="text-2xl sm:text-3xl dark:text-gray-200 font-bold text-gray-700 mb-4">Date & Time</h1>
                    <div class="lg:flex">
                        <p class="flex lg:border-r-2 pr-2 items-center">
                            <svg class="mx-2 w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M5 5a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1 2 2 0 0 1 2 2v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a2 2 0 0 1 2-2ZM3 19v-7a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm6.01-6a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm-10 4a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $formattedDate }}
                        </p>
                        <p class="flex items-center">
                            <svg class="mx-2 w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" />
                            </svg>
                            {{ $formattedStartTime }} @if ($formattedEndTime)
                                - {{ $formattedEndTime }}
                            @endif
                        </p>
                    </div>
                </div>
                <div class="p-4 sm:p-8 mb-6">
                    <h1 class="text-2xl sm:text-3xl dark:text-gray-200 font-bold text-gray-700 mb-4">Location</h1>
                    <p class="flex items-center">
                        <svg class="mx-2 w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M11.906 1.994a8.002 8.002 0 0 1 8.09 8.421 7.996 7.996 0 0 1-1.297 3.957.996.996 0 0 1-.133.204l-.108.129c-.178.243-.37.477-.573.699l-5.112 6.224a1 1 0 0 1-1.545 0L5.982 15.26l-.002-.002a18.146 18.146 0 0 1-.309-.38l-.133-.163a.999.999 0 0 1-.13-.202 7.995 7.995 0 0 1 6.498-12.518Z" />
                        </svg>
                        {{ $event->location }}
                    </p>
                </div>
                <div class="p-4 sm:p-8 mb-6">
                    <h1 class="text-2xl sm:text-3xl dark:text-gray-200 font-bold text-gray-700 mb-4">About This Event</h1>
                    <p>{{ $event->about ?? 'No description available' }}</p>
                    <button data-modal-target="join-event" data-modal-toggle="join-event"
                        class="block mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Join
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-2" data-aos="zoom-in" data-aos-offset="100">
                @php
                    $images = $event->quad_img ? explode(', ', $event->quad_img) : [];
                    $i = 0;
                @endphp

                @foreach ($images as $image)
                    <img class="transform transition duration-300 hover:scale-105 object-cover h-[250px] sm:h-[200px] md:h-[250px] lg:h-[250px] w-[250px] sm:w-[200px] md:w-[250px] lg:w-[350px] rounded-lg border border-gray-300"
                        src="{{ asset('storage/' . $image) }}" alt="Event Image {{ $i++ }}">
                @endforeach
            </div>
        </div>
    </section>

    <!-- Main modal -->
    <div id="join-event" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed bg-black/50 dark:bg-black/0 top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-screen max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        {{ $event->name }}
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="join-event">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" action="{{ route('join') }}" method="post">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Lengkap</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required="" @auth value="{{ Auth::user()->name }}" @endauth>
                        </div>
                        <div class="col-span-2">
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required="" @auth value="{{ Auth::user()->email }}" @endauth>
                        </div>
                        <div class="col-span-2">
                            <label for="phone-number"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor Handphone</label>
                            <input type="text" name="no_telp" id="phone-number"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required="" @auth value="{{ Auth::user()->no_telp }}" @endauth>
                        </div>
                        <div class="col-span-2">
                            <label for="address"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Instansi / Asal</label>
                            <textarea id="address" name="alamat" rows="4"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">@auth {{ Auth::user()->alamat }} @endauth</textarea>
                        </div>
                        @auth
                            <div class="col-span-2 flex items-center">
                                <input checked id="checked-checkbox" type="checkbox" name="for_me" value=""
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checked-checkbox"
                                    class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">For Me</label>
                            </div>
                            <span id="checked-info"
                                class="text-red-600 dark:text-red-500 font-semibold text-xs col-span-2">You can't change data
                                if For Me
                                checked</span>
                        @endauth
                        @error('name')
                            {{ $message }}
                        @enderror
                        @error('email')
                            {{ $message }}
                        @enderror
                        @error('no_telp')
                            {{ $message }}
                        @enderror
                        @error('alamat')
                            {{ $message }}
                        @enderror
                        @error('id_event')
                            {{ $message }}
                        @enderror
                        @error('id_user')
                            {{ $message }}
                        @enderror
                    </div>
                    @csrf
                    @auth
                    <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                    @endauth
                    <input type="hidden" name="id_event" value="{{ $event->id }}">
                    <button type="submit"
                        class="block mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Join
                    </button>
                </form>
            </div>
        </div>
    </div>

    <style>
        .scroll-container {
            display: inline-block;
            white-space: nowrap;
        }

        @media (min-width: 1024px) {
            .scroll-container {
                animation: scroll-vertical 10s linear infinite alternate;
            }
        }

        @keyframes scroll-vertical {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(-70%);
            }
        }
    </style>
    @auth
        <script>
            $('#name').attr('readonly', true);
            $('#email').attr('readonly', true);
            $('#phone-number').attr('readonly', true);
            $('#address').attr('readonly', true);
            $(document).ready(function() {
                $('#checked-checkbox').on('change', function() {
                    if (this.checked) $('#checked-info').removeClass('hidden');
                    else $('#checked-info').addClass('hidden');
                    $('#name').attr('readonly', this.checked);
                    $('#email').attr('readonly', this.checked);
                    $('#phone-number').attr('readonly', this.checked);
                    $('#address').attr('readonly', this.checked);
                })
            });
        </script>
    @endauth
@stop

@section('footer')
    @include('layouts.components.footer')
@stop
