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
                    <select 
                        data-event-id="{{ $item->id }}"
                        class="status-select bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    >
                        <option value="Present" {{ $item->eventParticipants[0]->status == 'Present' ? 'selected' : '' }}>Present</option>
                        <option value="Absent" {{ $item->eventParticipants[0]->status == 'Absent' ? 'selected' : '' }}>Absent</option>
                    </select>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
document.querySelectorAll('.status-select').forEach(select => {
    select.addEventListener('change', function() {
        const eventId = this.dataset.eventId;
        const status = this.value;
        
        fetch(`/update-status/${eventId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ status: status })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                alert('Status updated successfully');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to update status');
        });
    });
});
</script>

@stop