@extends('adminlte::page')

@section('title', 'Add Event')

@section('content_header')
    <h1>Add Event</h1>
@stop

@section('content')
    <form action="{{ route('event.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="" class="form-label">Name</label>
            <input
                type="text" name="name" id="" class="form-control" placeholder="" aria-describedby="helpId"
            />
            <label for="" class="form-label">Date</label>
            <input
                type="date" name="event_date" id="" class="form-control" placeholder="" aria-describedby="helpId"
            />
            <label for="" class="form-label">Start</label>
            <input
                type="time" name="event_start" id="" class="form-control" placeholder="" aria-describedby="helpId"
            />
            <label for="" class="form-label">End</label>
            <input
                type="time" name="event_end" id="" class="form-control" placeholder="" aria-describedby="helpId"
            />
            <label for="" class="form-label">Location</label>
            <textarea class="form-control" name="location" id="" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Add Event</button>
        <a href="{{ route('event.index') }}" class="btn btn-danger mb-3"><i class="fas fa-backward"></i> Back</a>
    </form>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop