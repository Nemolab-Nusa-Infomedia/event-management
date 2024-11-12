@extends('layouts.user')

@section('title', 'Peserta (Nama Event)')

@section('content_header')
    <h1 class="text-2xl font-semibold mb-4">Peserta event: {{ $event->name }}</h1>
@stop

@section('content')
    <table id="participantTable" class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr class="bg-gray-100 text-gray-600 uppercase text-sm text-left">
                <th class="py-2 px-4 border-b border-gray-300">No</th>
                <th class="py-2 px-4 border-b border-gray-300">Participant Name</th>
                <th class="py-2 px-4 border-b border-gray-300">Email</th>
                <th class="py-2 px-4 border-b border-gray-300">Presence</th>
            </tr>
        </thead>
        <tbody>
            @php($no = 1)
            @foreach($participants as $data)
                <tr class="bg-white even:bg-gray-50">
                    <td class="py-2 px-4 border-b border-gray-300 text-center">{{ $no }}</td>
                    <td class="py-2 px-4 border-b border-gray-300">{{ $data['user']->name }}</td>
                    <td class="py-2 px-4 border-b border-gray-300">{{ $data['user']->email }}</td>
                    <td class="py-2 px-4 border-b border-gray-300 text-green-500">
                        Hadir <i class="fas fa-check-circle"></i>
                    </td>
                </tr>
                @php($no++)
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('event.index') }}" class="inline-flex items-center mt-4 px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
        <svg class="w-[24px] h-[24px] text-gray-800 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path d="M14.502 7.046h-2.5v-.928a2.122 2.122 0 0 0-1.199-1.954 1.827 1.827 0 0 0-1.984.311L3.71 8.965a2.2 2.2 0 0 0 0 3.24L8.82 16.7a1.829 1.829 0 0 0 1.985.31 2.121 2.121 0 0 0 1.199-1.959v-.928h1a2.025 2.025 0 0 1 1.999 2.047V19a1 1 0 0 0 1.275.961 6.59 6.59 0 0 0 4.662-7.22 6.593 6.593 0 0 0-6.437-5.695Z"/>
          </svg> Back
    </a>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
@stop

@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop
