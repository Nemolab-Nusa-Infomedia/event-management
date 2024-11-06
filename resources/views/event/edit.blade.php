@extends('adminlte::page')

@section('title', 'Edit Event')

@section('content_header')
<h1>Edit Event</h1>
@stop

@section('content')
<form id="dataForm" action="{{Route('event.update',$event->id)}}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3 ">
        <label for="" class="form-label">Name</label>
        <input
            type="text" name="name" id="" class="form-control" placeholder="" aria-describedby="helpId" value="{{$event->name}}" />
        <label for="" class="form-label">Date</label>
        <input
            type="date" name="event_date" id="" class="form-control" placeholder="" aria-describedby="helpId" value="{{ $event->event_date }}" />
        <label for="" class="form-label">Start</label>
        <input
            type="time" name="event_start" id="" class="form-control" placeholder="" aria-describedby="helpId" value="{{ $event->event_start }}" />
        <label for="" class="form-label">End</label>
        <input
            type="time" name="event_end" id="" class="form-control" placeholder="" aria-describedby="helpId" value="{{ $event->event_end }}" />
        <label for="" class="form-label">Location</label>
        <textarea class="form-control" name="location" id="" rows="3">{{ $event->location }}</textarea>
    </div>
    <button type="submit" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Save</button>
    <a href="{{ route('event.index') }}" class="btn btn-danger mb-3"><i class="fas "><i class="fas fa-backward"></i> Back</a>
</form>
@stop

@section('css')
{{-- Add here extra stylesheets --}}
{{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<script>

</script>
@stop