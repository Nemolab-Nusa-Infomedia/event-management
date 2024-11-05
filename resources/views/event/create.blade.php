@extends('adminlte::page')

@section('title', 'Add Event')

@section('content_header')
    <h1>Add Event</h1>
@stop

@section('content')
    <div class="mb-3">
        <label for="" class="form-label">Name</label>
        <input
            type="text"
            name=""
            id=""
            class="form-control"
            placeholder=""
            aria-describedby="helpId"
        />
        <small id="helpId" class="text-muted">Help text</small>
    </div>
    
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop