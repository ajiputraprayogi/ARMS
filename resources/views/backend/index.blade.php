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
                                    <input type="date" class="form-control" id="dob" name="tanggal1"/>
                                </div>
                            </div>
                            <label class="control-label align-self-center" for="">s/d</label>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="date" class="form-control" id="dob" name="tanggal2"/>
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
        </div>
    </div>
@endsection
@push('script')
    <script src="{{asset('phppiechart/assets/js/highcharts.js')}}"></script>
@endpush

