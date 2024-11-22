@extends('layouts.app')

@section('title', 'User Management')

@section('content_header')
    <h1 class="text-2xl dark:text-gray-200 font-semibold mb-6">Users</h1>
@stop

@section('content')
    @if (session('success'))
        <div class="mb-4 p-4 text-green-800 bg-green-100 rounded">{{ session('success') }}</div>
    @elseif (session('danger'))
        <div class="mb-4 p-4 text-red-800 bg-red-100 rounded">{{ session('danger') }}</div>
    @endif

    <div class="relative overflow-x-auto sm:rounded-lg p-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Role
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @php($no = 1)
                @foreach ($user as $item)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4">
                        {{ $no }}
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $item->name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $item->email }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item->role }}
                    </td>
                    <td>
                        <button class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 changeRole" data-id="{{ $item->id }}">Change Role</button>
                    </td>
                </tr>
                @php($no++)
                @endforeach
            </tbody>
        </table>
    </div>



    <!-- Change Role Modal -->
    <div class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 dark:bg-opacity-60" id="userModal" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="relative w-full max-w-lg bg-white rounded-lg shadow-lg dark:bg-gray-800">
            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                <h5 class="text-lg font-semibold text-gray-900 dark:text-gray-200" id="userModalLabel">Change Role</h5>
                <button type="button" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 close-modal" aria-label="Close">&times;</button>
            </div>
            <div class="p-4">
                <form id="userForm" class="space-y-4">
                    @csrf
                    <input type="hidden" name="_method" id="method" value="POST">
                    <input type="hidden" name="id" id="id_user">
                    <input type="hidden" name="name" id="username">
                    <input type="hidden" name="email" id="email">
    
                    <div class="space-y-2">
                        <label for="name" class="text-sm font-medium text-gray-700 dark:text-gray-300">User Name</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded bg-white text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" id="name" disabled>
                        
                        <label for="role" class="text-sm font-medium text-gray-700 dark:text-gray-300">Role</label>
                        <select type="text" class="w-full px-3 py-2 border border-gray-300 rounded bg-white text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" name="role" id="role" required>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 mt-3 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 dark:bg-blue-600 dark:hover:bg-blue-500">Save</button>
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



