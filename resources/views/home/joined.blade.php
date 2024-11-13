@extends('layouts.user')

@section('title', 'home')    

@section('content')

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
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
                    Presence
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
                    <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option @if ($item->eventParticipants->status == 'Present') selected @endif value="Present">Present</option>
                        <option @if ($item->eventParticipants->status == 'Absent') selected @endif value="Absent">Absent</option>
                        {{ $item->status }}
                      </select>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@stop