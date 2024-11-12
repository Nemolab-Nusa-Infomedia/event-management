@extends('layouts.user')

@section('title', 'Edit Event')

@section('content_header')
    <h1 class="text-2xl font-semibold mb-4">Edit Event</h1>
@stop

@section('content')
    <form id="dataForm" action="{{ route('event.update', $event->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input
                type="text"
                name="name"
                id="name"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                placeholder="Event Name"
                value="{{ $event->name }}"
            />

            <label for="event_date" class="block mt-4 text-sm font-medium text-gray-700">Date</label>
            <input
                type="date"
                name="event_date"
                id="event_date"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                value="{{ $event->event_date }}"
            />

            <label for="event_start" class="block mt-4 text-sm font-medium text-gray-700">Start</label>
            <input
                type="time"
                name="event_start"
                id="event_start"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                value="{{ $event->event_start }}"
            />

            <label for="event_end" class="block mt-4 text-sm font-medium text-gray-700">End</label>
            <input
                type="time"
                name="event_end"
                id="event_end"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                value="{{ $event->event_end }}"
            />

            <label for="location" class="block mt-4 text-sm font-medium text-gray-700">Location</label>
            <textarea
                name="location"
                id="location"
                rows="3"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
            >{{ $event->location }}</textarea>
        </div>

        <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
            <i class="fas fa-plus mr-2"></i> Save
        </button>
        <a href="{{ route('event.index') }}" class="inline-flex items-center px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
            <i class="fas fa-backward mr-2"></i> Back
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
