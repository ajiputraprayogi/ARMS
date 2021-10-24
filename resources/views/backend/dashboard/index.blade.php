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
            <h3 class="mb-3">Dashboard Pengawasan</h3>
            <form method="get">
                <div class="row">
                    <div class="col-md-4">
                        <label class="m-0">Departemen</label>
                        <div class="input-group mb-3">
                            <select class="form-control" name="departemen" id="departemen">
                                <option value="semua">Semua Departemen</option>
                                @foreach($data_departemen as $row_departemen)
                                <option value="{{$row_departemen->id}}" @if(request()->get('departemen')) @if(request()->get('departemen')==$row_departemen->id) selected @endif @endif>{{$row_departemen->nama}}</option>
                                @endforeach
                            </select>
                            <div class="input-group-prepend" style="border-radius:10p;">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                <a href="{{url('/dashboard')}}" class="btn btn-primary"
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
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Risiko</h4>
                            <div class="row">
                                <div class="col-md-6 text-center">
                                    <h3>{{$populasi_risiko}}</h3>
                                    <p class="mb-2">Teridentifikasi</p>
                                </div>
                                <div class="col-md-6 text-center">
                                    <h3>{{$risiko_termitigasi}}</h3>
                                    <p class="mb-2">Termitigasi</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Penyebab</h4>
                            <div class="row">
                                <div class="col-md-6 text-center">
                                    <h3>{{$penyebab_teridentifikasi}}</h3>
                                    <p class="mb-2">Teridentifikasi</p>
                                </div>
                                <div class="col-md-6 text-center">
                                    <h3>{{$penyebab_termitigasi}}</h3>
                                    <p class="mb-2">Termitigasi</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Rencana Tindak Pengendalian</h4>
                            <div class="row">
                                <div class="col-md-6 text-center">
                                    <h3>{{$pengendalian_risiko}}</h3>
                                    <p class="mb-2">Terjadwal</p>
                                </div>
                                <div class="col-md-6 text-center">
                                    <h3>{{$pengendalian_risiko_termitigasi}}</h3>
                                    <p class="mb-2">Terealisasi</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Peristiwa Risiko</h4>
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <h3>{{$kejadian_peristiwa_risiko}}</h3>
                                    <p class="mb-2">Kejadian</p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <h3>{{count($risiko_peristiwa_risiko)}}</h3>
                                    <p class="mb-2">Risiko</p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <h3>{{count($penyebab_peristiwa_risiko)}}</h3>
                                    <p class="mb-2">Penyebab</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
$(function() {
    flatpickr("#tanggal", {
        enableTime: false,
        dateFormat: "d-m-Y",
        mode: "range"
    });
});
</script>
@endpush