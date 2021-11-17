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
            <h3 class="mb-3">Dashboard Penyebab</h3>
            <form method="get">
                <div class="row">
                    <div class="col-md-4">
                        <label class="m-0">Unit Kerja</label>
                        <div class="input-group mb-3">
                            <select class="form-control" name="departemen" id="departemen">
                                <option value="semua">Semua Unit Kerja</option>
                                @foreach($data_departemen as $row_departemen)
                                <option value="{{$row_departemen->id}}" @if(request()->get('departemen'))
                                    @if(request()->get('departemen')==$row_departemen->id) selected @endif
                                    @endif>{{$row_departemen->nama}}</option>
                                @endforeach
                            </select>
                            <div class="input-group-prepend" style="border-radius:10p;">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                <a href="{{url('/dashboard-penyebab')}}" class="btn btn-primary"
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
                            <h3>{{$penyebab_teridentifikasi}}</h3>
                            <p class="mb-2">Teridentifikasi</p>
                        </div>
                    </div>
                    <div class="card bg-success">
                        <div class="card-body text-center">
                            <h3>{{$penyebab_termitigasi}}</h3>
                            <p class="mb-2">Termitigasi</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Kode Kategori Penyebab</th>
                                            <th scope="col" class="text-center">Teridentifikasi</th>
                                            <th scope="col" class="text-center">Termitigasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($penyebab as $row_penyebab)
                                        @php
                                        $label_teridentifikasi=0;
                                        $label_termitigasi=0;

                                        if(request()->get('departemen')){
                                            if(request()->get('departemen')!='semua'){
                                                $total_penyebab_teridentifikasi = DB::table('analisa_masalah')
                                                ->select(DB::raw('count(analisa_masalah.id) as total,pengendalian_risiko.status_pelaksanaan'))
                                                ->leftjoin('pengendalian_risiko','pengendalian_risiko.id_akar_masalah','=','analisa_masalah.id')
                                                ->where('pengendalian_risiko.id_departemen',request()->get('departemen'))
                                                ->where('kategori_penyebab',$row_penyebab->kode)
                                                ->groupby('kategori_penyebab')
                                                ->get();

                                                $total_penyebab_termitigasi = DB::table('analisa_masalah')
                                                ->select(DB::raw('count(analisa_masalah.id) as
                                                total,analisa_masalah.*,pengendalian_risiko.status_pelaksanaan'))
                                                ->leftjoin('pengendalian_risiko','pengendalian_risiko.id_akar_masalah','=','analisa_masalah.id')
                                                ->where('analisa_masalah.kategori_penyebab',$row_penyebab->kode)
                                                ->where('pengendalian_risiko.status_pelaksanaan','=','Selesai dilaksanakan')
                                                ->where('pengendalian_risiko.id_departemen',request()->get('departemen'))
                                                ->groupby('analisa_masalah.kategori_penyebab')
                                                ->get();
                                            }else{
                                                $total_penyebab_teridentifikasi = DB::table('analisa_masalah')
                                                ->select(DB::raw('count(id) as total'))
                                                ->where('kategori_penyebab',$row_penyebab->kode)
                                                ->groupby('kategori_penyebab')
                                                ->get();

                                                $total_penyebab_termitigasi = DB::table('analisa_masalah')
                                                ->select(DB::raw('count(analisa_masalah.id) as
                                                total,analisa_masalah.*,pengendalian_risiko.status_pelaksanaan'))
                                                ->leftjoin('pengendalian_risiko','pengendalian_risiko.id_akar_masalah','=','analisa_masalah.id')
                                                ->where('analisa_masalah.kategori_penyebab',$row_penyebab->kode)
                                                ->where('pengendalian_risiko.status_pelaksanaan','=','Selesai dilaksanakan')
                                                ->groupby('analisa_masalah.kategori_penyebab')
                                                ->get();
                                            }
                                        }else{
                                            $total_penyebab_teridentifikasi = DB::table('analisa_masalah')
                                            ->select(DB::raw('count(id) as total'))
                                            ->where('kategori_penyebab',$row_penyebab->kode)
                                            ->groupby('kategori_penyebab')
                                            ->get();

                                            $total_penyebab_termitigasi = DB::table('analisa_masalah')
                                            ->select(DB::raw('count(analisa_masalah.id) as
                                            total,analisa_masalah.*,pengendalian_risiko.status_pelaksanaan'))
                                            ->leftjoin('pengendalian_risiko','pengendalian_risiko.id_akar_masalah','=','analisa_masalah.id')
                                            ->where('analisa_masalah.kategori_penyebab',$row_penyebab->kode)
                                            ->where('pengendalian_risiko.status_pelaksanaan','=','Selesai dilaksanakan')
                                            ->groupby('analisa_masalah.kategori_penyebab')
                                            ->get();
                                        }

                                        @endphp

                                        @foreach($total_penyebab_teridentifikasi as
                                        $row_total_penyebab_teridentifikasi)
                                        @php $label_teridentifikasi=$row_total_penyebab_teridentifikasi->total; @endphp
                                        @endforeach

                                        @foreach($total_penyebab_termitigasi as $row_total_penyebab_termitigasi)
                                        @php $label_termitigasi=$row_total_penyebab_termitigasi->total; @endphp
                                        @endforeach
                                        <tr>
                                            <td class="text-center">{{$row_penyebab->penyebab}} -
                                                {{$row_penyebab->kode}}</td>
                                            <td class="text-center">
                                                {{$label_teridentifikasi}}
                                            </td>
                                            <td class="text-center">
                                                {{$label_termitigasi}}
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
