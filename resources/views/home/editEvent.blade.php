@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4 sm:p-8 mb-4">
        <div class="w-full h-64 rounded-lg shadow-lg overflow-hidden mb-4" data-aos="fade-up" data-aos-offset="100">
            <div class="scroll-container w-full">
                <img src="{{ $event->thumbnail_img ? asset('storage/' . $event->thumbnail_img) : 'https://placehold.co/1700x1000/f3f4f6/000000/webp?text=Event+Image' }}"
                alt="{{ $event->name }}" 
                     alt="Event Image" 
                     class="w-full h-full object-cover">
            </div>
        </div>
        <p class="text-gray-500 dark:text-gray-300" data-aos="fade-right" data-aos-delay="100">
            <strong>{{ $formattedDate }}</strong>
        </p>
        <h1 class="text-3xl sm:text-5xl dark:text-gray-200 font-bold text-gray-700 mb-8" data-aos="fade-right" data-aos-offset="100">
            {{ $event->name }}
            <button data-modal-target="edit-event-name" data-modal-toggle="edit-event-name"
                class="text-blue-600 dark:text-blue-600 hover:text-gray-500">
                <svg class="w-[16px] h-[16px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                </svg>
            </button>
        </h1>
        <div class="flex items-center" data-aos="fade-up" data-aos-offset="100">
            <img class="w-8 h-8 rounded-full"
                src="{{ Auth::user()->profile_pict ? Storage::url('profile_pictures/' . Auth::user()->profile_pict) : 'https://flowbite.com/docs/images/people/profile-picture-5.jpg' }}"
                alt="user photo">
            <p class="mx-4 dark:text-gray-200 ">by <strong>{{ $creator->name }}</strong></p>
        </div>
    </div>



    <section id="info"
        class="container mx-auto p-4 sm:p-16 mb-4 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100"
        data-aos="fade-up" data-aos-offset="100">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
            <div>
                <div class="p-4 sm:p-8 mb-6">
                    <h1 class="text-2xl sm:text-3xl dark:text-gray-200 font-bold text-gray-700 mb-4">Date & Time
                        <button data-modal-target="edit-event-datetime" data-modal-toggle="edit-event-datetime"
                            class="text-blue-600 dark:text-blue-600 hover:text-gray-500">
                            <svg class="w-[16px] h-[16px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                            </svg>
                        </button>
                    </h1>
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
                    <h1 class="text-2xl sm:text-3xl dark:text-gray-200 font-bold text-gray-700 mb-4">Location
                        <button data-modal-target="edit-event-location" data-modal-toggle="edit-event-location"
                            class="text-blue-600 dark:text-blue-600 hover:text-gray-500">
                            <svg class="w-[16px] h-[16px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                            </svg>
                        </button>
                    </h1>
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
                    <h1 class="text-2xl sm:text-3xl dark:text-gray-200 font-bold text-gray-700 mb-4">About This Event
                        <button data-modal-target="edit-event-description" data-modal-toggle="edit-event-description"
                            class="text-blue-600 dark:text-blue-600 hover:text-gray-500">
                            <svg class="w-[16px] h-[16px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                            </svg>
                        </button>
                    </h1>
                    <p>{{ $event->about ?? 'No description available' }}</p>
                </div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-2 gap-2" data-aos="zoom-in" data-aos-offset="100">
                <!-- Input File 1 -->
                <div class="relative">
                    <svg class="absolute @if (!isset($event['images'][0])) hidden @endif right-0 bg-white border-black border z-10 w-6 h-6 text-gray-800 rounded-lg"
                        id="delete-1" onclick="event.preventDefault(); deleteImage(1);" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18 17.94 6M18 18 6.06 6" />
                    </svg>


                    <label for="file-upload-1" class="cursor-pointer">
                        <div id="default-1"
                            class="transform transition duration-300 hover:scale-105 h-[250px] sm:h-[200px] md:h-[250px] lg:h-[250px] w-[250px] sm:w-[200px] md:w-[250px] lg:w-[350px] max-w-full rounded-lg justify-center items-center flex bg-gray-50 dark:bg-gray-700 @if (isset($event['images'][0])) hidden @endif">
                            <svg class="w-[50px] h-[50px] text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            Add Photo
                        </div>
                        <img id="preview-1"
                            class="@if (!isset($event['images'][0])) hidden @endif transform transition duration-300 hover:scale-105 object-cover h-[250px] sm:h-[200px] md:h-[250px] lg:h-[250px] w-[250px] sm:w-[200px] md:w-[250px] lg:w-[350px] rounded-lg border border-gray-300"
                            src="{{ isset($event['images'][0]) ? asset('storage/' . $event['images'][0]) : '' }}"
                            alt="Preview">
                    </label>
                </div>

                <!-- Input File 2 -->
                <div class="relative">
                    <svg class="absolute @if (!isset($event['images'][1])) hidden @endif right-0 bg-white border-black border z-10 w-6 h-6 text-gray-800 rounded-lg"
                        id="delete-2" onclick="event.preventDefault(); deleteImage(2);" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18 17.94 6M18 18 6.06 6" />
                    </svg>
                    <label for="file-upload-2" class="cursor-pointer">
                        <div id="default-2"
                            class="transform transition duration-300 hover:scale-105 h-[250px] sm:h-[200px] md:h-[250px] lg:h-[250px] w-[250px] sm:w-[200px] md:w-[250px] lg:w-[350px] max-w-full rounded-lg justify-center items-center flex bg-gray-50 dark:bg-gray-700 @if (isset($event['images'][1])) hidden @endif">
                            <svg class="w-[50px] h-[50px] text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            Add Photo
                        </div>
                        <img id="preview-2"
                            class="@if (!isset($event['images'][1])) hidden @endif transform transition duration-300 hover:scale-105 object-cover h-[250px] sm:h-[200px] md:h-[250px] lg:h-[250px] w-[250px] sm:w-[200px] md:w-[250px] lg:w-[350px] rounded-lg border border-gray-300"
                            src="{{ isset($event['images'][1]) ? asset('storage/' . $event['images'][1]) : '' }}"
                            alt="Preview">
                    </label>
                </div>

                <!-- Input File 3 -->
                <div class="relative">
                    <svg class="absolute right-0 @if (!isset($event['images'][2])) hidden @endif bg-white border-black border z-10 w-6 h-6 text-gray-800 rounded-lg"
                        id="delete-3" onclick="event.preventDefault(); deleteImage(3);" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18 17.94 6M18 18 6.06 6" />
                    </svg>
                    <label for="file-upload-3" class="cursor-pointer">
                        <div id="default-3"
                            class="transform transition duration-300 hover:scale-105 h-[250px] sm:h-[200px] md:h-[250px] lg:h-[250px] w-[250px] sm:w-[200px] md:w-[250px] lg:w-[350px] max-w-full rounded-lg justify-center items-center flex bg-gray-50 dark:bg-gray-700 @if (isset($event['images'][2])) hidden @endif">
                            <svg class="w-[50px] h-[50px] text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            Add Photo
                        </div>
                        <img id="preview-3"
                            class="@if (!isset($event['images'][2])) hidden @endif transform transition duration-300 hover:scale-105 object-cover h-[250px] sm:h-[200px] md:h-[250px] lg:h-[250px] w-[250px] sm:w-[200px] md:w-[250px] lg:w-[350px] rounded-lg border border-gray-300"
                            src="{{ isset($event['images'][2]) ? asset('storage/' . $event['images'][2]) : '' }}"
                            alt="Preview">
                    </label>
                </div>

                <!-- Input File 4 -->
                <div class="relative">
                    <svg class="absolute @if (!isset($event['images'][3])) hidden @endif right-0 bg-white border-black border z-10 w-6 h-6 text-gray-800 rounded-lg"
                        id="delete-4" onclick="event.preventDefault(); deleteImage(4);" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18 17.94 6M18 18 6.06 6" />
                    </svg>
                    <label for="file-upload-4" class="cursor-pointer">
                        <div id="default-4"
                            class="transform transition duration-300 hover:scale-105 h-[250px] sm:h-[200px] md:h-[250px] lg:h-[250px] w-[250px] sm:w-[200px] md:w-[250px] lg:w-[350px] max-w-full rounded-lg justify-center items-center flex bg-gray-50 dark:bg-gray-700 @if (isset($event['images'][3])) hidden @endif">
                            <svg class="w-[50px] h-[50px] text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            Add Photo
                        </div>
                        <img id="preview-4"
                            class="@if (!isset($event['images'][3])) hidden @endif transform transition duration-300 hover:scale-105 object-cover h-[250px] sm:h-[200px] md:h-[250px] lg:h-[250px] w-[250px] sm:w-[200px] md:w-[250px] lg:w-[350px] rounded-lg border border-gray-300"
                            src="{{ isset($event['images'][3]) ? asset('storage/' . $event['images'][3]) : '' }}"
                            alt="Preview">
                    </label>
                </div>
                <form enctype="multipart/form-data" method="post" class="col-span-2" id="imagePreview">
                    <input type="text" class="hidden" name="deleted_image" id="deleted_image">
                    <input type="hidden" name="has_image" id="_image_">
                    <input id="file-upload-1" type="file" accept="image/*" name="image_1" class="hidden"
                        onchange="previewImage(event, 'preview-1', 'default-1', 1)">
                    <input id="file-upload-2" type="file" accept="image/*" name="image_2" class="hidden"
                        onchange="previewImage(event, 'preview-2', 'default-2', 2)">
                    <input id="file-upload-3" type="file" accept="image/*" name="image_3" class="hidden"
                        onchange="previewImage(event, 'preview-3', 'default-3', 3)">
                    <input id="file-upload-4" type="file" accept="image/*" name="image_4" class="hidden"
                        onchange="previewImage(event, 'preview-4', 'default-4', 4)">
                    <button class="bg-blue-500 w-full p-2 rounded-lg" onclick="$('#_image_').val('true')">Save</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Modal Name -->
    <div id="edit-event-name" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed bg-black/50 dark:bg-black/0 top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-screen max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Edit Event Name
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="edit-event-name">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form id="editNameForm">
                    <div class="p-4 md:p-5">
                        <div class="grid gap-4 mb-4 grid-cols-1">
                            <div class="col-span-1">
                                <input type="text" name="name" value="{{ $event->name }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                    required>
                            </div>
                        </div>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Save
                            Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Date&time Event -->
    <div id="edit-event-datetime" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed bg-black/50 dark:bg-black/0 top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-screen max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Edit Event Date & Time
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="edit-event-datetime">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form id="editDatetimeForm" class="event-edit-form">
                    <div class="p-4 md:p-5">
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2">
                                <label for="date"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                                <input type="date" name="date" id="date" value="{{ $event->event_date }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required>
                            </div>
                            <div class="col-span-1">
                                <label for="start_time"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start Time</label>
                                <input type="time" name="start_time" id="start_time"
                                    value="{{ $event->event_start }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required>
                            </div>
                            <div class="col-span-1">
                                <label for="end_time"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End Time</label>
                                <input type="time" name="end_time" id="end_time" value="{{ $event->event_end }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            </div>
                        </div>
                        <button type="submit"
                            class="block mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Location -->
    <div id="edit-event-location" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed bg-black/50 dark:bg-black/0 top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-screen max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Edit Event Location
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="edit-event-location">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form id="editLocationForm">
                    <div class="p-4 md:p-5">
                        <div class="grid gap-4 mb-4 grid-cols-1">
                            <div class="col-span-1">
                                <input type="text" name="location" value="{{ $event->location }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                    required>
                            </div>
                        </div>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Save
                            Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Description -->
    <div id="edit-event-description" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed bg-black/50 dark:bg-black/0 top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-screen max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Edit Event Description
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="edit-event-description">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form id="editDescriptionForm" class="event-edit-form">
                    <div class="p-4 md:p-5">
                        <div class="grid gap-4 mb-4 grid-cols-1">
                            <div class="col-span-1">
                                <textarea name="about" id="about" rows="4"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required>{{ $event->about }}</textarea>
                            </div>
                        </div>
                        <button type="submit"
                            class="block mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .scroll-container {
            display: inline-block;
            white-space: nowrap;
        }

        @media (min-width: 640px) {
            .scroll-container {
                animation: scroll-vertical 10s linear infinite alternate;
            }
        }

        @keyframes scroll-vertical {
            0% {
                transform: translateY (0);
            }

            100% {
                transform: translateY(-70%);
            }
        }
    </style>

    <script>
        function previewImage(event, previewId, defaultId, index) {
            const input = event.target;
            const reader = new FileReader();

            reader.onload = function(e) {
                const preview = $('#' + previewId);
                const defaultElement = $('#' + defaultId);
                const deleteIcon = $('#delete-' + index);

                // Tampilkan pratinjau dan sembunyikan elemen default
                preview.attr('src', e.target.result);
                preview.removeClass('hidden');
                defaultElement.addClass('hidden');
                deleteIcon.removeClass('hidden');
            };

            if (input.files && input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).ready(function() {
            // Function to handle form submission
            const deleteImage = $('#deleted_image');

            function handleFormSubmit(formId, modalId = null) {
                const form = $('#' + formId);
                form.on('submit', async function(e) {
                    e.preventDefault();

                    try {
                        const formData = new FormData(this);
                        const response = await fetch(`/events/preview/{{ $event->id }}/update`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: formData
                        });

                        const data = await response.json();

                        if (data.success) {
                            // Close modal
                            console.log(data);
                            const modal = $('#' + modalId);
                            modal.addClass('hidden');

                            // Reload page to show updates
                            location.reload();
                        } else {
                            alert('Failed to update event');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('An error occurred while updating the event');
                    }
                });
            }

            // Initialize form handlers
            handleFormSubmit('imagePreview');
            handleFormSubmit('editNameForm', 'edit-event-name');
            handleFormSubmit('editDatetimeForm', 'edit-event-datetime');
            handleFormSubmit('editLocationForm', 'edit-event-location');
            handleFormSubmit('editDescriptionForm', 'edit-event-description');

        });

        function deleteImage(id) {
            // Prevent event bubbling
            event.stopPropagation();

            if (confirm("Are you sure you want to delete this image?")) {
                // Get elements
                const preview = document.getElementById(`preview-${id}`);
                const defaultDiv = document.getElementById(`default-${id}`);
                const fileInput = document.getElementById(`file-upload-${id}`);
                const deleteIcon = document.getElementById(`delete-${id}`);

                // Reset the file input
                fileInput.value = '';

                // Hide preview and show default upload div
                preview.classList.add('hidden');
                preview.src = '';
                defaultDiv.classList.remove('hidden');
                deleteIcon.classList.add('hidden');

                // Add the deleted image ID to the hidden input if needed
                let deletedInput = document.getElementById('deleted_image');
                let currentDeleted = deletedInput.value ? deletedInput.value.split(',') : [];

                id -= 1;

                if (!currentDeleted.includes(id.toString())) {
                    currentDeleted.push(id);
                }

                deletedInput.value = currentDeleted.sort((a, b) => a - b).join(',');
                console.log(deletedInput.value);

            }
        }
    </script>
@stop
