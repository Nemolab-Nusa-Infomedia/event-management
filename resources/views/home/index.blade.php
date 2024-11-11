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
                                <span class="info-box-number">10</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning"><i class="fas fa-clock"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Event Aktif</span>
                                <span class="info-box-number">5</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-danger"><i class="fas fa-chart-pie"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Event Selesai</span>
                                <span class="info-box-number">5</span>
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
                                        <tr>
                                            <td>Workshop Programming</td>
                                            <td>2024-03-15</td>
                                            <td><span class="badge badge-success">Aktif</span></td>
                                        </tr>
                                        <tr>
                                            <td>Seminar Digital Marketing</td>
                                            <td>2024-03-20</td>
                                            <td><span class="badge badge-warning">Pendaftaran</span></td>
                                        </tr>
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
<script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
