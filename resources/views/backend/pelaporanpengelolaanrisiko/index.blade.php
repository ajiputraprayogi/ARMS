@extends('layouts.base')
@section('title')
    Pelaporan Pengelolaan Risiko | ARMS
@endsection
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card card-transparent card-block card-stretch card-height border-none">
            <div class="card-header p-0 mt-lg-2 mt-0">
                <h3 class="mb-3">Pelaporan Pengelolaan Risiko</h3>
                <form method="get">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <select class="form-control" name="departemen" id="">
                                    <option value="Semua Departemen">Semua Unit Kerja</option>
                                    @foreach ($departemen as $d)
                                    <option value={{ $d->id }} @if ($active_departemen == $d->id) selected @endif>{{ $d->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <select class="form-control" name="periodepelaporan" id="">
                                    <option>Semua Periode</option>
                                    @foreach ($periode as $p)
                                    <option value={{ $p->id }} @if ($active_periode == $p->id) selected @endif>{{ $p->nama_periode }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <select class="form-control" name="status" id="">
                                    <option>Semua Status</option>
                                    <option value="diajukan" @if ($active_status == 'diajukan') selected @endif>Diajukan</option>
                                    <option value="proses pemeriksaan" @if ($active_status == 'proses pemeriksaan') selected @endif>Proses Pemeriksaan</option>
                                    <option value="laporan diterima" @if ($active_status == 'laporan diterima') selected @endif>Laporan Diterima</option>
                                </select>
                                <div class="input-group-prepend" style="border-radius:10p;">
                                    <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i></button>
                                    <a href="{{url('/pelaporan-pengelolaan-risiko')}}" class="btn btn-secondary"
                                        style="border-top-right-radius: 10px;border-bottom-right-radius: 10px;"><i
                                            class="fas fa-sync"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 float-right text-right">
                            <a href="{{url('pelaporan-pengelolaan-risiko/create')}}" class="btn btn-primary add-list"><i class="las la-plus mr-3"></i>Tambah Pelaporan</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body p-0 mt-lg-2 mt-0">
                @if (session('status'))
                <div class="alert text-white bg-success" role="alert">
                    <div class="iq-alert-text"><b>Info!</b> {{ session('status') }}</div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="ri-close-line"></i>
                    </button>
                </div>
                @endif
                <div class="table-responsive rounded mb-3">
                    <table id="" class="table data-tables mb-0 tbl-server-info">
                        <thead class="bg-white text-uppercase">
                            <tr class="ligth ligth-data">
                                <th>Periode Pelaporan</th>
                                <th>Unit Kerja</th>
                                <th>Status</th>
                                <th>File</th>
                                <th>Kepada</th>
                                <th>Tembusan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="ligth-body">
                        {{-- @php $i=($data->currentpage()-1)* $data->perpage(); @endphp --}}
                        @foreach($data as $item)
                        {{-- @php $i++ @endphp --}}
                        <tr>
                            <td>{{$item->nama_periode}}</td>
                            <td class="">{{$item->nama}}</td>
                            <td class="text-capitalize">{{$item->status}}</td>
                            <td class=""><a href="/pelaporan/{{$item->file}}">{{$item->file}}</a></td>
                            <td class="">
                                @php
                                $id_pengendalian = [];
                                 if(count($data)>0){
                                    foreach ($data as $row) {
                                        array_push($id_pengendalian,$row->id);
                                    }
                                }
                                // dd($id_pengendalian);
                                    $kepada = DB::table('tujuanpelaporan')
                                    ->select('tujuanpelaporan.*','departemen.nama')
                                    ->leftjoin('departemen','departemen.id','=','tujuanpelaporan.id_departemen')
                                    ->whereIn('tujuanpelaporan.id_pelaporan',$id_pengendalian)
                                    ->get();
                                    // dd($kepada);
                                @endphp
                                @foreach ($kepada as $rowkepada)
                                    @if($rowkepada->id_pelaporan == $item->id) {{$rowkepada->nama}} @endif
                                @endforeach
                            </td>
                            <td class="">
                                @php
                                $id_tembusan = [];
                                 if(count($data)>0){
                                    foreach ($data as $row) {
                                        array_push($id_tembusan,$row->tembusan);
                                    }
                                }
                                // dd($id_tembusan);
                                    $tembusan = DB::table('tembusan')
                                    ->select('tembusan.*','departemen.nama')
                                    ->leftjoin('departemen','departemen.id','=','tembusan.id_departemen')
                                    ->whereIn('tembusan.id_departemen',$id_tembusan)
                                    ->groupby('tembusan.id_departemen')
                                    ->get();
                                    // dd($tembusan);
                                @endphp
                                @foreach ($tembusan as $rowtembusan)
                                    @if($rowtembusan->id_departemen == $item->tembusan) {{$rowtembusan->nama}} @endif
                                @endforeach
                            </td>
                            <td class="text-center">
                            <div class="d-flex align-items-center list-action">
                            <a class="badge badge-info mr-2" data-toggle="modal" data-target="#show{{$item->id}}" title="View" data-original-title="View"><i class="ri-eye-line mr-0"></i></a>
                            <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="/pelaporan-pengelolaan-risiko/{{ $item->id }}/edit"><i class="ri-pencil-line mr-0"></i></a>
                            <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" onclick="hapusdata({{$item->id}})"><i class="ri-delete-bin-line mr-0"></i></a>
                            </div>
                            </td>
                        </tr>
                        @endforeach
                        @foreach($data as $item)
                            <div class="modal fade" id="show{{$item->id}}" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Pelaporan Pengelolaan Risiko</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" action="{{url('periodepelaporan')}}" method="post">
                                            @csrf
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="">Periode Pelaporan</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="periodepelaporan" class="form-control" value="{{$item->nama_periode}}" id="" readonly required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="">Unit Kerja</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="departemen" class="form-control" value="{{$item->nama}}" id="" readonly required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="">Status</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="status" class="form-control" value="{{$item->status}}" id="" readonly required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="">File</label>
                                                <div class="col-sm-9">
                                                    <a href="/pelaporan/{{$item->file}}" target="_blank">{{$item->file}}</a>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="">Kepada</label>
                                                <div class="col-sm-9">
                                                    @foreach ($kepada as $rowkepada)
                                                        @if($rowkepada->id_pelaporan == $item->id) {{$rowkepada->nama}} @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="">Tembusan</label>
                                                <div class="col-sm-9">
                                                    @foreach ($tembusan as $rowtembusan)
                                                        @if($rowtembusan->id_departemen == $item->tembusan) {{$rowtembusan->nama}} @endif
                                                    @endforeach
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
    <script src="{{asset('assets/customjs/backend/pelaporanpengelolaanrisiko.js')}}"></script>
@endpush

