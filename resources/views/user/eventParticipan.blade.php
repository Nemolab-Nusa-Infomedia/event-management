@extends('adminlte::page')

@section('title', 'Event Participants')

@section('content_header')
    <h1>Event Participants</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table id="participants-table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Event</th>
                        <th>Status</th>
                        <th>Registration Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($participants as $index => $participant)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $participant->user->name }}</td>
                            <td>{{ $participant->event->title }}</td>
                            <td>
                                <span class="badge badge-{{ $participant->status === 'confirm' ? 'success' : 'warning' }}">
                                    {{ ucfirst($participant->status) }}
                                </span>
                            </td>
                            <td>{{ $participant->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <button 
                                    class="btn btn-sm btn-info"
                                    onclick="openStatusModal('{{ $participant->id }}')"
                                >
                                    Update Status
                                </button>
                                <form action="{{ route('admin.event-participants.destroy', $participant) }}" 
                                      method="POST" 
                                      class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to remove this participant?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
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
    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="updateStatusForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="statusModalLabel">Update Participant Status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="pending">Pending</option>
                                <option value="confirm">Confirm</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <a href="{{ url()->previous() }}" class="btn btn-warning">
        <i class="fas fa-backward"></i> Back
    </a>
@stop

@section('js')
    <script>
        $(document).ready(function() {
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
            $('#statusModal').modal('show');
        }
    </script>
@stop