@extends('layouts.user')

@section('title', 'Edit Event')

@section('content_header')
    <h1 class="text-2xl dark:text-gray-200 font-bold text-gray-700 mb-4">Edit Event: {{ $event->name }}</h1>
@stop

@section('content')
        <form id="dataForm" action="{{ route('event.update', $event->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">        @csrf
        @method('PUT')

        <div class="mb-6">
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
            <input
                type="text"
                name="name"
                id="name"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm dark:bg-gray-800 dark:text-gray-100 dark:placeholder-gray-400"
                placeholder="Event Name"
                value="{{ $event->name }}"
            />
        
            <label for="event_date" class="block mt-4 text-sm font-medium text-gray-700 dark:text-gray-300">Date</label>
            <input
                type="date"
                name="event_date"
                id="event_date"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm dark:bg-gray-800 dark:text-gray-100 dark:placeholder-gray-400"
                value="{{ $event->event_date }}"
            />
        
            <label for="event_start" class="block mt-4 text-sm font-medium text-gray-700 dark:text-gray-300">Start</label>
            <input
                type="time"
                name="event_start"
                id="event_start"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm dark:bg-gray-800 dark:text-gray-100 dark:placeholder-gray-400"
                value="{{ $event->event_start }}"
            />
        
            <label for="event_end" class="block mt-4 text-sm font-medium text-gray-700 dark:text-gray-300">End</label>
            <input
                type="time"
                name="event_end"
                id="event_end"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm dark:bg-gray-800 dark:text-gray-100 dark:placeholder-gray-400"
                value="{{ $event->event_end }}"
            />
        
            <label for="location" class="block mt-4 text-sm font-medium text-gray-700 dark:text-gray-300">Location</label>
            <textarea
                name="location"
                id="location"
                rows="3"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm dark:bg-gray-800 dark:text-gray-100 dark:placeholder-gray-400"
            >{{ $event->location }}</textarea>

            <label for="thumbnail_img" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Thumbnail Image</label>
            @if($event->thumbnail_img)
                <div class="mb-2">
                    <img src="{{ asset('storage/'.$event->thumbnail_img) }}" alt="Current thumbnail" class="w-48 h-48 object-cover rounded">
                </div>
            @endif
            <input type="file" name="thumbnail_img" id="thumbnail_img" accept="image/*"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm dark:bg-gray-800 dark:text-gray-100"
            />

        </div>        

        <button type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mb-3 inline-flex items-center">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M5 3a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V7.414A2 2 0 0 0 20.414 6L18 3.586A2 2 0 0 0 16.586 3H5Zm3 11a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v6H8v-6Zm1-7V5h6v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1Z" clip-rule="evenodd"/>
                    <path fill-rule="evenodd" d="M14 17h-4v-2h4v2Z" clip-rule="evenodd"/>
                  </svg>                  
                   Save Event
            </button>>
        <a href="{{ route('event.index') }}" class="inline-flex items-center mt-4 px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
            <svg class="w-[24px] h-[24px] text-gray-800 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path d="M14.502 7.046h-2.5v-.928a2.122 2.122 0 0 0-1.199-1.954 1.827 1.827 0 0 0-1.984.311L3.71 8.965a2.2 2.2 0 0 0 0 3.24L8.82 16.7a1.829 1.829 0 0 0 1.985.31 2.121 2.121 0 0 0 1.199-1.959v-.928h1a2.025 2.025 0 0 1 1.999 2.047V19a1 1 0 0 0 1.275.961 6.59 6.59 0 0 0 4.662-7.22 6.593 6.593 0 0 0-6.437-5.695Z"/>
              </svg> Back
        </a>
    </form>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
@stop

@section('js')
    <script>
        // Add any additional JavaScript here
    </script>
@stop
