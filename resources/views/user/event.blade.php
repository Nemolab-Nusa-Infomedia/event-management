@extends('layouts.user')

@section('title', 'Event Management')

@section('content_header')
    <h1 class="text-2xl font-semibold text-gray-800">Event</h1>
@stop

@section('content')
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @elseif (session('danger'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('danger') }}
        </div>
    @endif
    
    <a href="{{ route('event.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mb-3 inline-flex items-center">
        <i class="fas fa-plus mr-2"></i> Add Event
    </a>

    <div class="overflow-x-auto">
        <table id="eventTable" class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b border-gray-200 text-left">No</th>
                    <th class="px-4 py-2 border-b border-gray-200 text-left">Name</th>
                    <th class="px-4 py-2 border-b border-gray-200 text-left">Date</th>
                    <th class="px-4 py-2 border-b border-gray-200 text-left">Start</th>
                    <th class="px-4 py-2 border-b border-gray-200 text-left">End</th>
                    <th class="px-4 py-2 border-b border-gray-200 text-left">Location</th>
                    <th class="px-4 py-2 border-b border-gray-200 text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                @php ($no = 1)
                @foreach ($event as $item)
                    <tr>
                        <td class="px-4 py-2 border-b border-gray-200">{{ $no }}</td>
                        <td class="px-4 py-2 border-b border-gray-200">{{ $item->name }}</td>
                        <td class="px-4 py-2 border-b border-gray-200">{{ $item->event_date }}</td>
                        <td class="px-4 py-2 border-b border-gray-200">{{ $item->event_start }}</td>
                        <td class="px-4 py-2 border-b border-gray-200">{{ $item->event_end }}</td>
                        <td class="px-4 py-2 border-b border-gray-200">{{ $item->location }}</td>
                        <td class="px-4 py-2 border-b border-gray-200 space-x-2">
                            <a href="{{ route('event.edit', $item->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded inline-flex items-center">
                                <i class="fas fa-pen mr-1"></i> Edit
                            </a>
                            <a href="{{ route('event.show', $item->id) }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-1 px-3 rounded inline-flex items-center">
                                <i class="fas fa-users mr-1"></i> See Participants
                            </a>
                            <form action="{{ route('event.destroy', $item->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded inline-flex items-center" onclick="return confirm('Apakah Anda yakin ingin menghapus event ini?')">
                                    <i class="fas fa-trash mr-1"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @php($no++)
                @endforeach
            </tbody>
        </table>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package with Tailwind CSS!"); </script>
@stop