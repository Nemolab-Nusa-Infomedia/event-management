@extends('adminlte::page')

@section('title', 'User Management')

@section('content_header')
<h1>Users</h1>
@stop

@section('content')
@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table id="userTable" class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @php($no = 1)
        @foreach ($user as $item)
        <tr>
            <td>{{ $no}}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->role }}</td>
            <td>
                <button class="btn btn-primary changeRole" data-id="{{ $item->id}}">Change Role</button>
                <!-- <form action="{{ route('user.destroy', $item->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form> -->
            </td>
        </tr>
        @php($no++)
        @endforeach
    </tbody>
</table>

<!-- Create/Edit Modal -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Add Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="userForm">
                    @csrf
                    <input type="hidden" name="_method" id="method" value="POST">
                    <input type="hidden" name="id" id="id_user">

                    <div class="form-group">
                        <label for="nama">Nama User</label>
                        <input type="text" class="form-control" name="nama" id="nama_user" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    $(document).ready(function() {
        $('#userTable').DataTable();

        $('#createUser').click(function() {
            $('#userForm')[0].reset();
            $('#method').val('POST');
            $('#userModalLabel').text('Add User');
            $('#userModal').modal('show');
        });

        $('.edituser').click(function() {
            const id = $(this).data('id');
            $.get("{{ route('user.index') }}/" + id + "/edit", function(data) {
                $('#id_user').val(data.id);
                $('#nama_user').val(data.nama);
                $('#method').val('PUT');
                $('#userModalLabel').text('Edit User');
                $('#userModal').modal('show');
            });
        });

        $('#userForm').on('submit', function(e) {
            e.preventDefault();
            const method = $('#method').val();
            const id = $('#id_user').val();
            const url = method === 'POST' ?
                "{{ route('user.store') }}" :
                "{{ route('user.update', '') }}/" + id;
            $.ajax({
                type: 'POST',
                url: url,
                data: $(this).serialize(),
                success: function(response) {
                    location.reload();
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script>
@stop