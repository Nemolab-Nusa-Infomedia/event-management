@extends('layouts.user')

@section('title', 'Event Participants')

@section('content_header')
    <h1 class="text-2xl font-semibold text-gray-800">Event Participants</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            {{ session('success') }}
            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.remove();">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="bg-white shadow-md rounded my-6">
        <div class="p-4">
            <table id="participants-table" class="min-w-full leading-normal border border-gray-200">
                <thead>
                    <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                        <th class="px-4 py-2 border-b">No</th>
                        <th class="px-4 py-2 border-b">Name</th>
                        <th class="px-4 py-2 border-b">Event</th>
                        <th class="px-4 py-2 border-b">Status</th>
                        <th class="px-4 py-2 border-b">Registration Date</th>
                        <th class="px-4 py-2 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach($participants as $index => $participant)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $participant->user->name }}</td>
                            <td class="px-4 py-2">{{ $participant->event->title }}</td>
                            <td class="px-4 py-2">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $participant->status === 'confirm' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($participant->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-2">{{ $participant->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-2 space-x-2">
                                <button 
                                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded text-sm"
                                    onclick="openStatusModal('{{ $participant->id }}')"
                                >
                                    Update Status
                                </button>
                                <form action="{{ route('admin.event-participants.destroy', $participant) }}" 
                                      method="POST" 
                                      class="inline"
                                      onsubmit="return confirm('Are you sure you want to remove this participant?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded text-sm">
                                        Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Status Update Modal -->
    <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="statusModal" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="flex items-center justify-center min-h-screen px-4 text-center">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                <form id="updateStatusForm" method="POST" class="p-6">
                    @csrf
                    @method('PUT')
                    <div class="flex justify-between items-center pb-4 border-b border-gray-200">
                        <h5 class="text-lg font-medium text-gray-900" id="statusModalLabel">Update Participant Status</h5>
                        <button type="button" class="text-gray-400 hover:text-gray-600" onclick="document.getElementById('statusModal').classList.add('hidden')">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="my-4">
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="pending">Pending</option>
                            <option value="confirm">Confirm</option>
                        </select>
                    </div>
                    <div class="mt-4 flex justify-end">
                        <button type="button" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded mr-2" onclick="document.getElementById('statusModal').classList.add('hidden')">Cancel</button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <a href="{{ url()->previous() }}" class="inline-flex items-center bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded mt-4">
        <i class="fas fa-backward mr-2"></i> Back
    </a>
@stop

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#participants-table').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true
            });
        });

        function openStatusModal(participantId) {
            const form = document.getElementById('updateStatusForm');
            form.action = `/admin/event-participants/${participantId}`;
            document.getElementById('statusModal').classList.remove('hidden');
        }
    </script>
@stop