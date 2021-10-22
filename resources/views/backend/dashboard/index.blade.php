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
                <div class="col-md-4">
                    <label for="">Departemen</label>
                    <div class="input-group mb-3">
                        <select class="form-control" name="tahun" id="">
                            <option>Semua Tahun</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2026">2026</option>
                        </select>
                        <div class="input-group-prepend" style="border-radius:10p;">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                            <a href="{{url('/')}}" class="btn btn-primary"
                                style="border-top-right-radius: 10px;border-bottom-right-radius: 10px;"><i
                                    class="fas fa-sync"></i></a>
                        </div>
                    </div>
                </div>
            </div>
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
                            <h4 class="card-title">Rencana Tindak Pengendaalian</h4>
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
                                    <h3>{{$risiko_peristiwa_risiko}}</h3>
                                    <p class="mb-2">Risiko</p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <h3>{{$populasi_risiko}}</h3>
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

</script>
@endpush