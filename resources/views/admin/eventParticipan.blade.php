@extends('adminlte::page')

@section('title', 'Event Participants')

@section('content_header')
<h1>Event Participants</h1>
@stop

@section('content')

<table id="eventTable" class="table table-bordered">
    <thead>
        <tr>
            <td>No</td>
            <td>Name</td>
            <td>Event</td>
            <td>Status</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>
        @php ($no = 1)
        @foreach ( $participants as $index => $participant )
        <tr>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                {{ $index + 1 }}
            </td>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                {{ $participant->user->name }}
            </td>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                {{ $participant->event->title }}
            </td>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $participant->status === 'confirm' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                    {{ ucfirst($participant->status) }}
                </span>
            </td>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                {{ $participant->created_at->format('d/m/Y H:i') }}
            </td>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 font-medium">
                <div class="flex space-x-2">
                    <button onclick="openStatusModal('{{ $participant->id }}')" class="text-indigo-600 hover:text-indigo-900">
                        Ubah Status
                    </button>
                    <form action="{{ route('eventParticipan.destroy', $participant->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus peserta ini?')">
                            Hapus
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @php($no++)
        @endforeach
    </tbody>
</table>
<div id="statusModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div class="relative bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
            <form id="updateStatusForm" method="POST">
                @csrf
                @method('PUT')
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg font-medium text-gray-900">Ubah Status Kehadiran</h3>
                    <div class="mt-4">
                        <select name="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option value="pending">Pending</option>
                            <option value="confirm">Confirm</option>
                        </select>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" class="btn btn-info">
                        Simpan
                    </button>
                    <button type="button" onclick="closeStatusModal()" class="btn btn-danger">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<button type="button" class="btn btn-warning"><i class="fas fa-backward"></i> Back</button>
@stop

@section('css')
{{-- Add here extra stylesheets --}}
{{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<script>
    console.log("Hi, I'm using the Laravel-AdminLTE package!");

    function openStatusModal(participantId) {
        const modal = document.getElementById('statusModal');
        const form = document.getElementById('updateStatusForm');
        form.action = `/admin/eventParticipan/${participantId}`;
        modal.classList.remove('hidden');
    }

    function closeStatusModal() {
        const modal = document.getElementById('statusModal');
        modal.classList.add('hidden');
    }
</script>
@stop