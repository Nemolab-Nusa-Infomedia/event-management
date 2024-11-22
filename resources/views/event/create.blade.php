@extends('layouts.app')

@section('title', 'Add Event')

@section('content_header')
    <h1 class="text-2xl dark:text-gray-200 font-bold text-gray-700 mb-4">Add Event</h1>
@stop

@section('content')
    <form action="{{ route('event.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 px-4 pt-1">
        @csrf
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Name</label>
            <input type="text" name="name" id="name" required
                class="block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm dark:bg-gray-800 dark:text-gray-100 dark:placeholder-gray-400"
                placeholder="Event Name" value="{{ old('name') }}" />
            @error('name')
                <p class="text-red-600 dark:text-red-400 text-xs font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="event_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Date</label>
            <input type="date" name="event_date" id="event_date" required
                class="block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm dark:bg-gray-800 dark:text-gray-100 dark:placeholder-gray-400"
                value="{{ old('event_date') }}" />
            @error('event_date')
                <p class="text-red-600 dark:text-red-400 text-xs font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="event_start" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Start</label>
            <input type="time" name="event_start" id="event_start" required
                class="block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm dark:bg-gray-800 dark:text-gray-100 dark:placeholder-gray-400"
                value="{{ old('event_start') }}" />
            @error('event_start')
                <p class="text-red-600 dark:text-red-400 text-xs font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="event_end" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">End</label>
            <input type="time" name="event_end" id="event_end" required
                class="block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm dark:bg-gray-800 dark:text-gray-100 dark:placeholder-gray-400"
                value="{{ old('event_end') }}" />
            @error('event_end')
                <p class="text-red-600 dark:text-red-400 text-xs font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Location</label>
            <textarea name="location" id="location" rows="3" required
                class="block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm dark:bg-gray-800 dark:text-gray-100 dark:placeholder-gray-400">{{ old('location') }}</textarea>
            @error('location')
                <p class="text-red-600 dark:text-red-400 text-xs font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="thumbnail_img" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Thumbnail
                Image</label>
            <input type="file" name="thumbnail_img" id="thumbnail_img" accept="image/*" required
                class="block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm dark:bg-gray-800 dark:text-gray-100" />
            @error('thumbnail_img')
                <p class="text-red-600 dark:text-red-400 text-xs font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex space-x-4">
            <button type="submit"
                class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mb-3 inline-flex items-center">
                <svg class="w-[24px] h-[24px] text-gray-800 text-white" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4.243a1 1 0 1 0-2 0V11H7.757a1 1 0 1 0 0 2H11v3.243a1 1 0 1 0 2 0V13h3.243a1 1 0 1 0 0-2H13V7.757Z"
                        clip-rule="evenodd" />
                </svg>
                Add Event
            </button>
            <a href="{{ route('event.index') }}"
                class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded mb-3 inline-flex items-center">
                <svg class="w-[24px] h-[24px] text-gray-800 text-white" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        d="M14.502 7.046h-2.5v-.928a2.122 2.122 0 0 0-1.199-1.954 1.827 1.827 0 0 0-1.984.311L3.71 8.965a2.2 2.2 0 0 0 0 3.24L8.82 16.7a1.829 1.829 0 0 0 1.985.31 2.121 2.121 0 0 0 1.199-1.959v-.928h1a2.025 2.025 0 0 1 1.999 2.047V19a1 1 0 0 0 1.275.961 6.59 6.59 0 0 0 4.662-7.22 6.593 6.593 0 0 0-6.437-5.695Z" />
                </svg> Back
            </a>
        </div>
    </form>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
@stop

@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop
