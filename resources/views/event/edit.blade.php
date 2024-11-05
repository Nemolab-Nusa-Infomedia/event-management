@extends('adminlte::page')

@section('title', 'Edit Event')

@section('content_header')
<h1>Edit Event</h1>
@stop

@section('content')
<form id="dataForm">
    <div class="mb-3 ">
        <label for="" class="form-label">Name</label>
        <input
            type="text" name="" id="" class="form-control" placeholder="" aria-describedby="helpId" />
        <label for="" class="form-label">Date</label>
        <input
            type="date" name="" id="" class="form-control" placeholder="" aria-describedby="helpId" />
        <label for="" class="form-label">Start</label>
        <input
            type="time" name="" id="" class="form-control" placeholder="" aria-describedby="helpId" />
        <label for="" class="form-label">End</label>
        <input
            type="time" name="" id="" class="form-control" placeholder="" aria-describedby="helpId" />
        <label for="" class="form-label">Location</label>
        <textarea class="form-control" name="" id="" rows="3"></textarea>
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
    $(document).ready(function () {
        $('#dataForm').on('submit', function () {
            const url = "{{ route('event.update', $event->id) }}";
            $.ajax({
                type: "PUT",
                url: "url",
                data: $(this).serialize(),
                success: function (response) {
                    
                }
            });
        });
    });
</script>
@stop