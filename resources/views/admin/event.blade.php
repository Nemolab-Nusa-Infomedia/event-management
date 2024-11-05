@extends('adminlte::page')

@section('title', 'Event Management')

@section('content_header')
    <h1>Event</h1>
@stop

@section('content')
        <button class="btn btn-succes"> Add Event</button>
      <table id="eventTable" class="table table-bordered">
        <thead>
            <tr>
                <td>No</td>
                <td>Nama</td>
                <td>Tanggal</td>
                <td>Mulai</td>
                <td>Selesai</td>
                <td>Lokasi</td>
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
                <td></td>
            </tr>
            @php($no++)
            @endforeach
        </tbody>
      </table>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop