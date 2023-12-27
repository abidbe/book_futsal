@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
    <div class="content">
        <div class="main-content container-fluid">
            <div class="page-title mb-3 ">
                <h3>Data Lapangan</h3>
            </div>
            <section class="section">
                <div class="row mb-2">
                    <div class="col-12 col-md-3">
                        <div class="card card-statistic">
                            <div class="card-body p-0">
                                <div class="d-flex flex-column">
                                    <div class='px-3 py-3 d-flex justify-content-between'>
                                        <h3 class='card-title'>PELANGGAN</h3>
                                        <div class="card-right d-flex align-items-center">
                                            <p>{{$users}}</p>
                                        </div>
                                    </div>
                                    <div class="chart-wrapper">
                                        <canvas id="canvas1" style="height:100px !important"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="card card-statistic">
                            <div class="card-body p-0">
                                <div class="d-flex flex-column">
                                    <div class='px-3 py-3 d-flex justify-content-between'>
                                        <h3 class='card-title'>BOOKING SUKSES</h3>
                                        <div class="card-right d-flex align-items-center">
                                            <p>{{$bookingsukses}}</p>
                                        </div>
                                    </div>
                                    <div class="chart-wrapper">
                                        <canvas id="canvas2" style="height:100px !important"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="card card-statistic">
                            <div class="card-body p-0">
                                <div class="d-flex flex-column">
                                    <div class='px-3 py-3 d-flex justify-content-between'>
                                        <h3 class='card-title'>BOOKING PENDING</h3>
                                        <div class="card-right d-flex align-items-center">
                                            <p>{{$bookingpending}}</p>
                                        </div>
                                    </div>
                                    <div class="chart-wrapper">
                                        <canvas id="canvas3" style="height:100px !important"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="card card-statistic">
                            <div class="card-body p-0">
                                <div class="d-flex flex-column">
                                    <div class='px-3 py-3 d-flex justify-content-between'>
                                        <h3 class='card-title'>saldo</h3>
                                        <div class="card-right d-flex align-items-center">
                                            <p>Rp {{ number_format($bookingtotal, 2, ',', '.') }}</p>
                                        </div>
                                    </div>
                                    <div class="chart-wrapper">
                                        <canvas id="canvas4" style="height:100px !important"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="card shadow mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="text-primary fw-bold m-0 p-2">Pemasukan</h6>
                                
                            </div>
                            <div class="card-body">
                                <div class="p-6 m-20 bg-white rounded shadow">
                                    {!! $chart->container() !!}
                                </div>
                            </div>
                        </div>
                </div>
            </section>
        </div>
        
    </div>
    <script src="{{ $chart->cdn() }}"></script>

    {{ $chart->script() }}
@endsection
