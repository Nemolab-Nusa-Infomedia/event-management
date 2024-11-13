@extends('layouts.user')

@section('title', 'Add Event')

@section('content_header')
    <h1 class="text-2xl font-bold text-gray-700 mb-4">Add Event</h1>
@stop

@section('content')
    <form action="{{ route('event.store') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
            <input type="text" name="name" id="name" required
                class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                placeholder="Event Name" value="{{ old('name') }}" />
            @error('name')
                <p class="text-red-600 text-xs font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="event_date" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
            <input type="date" name="event_date" id="event_date" required
                class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                value="{{ old('event_date') }}" />
            @error('event_date')
                <p class="text-red-600 text-xs font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="event_start" class="block text-sm font-medium text-gray-700 mb-1">Start</label>
            <input type="time" name="event_start" id="event_start" required
                class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                value="{{ old('event_start') }}" />
            @error('event_start')
                <p class="text-red-600 text-xs font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="event_end" class="block text-sm font-medium text-gray-700 mb-1">End</label>
            <input type="time" name="event_end" id="event_end" required
                class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                value="{{ old('event_end') }}" />
            @error('event_end')
                <p class="text-red-600 text-xs font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
            <textarea name="location" id="location" rows="3" required
                class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">{{ old('location') }}</textarea>
            @error('location')
                <p class="text-red-600 text-xs font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex space-x-4">
            <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                <i class="fas fa-plus mr-2"></i> Add Event
            </button>
            <a href="{{ route('event.index') }}"
                class="inline-flex items-center px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                <i class="fas fa-backward mr-2"></i> Back
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
