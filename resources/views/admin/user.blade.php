@extends('layouts.admin')

@section('title', 'User Management')

@section('content_header')
    <h1 class="text-2xl font-semibold mb-6">Users</h1>
@stop

@section('content')
    @if (session('success'))
        <div class="mb-4 p-4 text-green-800 bg-green-100 rounded">{{ session('success') }}</div>
    @elseif (session('danger'))
        <div class="mb-4 p-4 text-red-800 bg-red-100 rounded">{{ session('danger') }}</div>
    @endif

    <div class="overflow-x-auto">
        <table id="userTable" class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">No</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Name</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Role</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php($no = 1)
                @foreach ($user as $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $no }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $item->name }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $item->role }}</td>
                        <td class="px-4 py-2">
                            <button class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 changeRole" data-id="{{ $item->id }}">Change Role</button>
                        </td>
                    </tr>
                    @php($no++)
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Change Role Modal -->
    <div class="fixed inset-0 bg-black hidden bg-opacity-50 flex items-center justify-center z-50" id="userModal" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="relative w-full max-w-lg bg-white rounded-lg shadow-lg">
            <div class="px-4 py-3 border-b">
                <h5 class="text-lg font-semibold" id="userModalLabel">Change Role</h5>
                <button type="button" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 close-modal" aria-label="Close">&times;</button>
            </div>
            <div class="p-4">
                <form id="userForm" class="space-y-4">
                    @csrf
                    <input type="hidden" name="_method" id="method" value="POST">
                    <input type="hidden" name="id" id="id_user">
                    <input type="hidden" name="name" id="username">
                    <input type="hidden" name="email" id="email">
    
                    <div class="space-y-2">
                        <label for="name" class="text-sm font-medium text-gray-700">User Name</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded" id="name" disabled>
                        
                        <label for="role" class="text-sm font-medium text-gray-700">Role</label>
                        <select type="text" class="w-full px-3 py-2 border border-gray-300 rounded" name="role" id="role" required>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 mt-3 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

    <script>
        $(document).ready(function() { 
            $('.changeRole').on('click', function() {
                const id = $(this).data('id');
                $('#method').val('PUT');
                $('#userForm')[0].reset();
                $('#userModal').removeClass('hidden');
                // $('#userModal').addClass('block');
                $.getJSON("{{route('user.index')}}/" + id, function(data) {
                    $('#username').val(data.name);
                    $('#name').val(data.name);
                    $('#role').val(data.role);
                    $('#id_user').val(data.id);
                    $('#email').val(data.email);
                });
            });
    
            $('.close-modal').click(function() {
                $('#userModal').addClass('hidden');
            });
    
            $('#userForm').on('submit', function(e) {
                e.preventDefault();
                const id = $('#id_user').val();
                const url = "{{route('user.update', '')}}/" + id;
                
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

@section('css')
    {{-- Add here extra stylesheets --}}
@stop



