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
                        Action
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
                            <button data-modal-target="ticket-modal"
                                data-modal-toggle="ticket-modal"
                                data-qr-id="{{ $item->eventParticipants[0]->id }}"
                                class="openTicket block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                type="button">
                                See Ticket
                            </button>
                        </td>
                        <td class="hidden" id="qr-table-{{ $item->eventParticipants[0]->id }}">
                            <div id="qr-{{ $item->eventParticipants[0]->id }}">
                                {{ QrCode::size(256)->generate(route('participan.verification', $item->eventParticipants[0]->id)) }}
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Ticket modal -->
        <div id="ticket-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 bg-black/50 dark:bg-black/0 h-[calc(100%)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <div class="flex flex-col">
                            <h3 class="text-xl font-semibold break-all text-gray-900 dark:text-white">
                                {{ $item->name }}
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $item->event_date }}</p>
                        </div>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="ticket-modal" id="close-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 items-center lg:px-12 lg:py-3 gap-8 p-6">
                        <!-- Bagian Informasi -->
                        <div class="flex flex-col items-center lg:items-start">
                            <div class="text-left w-full px-4 sm:px-0">
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Name:</p>
                                <p class="text-lg text-gray-700 dark:text-gray-300 font-medium mb-4">
                                    {{ Auth::user()->name }}</p>

                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Email:</p>
                                <p class="text-lg text-gray-700 dark:text-gray-300 font-medium mb-4">
                                    {{ Auth::user()->email }}</p>

                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Phone Number:</p>
                                <p class="text-lg text-gray-700 dark:text-gray-300 font-medium mb-4">
                                    {{ Auth::user()->no_telp }}</p>

                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Address:</p>
                                <p class="text-lg text-gray-700 dark:text-gray-300 font-medium">{{ Auth::user()->alamat }}
                                </p>
                            </div>
                        </div>

                        <!-- Bagian QR Code -->
                        <div class="flex items-center w-64 h-64 sm:w-72 sm:h-72 justify-center bg-white rounded-lg"
                            id="qr-container">

                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 md:p-5 rounded-b">
                        <button data-modal-hide="ticket-modal" type="button"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-gray-200 rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Close</button>
                    </div>
                </div>
            </div>
        </div>

    <script>
        let id = null;
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
                        body: JSON.stringify({
                            status: status
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Status updated successfully');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Failed to update status');
                    });
            });
        });

        $(document).ready(function() {
            let qrId = null;
            $('.openTicket').click(function() {
                qrId = $(this).data('qr-id');
                $('#qr-' + qrId).appendTo('#qr-container');
            });
            $('#close-modal').click(function() {
                $('#qr-' + qrId).appendTo('#qr-table-' + qrId);
            });
        });
    </script>

@stop
