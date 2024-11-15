@extends('layouts.components.landingpage.app')

@section('content')

<!-- Hero Section -->
<section class="text-white dark:bg-blue-950 py-20 text-center bg-[url(http://127.0.0.1:8000/vendor/img/Gracile-digital-art-artwork-illustration-concept-art-environment-2200837-wallhere.com.jpg)] bg-cover" data-aos="fade-down">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold mb-4">Welcome to OURevent</h2>
        <p class="mb-6">Discover the best solution to manage your event efficiently.</p>
        <a href="#Events" class="text-blue-600 px-6 py-3 rounded-full font-semibold hover:bg-gray-200">
            See Current Event
        </a>
    </div>
</section>

<section id="info" class="py-16 bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100">
    <div class="container mx-auto px-6 lg:px-8 lg:px-12" data-aos="fade-in" data-aos-delay="200">   
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="p-8  h-full flex flex-col justify-center items-center" data-aos="fade-right">
                <div class="text-left">
                    <h2 class="text-5xl font-semibold mb-4 text-gray-900 dark:text-gray-100">What Is OURevent?</h2>
                    <p class="text-lg text-gray-700 dark:text-gray-300 leading-relaxed">
                        Discover what OURevent has to offer. From planning to execution, we're here to make your event a success. 
                    </p>
                    <a href="#" class="text-blue-600 hover:text-gray-500 px-6 py-3 rounded-full font-semibold">
                        Read More ->
                    </a>
                </div>
            </div>
            <div data-aos="fade-left" data-aos-delay="300">
                <img src="{{ asset('vendor/img/8d5f781f-9f15-4c39-9781-635555306206.png') }}" alt="OURevent Image" class="rounded-lg object-cover rounded-lg transform transition duration-300 hover:bg-gray-400 dark:hover:bg-gray-800 hover:scale-105">
            </div>
        </div>
    </div>    
</section>


<!-- Events Section -->
<section id="Events" class="py-16 bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-semibold mb-8">Current Events</h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-4 gap-8">
            @forelse ($events as $event)
            <div data-aos="zoom-in" data-aos-offset="-100">
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
                    <a href="{{ route('event.detail', $event->id) }}"
                            class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        See Details
                    </a>
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
<div id="join-event-{{ $event->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed bg-black/50 dark:bg-black/0 top-0 right-0 left-0 z-50 justify-center items-center w-full xl:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 xl:p-5 border-b rounded-t dark:border-gray-600">
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
        </div>
    </div>
</div>
@endforeach

<!-- About Section -->
<section id="about" class="py-16" data-aos="fade-up" data-aos-offset="-100">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-semibold mb-4">About Us</h2>
        <p class="mb-6">We are dedicated to providing the best event management solutions.</p>
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