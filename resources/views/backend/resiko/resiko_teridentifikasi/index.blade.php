@extends('layouts.base')
@section('title')
    ARMS | Resiko Teridentifikasi
@endsection
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card card-transparent card-block card-stretch card-height border-none">
            <div class="card-header p-0 mt-lg-2 mt-0">
                <h3 class="mb-3">Daftar Risiko</h3>
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
                    <div class="col-md-3">
                        <label for="">Konteks</label>
                        <div class="form-group">
                            <select class="form-control" name="client" id="">
                                <option selected disabled value="">Pilih Konteks</option>
                                <option value="">...</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="">Tahun</label>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="date" class="form-control" id="dob" name="tanggal1"/>
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
                <div class="form-group">
                    <div class="text-right">
                        <a href="{{url('resiko-teridentifikasi/create')}}" class="btn btn-primary add-list"><i class="las la-plus mr-3"></i>Tambah Risiko Baru</a>
                    </div>
                </div>
                <div class="table-responsive rounded mb-3">
                    <table id="list-data" class="table mb-0 tbl-server-info">
                        <thead class="bg-white text-uppercase">
                            <tr class="ligth ligth-data">
                                <!-- <th>
                                    <div class="checkbox d-inline-block">
                                        <input type="checkbox" class="checkbox-input" id="checkbox1">
                                        <label for="checkbox1" class="mb-0"></label>
                                    </div>
                                </th> -->
                                <th>PR</th>
                                <th>Kode Risiko</th>
                                <th>Pernyataan Risiko</th>
                                <th>Konteks</th>
                                <th>Kategori</th>
                                <th>Besaran Risiko awal</th>
                                <th>Besaran Risiko Terakhir</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="ligth-body">
                        @foreach($data as $item)
                            <div class="modal fade" id="show{{$item->id}}" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Kategori Risiko</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" action="{{url('resikoteridentifikasi')}}" method="post">
                                            @csrf
                                            <!-- <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="">PR</label>
                                                <div class="col-sm-9">
                                                    <div class="box1"></div>
                                                </div>
                                            </div> -->
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="">Kode Risiko</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="resiko" class="form-control" value="{{$item->kode_risiko}}" id="" readonly required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="">Pernyataan Risiko</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="resiko" class="form-control" value="{{$item->pernyataan_risiko}}" id="" readonly required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="">Konteks</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="resiko" class="form-control" value="{{$item->konteks}}" id="" readonly required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="">Kategori</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="resiko" class="form-control" value="{{$item->kategori_risiko}}" id="" readonly required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="">Besaran Risiko Awal</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="resiko" class="form-control" value="23" id="" readonly required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="">Besaran Risiko Akhir</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="resiko" class="form-control" value="18" id="" readonly required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="">Status</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="resiko" class="form-control" value="Belum memenuhi selera risiko" id="" readonly required>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{asset('phppiechart/assets/js/highcharts.js')}}"></script>
    <script src="{{asset('assets/customjs/backend/resiko_teridentifikasi.js')}}"></script>
@endpush

