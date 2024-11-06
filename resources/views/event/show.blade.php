@extends('adminlte::page')

@section('title', 'Peserta (Nama Event)')

@section('content_header')
    <h1>Peserta 'Nama Event'</h1>
@stop

@section('content')
    <table id="participantTable" class="table table-bordered">
        <thead>
            <th>No</th>
            <th>Participant Name</th>
            <th>Email</th>
            <th>Presence</th>
        </thead>
        <tbody>
            @php($no = 1)
            @foreach($participants as $item)
            <tr>
                <td>{{$no}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->email}}</td>
                <td>Hadir <i class="fas fa-check-circle"></i></td>
            </tr>
            @php($no++)
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('event.index') }}" class="btn btn-danger mb-3"><i class="fas "><i class="fas fa-backward"></i> Back</a>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop