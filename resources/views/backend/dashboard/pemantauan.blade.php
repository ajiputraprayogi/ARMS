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
            <h3 class="mb-3">Dashboard Peristiwa Risiko</h3>
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
                                <a href="{{url('/dashboard-pemantauan')}}" class="btn btn-primary"
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
                <div class="col-md-2">
                    <div class="card bg-danger">
                        <div class="card-body text-center">
                            <h3>{{$kejadian_peristiwa_risiko}}</h3>
                            <p class="mb-2">Kejadian</p>
                        </div>
                    </div>
                    <div class="card bg-warning">
                        <div class="card-body text-center">
                            <h3>{{count($risiko_peristiwa_risiko)}}</h3>
                            <p class="mb-2">Risiko</p>
                        </div>
                    </div>
                    <div class="card bg-success">
                        <div class="card-body text-center">
                            <h3>{{count($penyebab_peristiwa_risiko)}}</h3>
                            <p class="mb-2">Penyebab</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-10">
                    <h4>Sebaran Penyebab Berdasarkan Kode Penyebab</h4>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Kategori Penyebab Kejadian</th>
                                            <th scope="col" class="text-center">Jumlah Kejadian</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sebaran_penyebab as $row_sebaran_penyebab)
                                        <tr>
                                            <td class="text-center">
                                                {{$row_sebaran_penyebab->penyebab}} - {{$row_sebaran_penyebab->kode}}
                                            </td>
                                            <td class="text-center">
                                                {{$row_sebaran_penyebab->total}}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <h4 class="mt-5">Sebaran Peristiwa Berdasarkan Kategori Risiko</h4>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Kategori Risiko Yang Terjadi</th>
                                            <th scope="col" class="text-center">Jumlah Kejadian</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($kategori_resiko as $row_kategori_resiko)
                                        @php
                                        $final_jumlah=0;
                                        if(request()->get('departemen')){
                                            if(request()->get('departemen')!='semua'){
                                                $jumlah_kejadian = DB::table('pencatatan_peristiwa_resiko')
                                                ->select(DB::raw('pencatatan_peristiwa_resiko.*'))
                                                ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','pencatatan_peristiwa_resiko.resiko_id')
                                                ->where('resiko_teridentifikasi.id_kategori',$row_kategori_resiko->id)
                                                ->where('pencatatan_peristiwa_resiko.departemen_id',request()->get('departemen'))
                                                ->groupby('pencatatan_peristiwa_resiko.id')
                                                ->get();
                                            }else{
                                                $jumlah_kejadian = DB::table('pencatatan_peristiwa_resiko')
                                                ->select(DB::raw('pencatatan_peristiwa_resiko.*'))
                                                ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','pencatatan_peristiwa_resiko.resiko_id')
                                                ->where('resiko_teridentifikasi.id_kategori',$row_kategori_resiko->id)
                                                ->groupby('pencatatan_peristiwa_resiko.id')
                                                ->get();
                                            }
                                        }else{
                                        $jumlah_kejadian = DB::table('pencatatan_peristiwa_resiko')
                                        ->select(DB::raw('pencatatan_peristiwa_resiko.*'))
                                        ->leftjoin('resiko_teridentifikasi','resiko_teridentifikasi.full_kode','=','pencatatan_peristiwa_resiko.resiko_id')
                                        ->where('resiko_teridentifikasi.id_kategori',$row_kategori_resiko->id)
                                        ->groupby('pencatatan_peristiwa_resiko.id')
                                        ->get();
                                        }
                                        @endphp
                                        @php $final_jumlah=count($jumlah_kejadian); @endphp
                                        <tr>
                                            <td class="text-center">
                                                {{$row_kategori_resiko->resiko}}
                                            </td>
                                            <td class="text-center">
                                                {{$final_jumlah}}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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