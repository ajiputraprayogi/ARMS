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
                                    <h3>40</h3>
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
                                    <h3>5</h3>
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
                        <h4 class="card-title">Card title</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@php
$risiko_terkendali = DB::table('resiko_teridentifikasi')
->select(DB::raw('count(pengendalian_risiko.id) as jumlah_pengendalian'))
->leftjoin('pengendalian_risiko','pengendalian_risiko.id_risiko','=','resiko_teridentifikasi.id')
->having('jumlah_pengendalian', '>' , 0)
->groupby('resiko_teridentifikasi.id')
->get();

$risiko_tidak_terkendali = DB::table('resiko_teridentifikasi')
->select(DB::raw('count(pengendalian_risiko.id) as jumlah_pengendalian'))
->leftjoin('pengendalian_risiko','pengendalian_risiko.id_risiko','=','resiko_teridentifikasi.id')
->having('jumlah_pengendalian', '=' , 0)
->groupby('resiko_teridentifikasi.id')
->get();
@endphp

@endsection
@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.js"></script>
<script>
var ctx_pie = document.getElementById('myChart_pie').getContext('2d');
var myChart_pie = new Chart(ctx_pie, {
    type: 'pie',
    data: {
        labels: ['Tidak Terkontrol','Terkontrol'],
        datasets: [{
            data: [{{count($risiko_tidak_terkendali)}}, {{count($risiko_terkendali)}}],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(153, 102, 255, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
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
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
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
</script>
@endpush