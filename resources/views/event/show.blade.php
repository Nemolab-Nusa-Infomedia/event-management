@extends('layouts.user')

@section('title', 'Peserta (Nama Event)')

@section('content_header')
    <h1 class="text-2xl font-bold dark:text-gray-200 text-gray-700 mb-4">Event Participant: {{ $event->name }}</h1>
@stop

@section('content')
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Participant Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Presence
                    </th>
                    @if (Auth::user()->role == 'user')
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @php($no = 1)
                @foreach ($participants as $data)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4">
                            {{ $no }}
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $data['user']->name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $data['user']->email }}
                        </td>
                        @if ($data['status'] == 'Present')
                            <td class="py-2 px-4">
                                <span
                                    class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">Present</span>
                            </td>
                        @else
                            <td class="py-2 px-4">
                                <span
                                    class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs font-semibold">Absent</span>
                            </td>
                        @endif
                        @if (Auth::user()->role == 'user')
                            <td class="px-6 py-4">
                                {{-- In your view file, change this: --}}
                                <form action="{{ route('eventParticipan.destroy', $data->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded inline-flex items-center"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus event ini?')">
                                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                            viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                                d="m6 6 12 12m3-6a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg> Kick
                                    </button>
                                </form>
                            </td>
                        @endif
                    </tr>
                    @php($no++)
                @endforeach
            </tbody>
        </table>
    </div>

    <a href="{{ route('event.index') }}"
        class="inline-flex items-center mt-4 px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
        <svg class="w-[24px] h-[24px] text-gray-800 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path
                d="M14.502 7.046h-2.5v-.928a2.122 2.122 0 0 0-1.199-1.954 1.827 1.827 0 0 0-1.984.311L3.71 8.965a2.2 2.2 0 0 0 0 3.24L8.82 16.7a1.829 1.829 0 0 0 1.985.31 2.121 2.121 0 0 0 1.199-1.959v-.928h1a2.025 2.025 0 0 1 1.999 2.047V19a1 1 0 0 0 1.275.961 6.59 6.59 0 0 0 4.662-7.22 6.593 6.593 0 0 0-6.437-5.695Z" />
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
