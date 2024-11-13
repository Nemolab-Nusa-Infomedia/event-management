@extends('layouts.admin')

@section('title', 'Event Management')

@section('content_header')
    <h1 class="text-2xl font-semibold mb-6">Event Management</h1>
@stop

@section('content')
    
<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Event Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Date
                </th>
                <th scope="col" class="px-6 py-3">
                    Start
                </th>
                <th scope="col" class="px-6 py-3">
                    End
                </th>
                <th scope="col" class="px-6 py-3">
                    Location
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($event as $item)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $item->name }}
                </th>
                <td class="px-6 py-4">
                    {{ $item->event_date }}
                </td>
                <td class="px-6 py-4">
                    {{ $item->event_start }}
                </td>
                <td class="px-6 py-4">
                    {{ $item->event_end }}
                </td>
                <td class="px-6 py-4">
                    {{ $item->location }}
                </td>
            </tr>
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
