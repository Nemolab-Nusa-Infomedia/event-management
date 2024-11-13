@extends('layouts.admin')

@section('title', 'Event Management')

@section('content_header')
    <h1 class="text-2xl font-semibold mb-6">Event Management</h1>
@stop

@section('content')
    <div class="overflow-x-auto">
        <table id="eventTable" class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">No</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Name</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Date</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Start</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">End</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Location</th>
                </tr>
            </thead>
            <tbody>
                @php ($no = 1)
                @foreach ($event as $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $no }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $item->name }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $item->event_date }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $item->event_start }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $item->event_end }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $item->location }}</td>
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
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
