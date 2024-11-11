@extends('adminlte::page')

@section('title', 'User Management')

@section('content_header')
<h1>Users</h1>
@stop

@section('content')
@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@elseif (session('danger'))
<div class="alert alert-danger">{{ session('danger') }}</div>
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

<!-- Change Role Modal -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Change Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="userForm">
                    @csrf
                    <input type="hidden" name="_method" id="method" value="POST">
                    <input type="hidden" name="id" id="id_user">
                    <input type="hidden" name="name" id="username">
                    <input type="hidden" name="email" id="email">

                    <div class="form-group">
                        <label for="name">User Name</label>
                        <input type="text" class="form-control" id="name" disabled>
                        <label for="role">Role</label>
                        <select type="text" class="form-control" name="role" id="role" required>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
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

        $('.changeRole').click(function() {
            console.log();
            const id = $(this).data('id');
            $('#method').val('PUT');
            $('#userForm')[0].reset();
            $('#userModal').modal('show');

            $.getJSON("{{route('user.index')}}/" + id,
                function(data, textStatus, jqXHR) {
                    console.log(data);
                    $('#username').val(data.name);
                    $('#name').val(data.name);
                    $('#role').val(data.role);
                    $('#id_user').val(data.id);
                    $('#email').val(data.email);
                }
            );

        });
        $('#userForm').on('submit', function(e) {
            e.preventDefault();
            const id = $('#id_user').val();
            const url = "{{route('user.update', '')}}/" + id;
            
            console.log($(this).serialize())
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