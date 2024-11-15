@extends('layouts.components.landingpage.app')

@section('content')

<!-- Hero Section -->
<section class="text-white dark:bg-blue-950 py-20 text-center bg-[url(http://127.0.0.1:8000/vendor/img/Gracile-digital-art-artwork-illustration-concept-art-environment-2200837-wallhere.com.jpg)] bg-cover" data-aos="fade-up">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold mb-4">Welcome to OURevent</h2>
        <p class="mb-6">Discover the best solution to manage your event efficiently.</p>
        <a href="#Events" class="text-blue-600 px-6 py-3 rounded-full font-semibold hover:bg-gray-200">
            Learn More
        </a>
    </div>
</section>

<section id="Events" class="py-16 bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100">
    <div class="container mx-auto px-6 sm:px-8 lg:px-12" data-aos="fade-in" data-aos-delay="200">   
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-12 items-center">
            <div class="p-8 shadow-lg rounded-lg bg-gray-200 dark:bg-gray-800" data-aos="fade-right">
                <h2 class="text-3xl font-semibold mb-4 text-gray-900 dark:text-gray-100">What Is OURevent?</h2>
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                    Discover what OURevent has to offer. Lorem ipsum dolor sit amet, consectetur 
                    adipisicing elit. Iure, quidem, magnam dolore architecto possimus! Join us to 
                    experience incredible events, seamless connections, and unforgettable moments.
                </p>
            </div>
            <div class="p-6" data-aos="fade-left" data-aos-delay="300">
                <img src="{{ asset('vendor/img/wallpaperflare.com_wallpaper (14).jpg') }}" alt="OURevent Image" class="object-cover rounded-lg shadow-md transform transition duration-300 hover:scale-105 hover:shadow-lg">
            </div>
        </div>
    </div>    
</section>


<!-- Events Section -->
<section id="Events" class="py-16 bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-semibold mb-8">Current Events</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
            @forelse ($events as $event)
            <div data-aos="zoom-in">
                <div class="p-6 shadow-md rounded-lg bg-gray-200 dark:bg-gray-800 text-left hover:scale-105 transform transition duration-300">
                    <img src="{{ $event->thumbnail_img ? asset('storage/' . $event->thumbnail_img) : asset('vendor/img/default-event.jpg') }}" 
                         alt="{{ $event->name }}" 
                         class="w-full h-48 object-cover rounded-lg mb-4">
                    <h3 class="text-xl font-semibold mb-2">{{ $event->name }}</h3>
                    <p class="text-gray-700 dark:text-gray-300 mb-2">
                        <strong>Date:</strong> {{ \Carbon\Carbon::parse($event->event_date)->format('F d, Y') }}
                    </p>
                    <p class="text-gray-700 dark:text-gray-300 mb-2">
                        <strong>Time:</strong> {{ \Carbon\Carbon::parse($event->event_start)->format('h:i A') }}
                    </p>
                    <p class="text-gray-700 dark:text-gray-300 mb-2">
                        <strong>Location:</strong> {{ $event->location }}
                    </p>
                    <button data-modal-target="join-event-{{ $event->id }}" 
                            data-modal-toggle="join-event-{{ $event->id }}" 
                            class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Join
                    </button>
                </div>
            </div>
            @empty
            <div class="col-span-4 text-center py-8">
                <p class="text-gray-500 dark:text-gray-400">No events available at the moment.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Modal for each event -->
@foreach ($events as $event)
<div id="join-event-{{ $event->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed bg-black/50 dark:bg-black/0 top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    {{ $event->name }}
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="join-event-{{ $event->id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- <form action="{{ route('event.join', $event->id) }}" method="POST" class="p-4 md:p-5">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                    </div>
                    <div class="col-span-2">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                    </div>
                    <div class="col-span-2">
                        <label for="phone_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                    </div>
                    <div class="col-span-2">
                        <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                        <textarea id="address" name="address" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required></textarea>
                    </div>
                </div>
                <button type="submit" class="flex items-center px-4 py-1 bg-blue-500 dark:bg-blue-600 text-white rounded hover:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-700 focus:ring-opacity-50">
                    <svg class="w-6 h-6 mr-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14 19V5h4a1 1 0 0 1 1 1v11h1a1 1 0 0 1 0 2h-6Z" />
                        <path fill-rule="evenodd" d="M12 4.571a1 1 0 0 0-1.275-.961l-5 1.428A1 1 0 0 0 5 6v11H4a1 1 0 0 0 0 2h1.86l4.865 1.39A1 1 0 0 0 12 19.43V4.57ZM10 11a1 1 0 0 1 1 1v.5a1 1 0 0 1-2 0V12a1 1 0 0 1 1-1Z" clip-rule="evenodd" />
                    </svg>
                    Join
                </button>
            </form> -->
        </div>
    </div>
</div>
@endforeach

<!-- About Section -->
<section id="about" class="py-16" data-aos="fade-up">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-semibold mb-4">About Us</h2>
        <p class="mb-6">We are dedicated to providing the best project management solutions.</p>
        <p>Our platform is trusted by professionals across industries to enhance productivity.</p>
    </div>
</section>

<script>
    AOS.init({
        duration: 500,
        easing: 'ease-in-out',
    });
</script>

@stop