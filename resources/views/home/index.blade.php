@extends('layouts.user')

@section('title', 'home')

@section('content')
    <!-- Info boxes -->
    <div class="flex flex-wrap -mx-2 mb-4">
        <div class="w-full sm:w-1/2 md:w-1/4 px-2 mb-4">
            <div class="flex items-center bg-blue-500 text-white rounded-lg p-4 shadow-md">
                <svg class="w-[48px] h-[48px] text-gray-800 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M5 5a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1 2 2 0 0 1 2 2v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a2 2 0 0 1 2-2ZM3 19v-7a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm6.01-6a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm-10 4a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z"
                        clip-rule="evenodd" />
                </svg>
                <div class="ml-4">
                    <p class="text-sm font-semibold">Total Event</p>
                    <p class="text-lg font-bold">{{ $totalEvent }}</p>
                </div>
            </div>
        </div>
        <div class="w-full sm:w-1/2 md:w-1/4 px-2 mb-4">
            <div class="flex items-center bg-yellow-500 text-white rounded-lg p-4 shadow-md">
                <svg class="w-[48px] h-[48px] text-gray-800 text-white" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                        clip-rule="evenodd" />
                </svg>
                <div class="ml-4">
                    <p class="text-sm font-semibold">Event Aktif</p>
                    <p class="text-lg font-bold">{{ $eventAktif }}</p>
                </div>
            </div>
        </div>
        <div class="w-full sm:w-1/2 md:w-1/4 px-2 mb-4">
            <div class="flex items-center bg-red-500 text-white rounded-lg p-4 shadow-md">
                <svg class="w-[48px] h-[48px] text-gray-800 text-white" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        d="M13.5 2c-.178 0-.356.013-.492.022l-.074.005a1 1 0 0 0-.934.998V11a1 1 0 0 0 1 1h7.975a1 1 0 0 0 .998-.934l.005-.074A7.04 7.04 0 0 0 22 10.5 8.5 8.5 0 0 0 13.5 2Z" />
                    <path d="M11 6.025a1 1 0 0 0-1.065-.998 8.5 8.5 0 1 0 9.038 9.039A1 1 0 0 0 17.975 13H11V6.025Z" />
                </svg>
                <div class="ml-4">
                    <p class="text-sm font-semibold">Event Selesai</p>
                    <p class="text-lg font-bold">{{ $eventSelesai }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Events & Participants -->
    <div class="flex flex-wrap -mx-2">
        <!-- Recent Events -->
        <div class="w-full px-2">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="bg-gray-100 p-4">
                    <h3 class="text-lg font-semibold text-gray-800">Event Terbaru</h3>
                </div>
                <div class="p-4">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100 text-gray-600 uppercase text-sm text-left">
                                <th class="py-3 px-4 border-b">Nama Event</th>
                                <th class="py-3 px-4 border-b">Tanggal</th>
                                <th class="py-3 px-4 border-b">Status</th>
                                <th class="py-3 px-4 border-b">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @foreach ($event as $item)
                                <tr class="border-b">
                                    <td class="py-3 px-4">{{ $item->name }}</td>
                                    <td class="py-3 px-4">{{ $item->event_date }}</td>
                                    <td class="py-3 px-4">
                                        @if ($item->event_date == now()->toDateString() && $item->event_start <= now() && $item->event_end > now())
                                            <span
                                                class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">Aktif</span>
                                        @elseif (
                                            $item->event_date > now()->toDateString() ||
                                                ($item->event_date == now()->toDateString() && $item->event_start > now()))
                                            <span
                                                class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">Pendaftaran</span>
                                        @else
                                            <span
                                                class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs font-semibold">Selesai</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4">
                                        @php
                                            if (!$item->eventParticipants->isEmpty()):
                                                foreach ($item->eventParticipants as $participant):
                                                    if ($participant->id_user == Auth::id()) {
                                                        $joined = true;
                                                    }
                                                endforeach;
                                            endif;
                                        @endphp
                                        @if ($joined)
                                            You Alerdy Joined
                                        @else
                                            <form action="{{ route('join') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id_user" value="{{ Auth::id() }}">
                                                <input type="hidden" name="id_event" value="{{ $item->id }}">
                                                <button type="submit"
                                                    class="flex items-center px-4 py-1 bg-green-500 text-white rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                                                    <svg class="w-6 h-6 mr-2 text-white" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path d="M14 19V5h4a1 1 0 0 1 1 1v11h1a1 1 0 0 1 0 2h-6Z" />
                                                        <path fill-rule="evenodd"
                                                            d="M12 4.571a1 1 0 0 0-1.275-.961l-5 1.428A1 1 0 0 0 5 6v11H4a1 1 0 0 0 0 2h1.86l4.865 1.39A1 1 0 0 0 12 19.43V4.57ZM10 11a1 1 0 0 1 1 1v.5a1 1 0 0 1-2 0V12a1 1 0 0 1 1-1Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Join
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Your Events -->
    <div class="flex flex-wrap -mx-2">

        <div class="w-full px-2">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="bg-gray-100 p-4">
                    <h3 class="text-lg font-semibold text-gray-800">Event Kamu</h3>
                </div>
                <div class="p-4">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100 text-gray-600 uppercase text-sm text-left">
                                <th class="py-3 px-4 border-b">Nama Event</th>
                                <th class="py-3 px-4 border-b">Tanggal</th>
                                <th class="py-3 px-4 border-b">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @foreach ($yourEvent as $item)
                                <tr class="border-b">
                                    <td class="py-3 px-4">{{ $item->name }}</td>
                                    <td class="py-3 px-4">{{ $item->event_date }}</td>
                                    <td class="py-3 px-4">
                                        @if ($item->event_date == now()->toDateString() && $item->event_start <= now() && $item->event_end > now())
                                            <span
                                                class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">Aktif</span>
                                        @elseif (
                                            $item->event_date > now()->toDateString() ||
                                                ($item->event_date == now()->toDateString() && $item->event_start > now()))
                                            <span
                                                class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">Pendaftaran</span>
                                        @else
                                            <span
                                                class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs font-semibold">Selesai</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
