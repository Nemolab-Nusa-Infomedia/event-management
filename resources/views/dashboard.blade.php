@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1></h1>
@stop

@section('content')
    <!-- Info boxes -->
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-calendar-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Event</span>
                    <span class="info-box-number">{{ $totalEvent }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fas fa-user"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total User</span>
                    <span class="info-box-number">{{ $totalUser }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="fas fa-clock"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Event Aktif</span>
                    <span class="info-box-number">{{ $eventAktif }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="fas fa-chart-pie"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Event Selesai</span>
                    <span class="info-box-number">{{ $eventSelesai }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Events & Participants -->
    <div class="row">
        <!-- Recent Events -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Event Terbaru</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Event</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($event as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->event_date }}</td>
                                    <td>
                                        @if ($item->event_date == now()->toDateString() && $item->event_start <= now() && $item->event_end > now())
                                            <span class="badge badge-success">Aktif</span>
                                        @elseif ($item->event_date >= now()->toDateString() && $item->event_start > now())
                                            <span class="badge badge-warning">Pendaftaran</span>
                                        @else
                                            <span class="badge badge-danger">Selesai</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <!-- Required JavaScript -->
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop
