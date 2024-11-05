@extends('adminlte::page')

@section('title', 'Edit Event')

@section('content_header')
    <h1>Edit Event</h1>
@stop

@section('content')
    <div class="mb-3 ">
        <label for="" class="form-label">Name</label>
        <input
            type="text" name="" id="" class="form-control" placeholder="" aria-describedby="helpId"
        />
        <label for="" class="form-label">Date</label>
        <input
            type="date" name="" id="" class="form-control" placeholder="" aria-describedby="helpId"
        />
        <label for="" class="form-label">Start</label>
        <input
            type="time" name="" id="" class="form-control" placeholder="" aria-describedby="helpId"
        />
        <label for="" class="form-label">End</label>
        <input
            type="time" name="" id="" class="form-control" placeholder="" aria-describedby="helpId"
        />
        <label for="" class="form-label">Location</label>
        <textarea class="form-control" name="" id="" rows="3"></textarea>
    </div>
    <a href="{{ route('event.create') }}" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Add Event</a>
    <a href="{{ route('event.index') }}" class="btn btn-danger mb-3"><i class="fas "><i class="fas fa-backward"></i> Back</a>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop