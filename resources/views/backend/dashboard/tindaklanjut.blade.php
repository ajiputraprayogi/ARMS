@extends('layouts.base')
@section('title')
ARMS | Dashboard
@endsection
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection
@section('content')
<div class="col-lg-12">
    <div class="card card-transparent card-block card-stretch card-height border-none">
        <div class="card-header p-0 mt-lg-2 mt-0">
            <h3 class="mb-3">Dashboard Pemantauan Tindak Pengendalian</h3>
            <form method="get">
                <div class="row">
                    <div class="col-md-4">
                        <label class="m-0">Departemen</label>
                        <div class="input-group mb-3">
                            <select class="form-control" name="departemen" id="departemen">
                                <option value="semua">Semua Departemen</option>
                                @foreach($data_departemen as $row_departemen)
                                <option value="{{$row_departemen->id}}" @if(request()->get('departemen'))
                                    @if(request()->get('departemen')==$row_departemen->id) selected @endif
                                    @endif>{{$row_departemen->nama}}</option>
                                @endforeach
                            </select>
                            <div class="input-group-prepend" style="border-radius:10p;">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                <a href="{{url('/dashboard-tindak-lanjut')}}" class="btn btn-primary"
                                    style="border-top-right-radius: 10px;border-bottom-right-radius: 10px;"><i
                                        class="fas fa-sync"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <hr>
        <div class="card-body p-0 mt-lg-2 mt-0">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="card-title">Persebaran Penyebab</h4>
                </div>
                <div class="col-md-2">
                    <div class="card bg-danger">
                        <div class="card-body text-center">
                            <h3>{{$pengendalian_risiko}}</h3>
                            <p class="mb-2">Terjadwal</p>
                        </div>
                    </div>
                    <div class="card bg-success">
                        <div class="card-body text-center">
                            <h3>{{$pengendalian_risiko_terealisasi}}</h3>
                            <p class="mb-2">Terealisasi</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Statistik RTP dan Pelaksanaannya</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h5 class="card-title">Terjadwal Tahun Ini</h5>
                                                        </div>
                                                        <div class="col-md-12 text-right">
                                                            <h3>{{$pengendalian_risiko_tahun_ini}}</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h5 class="card-title">Terjadwal Triwulan Ini</h5>
                                                        </div>
                                                        <div class="col-md-12 text-right">
                                                            <h3>{{$pengendalian_risiko_triwulan_ini}}</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h5 class="card-title">Terealisasi</h5>
                                                        </div>
                                                        <div class="col-md-12 text-right">
                                                            <h3>{{$pengendalian_risiko_terealisasi}}</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h5 class="card-title">Terlambat</h5>
                                                        </div>
                                                        <div class="col-md-12 text-right">
                                                            <h3>{{$pengendalian_risiko_terlambat}}</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Persebaran Status Tindak Pengendalian</h4>
                                </div>
                                <div class="card-body">
                                    <canvas id="myChart_realisasi_pengendalian" width="400" height="500"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@php
$value_terlambat=0;
$value_belum_dilaksanakan=0;
$value_dalam_proses_pelaksanaan =0;
$value_selesai_dilaksanakan=0;
$value_belum_terealisasi=0;
@endphp
@foreach($realisasi_pengendalian as $row_realisasi_pengendalian)
@php
if($row_realisasi_pengendalian->status_pelaksanaan=='Belum Dilaksanakan'){
$value_belum_dilaksanakan=$row_realisasi_pengendalian->total;
}elseif($row_realisasi_pengendalian->status_pelaksanaan=='Dalam Proses Pelaksanaan'){
$value_dalam_proses_pelaksanaan=$row_realisasi_pengendalian->total;
}elseif($row_realisasi_pengendalian->status_pelaksanaan=='Selesai Dilaksanakan'){
$value_selesai_dilaksanakan=$row_realisasi_pengendalian->total;
}elseif($row_realisasi_pengendalian->status_pelaksanaan=='Belum Terealisasi'){
$value_belum_terealisasi=$row_realisasi_pengendalian->total;
}elseif($row_realisasi_pengendalian->status_pelaksanaan=='Terlambat'){
$value_terlambat=$row_realisasi_pengendalian->total;
}
@endphp
@endforeach

@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.js"></script>
<script>
$(function() {
    //=============================================================================================================
    var ctx_realisasi_pengendalian = document.getElementById('myChart_realisasi_pengendalian').getContext('2d');
    var myChart = new Chart(ctx_realisasi_pengendalian, {
        type: 'bar',
        data: {
            labels: ['Terlambat','Belum Dilaksanakan', 'Dalam Proses Pelaksanaan', 'Selesai Dilaksanakan', 'Belum Rerealisasi'
            ],
            datasets: [{
                label: '',
                data: [{{$value_terlambat}},{{$value_belum_dilaksanakan}},{{$value_dalam_proses_pelaksanaan}},{{$value_selesai_dilaksanakan}}, {{$value_belum_terealisasi}}],
                backgroundColor: [
                    'black',
                    '#dc3545',
                    '#ffc107',
                    '#17a2b8',
                    '#28a745'
                ],
                borderColor: [
                    'black',
                    '#dc3545',
                    '#ffc107',
                    '#17a2b8',
                    '#28a745'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>
@endpush