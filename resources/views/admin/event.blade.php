@extends('adminlte::page')

@section('title', 'Event Management')

@section('content_header')
    <h1>Event</h1>
@stop

@section('content')

        <a href="{{ route('event.create') }}" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Add Event</a>
      <table id="eventTable" class="table table-bordered">
        <thead>
            <tr>
                <td>No</td>
                <td>Name</td>
                <td>Date</td>
                <td>Start</td>
                <td>End</td>
                <td>Location</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>
        @php ($no = 1)
            @foreach ( $event as $item )
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->event_date }}</td>
                <td>{{ $item->event_start }}</td>
                <td>{{ $item->event_end }}</td>
                <td>{{ $item->location }}</td>
                <td>
                    <button class="btn btn-primary"><i class="fas fa-pen"></i> Edit</button>
                    <button class="btn btn-secondary"><i class="fas fa-users"></i> See Participants</button>    
                    <form action="{{ route('user.destroy', $item->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
                    </form>
                </td>
            </tr>
            @php($no++)
            @endforeach
        </tbody>
      </table>
      <button class="btn btn-danger"><i class="fas fa-backward"></i> Back</button>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop