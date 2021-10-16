@extends('layouts.base')
@section('title')
ARMS | Dashboard
@endsection
@section('content')
<div class="col-lg-12">
    <div class="card card-transparent card-block card-stretch card-height border-none">
        <div class="card-header p-0 mt-lg-2 mt-0">
            <h3 class="mb-3">Dasbor Pengawasan</h3>
            <div class="row">
                <div class="col-md-3">
                    <label for="">Departemen</label>
                    <div class="form-group">
                        <select class="form-control" name="client" id="">
                            <option selected disabled value="">Pilih Departemen</option>
                            <option value="">...</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-9">
                    <label for="">Tanggal</label>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="date" class="form-control" id="dob" name="tanggal1" />
                            </div>
                        </div>
                        <label class="control-label align-self-center" for="">s/d</label>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="date" class="form-control" id="dob" name="tanggal2" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="">
                                <button type="submit" class="btn btn-primary">Reset Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="card-body p-0 mt-lg-2 mt-0">
            <h5>Identifikasi Risiko</h5>
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-4 card-total-sale">
                                <div>
                                    <p class="mb-2">Populasi Risiko</p>
                                    <h3>{{$populasi_risiko}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-4 card-total-sale">
                                <div>
                                    <p class="mb-2">Usulan Risiko Baru</p>
                                    <h3>{{$usulan_risiko_baru}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h5>Analisis Risiko</h5>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">
                        <h4 class="card-title">Risiko Dengan Kontrol</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart_pie" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Sebaran Besaran Risiko</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h5>Kegiatan Pengendalian</h5>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Realisasi Pengendalian</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart_realisasi_pengendalian" width="400" height="500"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">
                        <h4 class="card-title">Presentase Penurunan Besaran Risiko</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart_penurunan_risiko" width="400" height="200"></canvas>
                    </div>
                </div>
                <div class="card card-block card-stretch">
                    <div class="card-body">
                        <div class="d-flex align-items-center card-total-sale">
                            <div>
                                <p class="mb-2">Rencana Pengendaalian</p>
                                <h3>{{$rencana_pengendalian}}</h3>
                                <span>Tindakan</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-block card-stretch">
                    <div class="card-body">
                        <div class="d-flex align-items-center card-total-sale">
                            <div>
                                <p class="mb-2">Peristiwa Risiko</p>
                                <h3>{{$pencatatan_peristiwa_resiko}}</h3>
                                <span>Peristiwa</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@php
$label_populasi_risiko = '';
$data_populasi_risiko = '';
$warna_populasi_risiko = '';
@endphp

@foreach($sebaran_risiko as $row_sebaran_risiko)
@php
$label_populasi_risiko = $label_populasi_risiko.",'".$row_sebaran_risiko->level."'";
$data_populasi_risiko = $data_populasi_risiko.",".$row_sebaran_risiko->total;
$warna_populasi_risiko = $warna_populasi_risiko.",'".$row_sebaran_risiko->kode_warna."'";
@endphp
@endforeach

@php
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
}
@endphp
@endforeach

@php
$value_penurunanrisiko_memenuhi=0;
$value_penurunanrisiko_tidak_memenuhi=0;
@endphp
@foreach($penurunan_besaran_risiko as $penurunanrisiko)
    @php
    if($penurunanrisiko->besaran_akhir>$penurunanrisiko->selera_risiko){
        $value_penurunanrisiko_tidak_memenuhi++;
    }else{
        $value_penurunanrisiko_memenuhi++;
    }
    @endphp
@endforeach
@endsection
@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.js"></script>
<script>
//=============================================================================================================
var ctx_pie = document.getElementById('myChart_pie').getContext('2d');
var myChart_pie = new Chart(ctx_pie, {
    type: 'pie',
    data: {
        labels: ['Tidak Terkontrol', 'Terkontrol'],
        datasets: [{
            data: [{{count($risiko_tidak_terkendali)}}, {{count($risiko_terkendali)}}],
            backgroundColor: [
                '#dc3545',
                '#28a745',
            ],
            borderColor: [
                '#dc3545',
                '#28a745',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

//=============================================================================================================
var ctx_pie = document.getElementById('myChart_penurunan_risiko').getContext('2d');
var myChart_pie = new Chart(ctx_pie, {
    type: 'pie',
    data: {
        labels: ['Belum Memenuhi', 'Memenuhi'],
        datasets: [{
            data: [{{$value_penurunanrisiko_tidak_memenuhi}}, {{$value_penurunanrisiko_memenuhi}}],
            backgroundColor: [
                '#dc3545',
                '#28a745',
            ],
            borderColor: [
                '#dc3545',
                '#28a745',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

//=============================================================================================================
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [{!!substr($label_populasi_risiko, 1)!!}],
        datasets: [{
            label: '',
            data: [{!!substr($data_populasi_risiko, 1) !!}],
            backgroundColor: [{!!substr($warna_populasi_risiko, 1)!!}],
            borderColor: [{!!substr($warna_populasi_risiko, 1)!!}],
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

//=============================================================================================================
var ctx_realisasi_pengendalian = document.getElementById('myChart_realisasi_pengendalian').getContext('2d');
var myChart = new Chart(ctx_realisasi_pengendalian, {
    type: 'bar',
    data: {
        labels: ['Belum Dilaksanakan', 'Dalam Proses Pelaksanaan', 'Selesai Dilaksanakan', 'Belum Rerealisasi'],
        datasets: [{
            label: '',
            data: [{{$value_belum_dilaksanakan}},{{$value_dalam_proses_pelaksanaan}},{{$value_selesai_dilaksanakan}},{{$value_belum_terealisasi}}],
            backgroundColor: [
                '#dc3545',
                '#ffc107',
                '#17a2b8',
                '#28a745'
            ],
            borderColor: [
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
</script>
@endpush