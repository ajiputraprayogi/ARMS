@extends('layouts.base')
@section('title')
Daftar Analisis Risiko | ARMS
@endsection
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div class="col-lg-12">
    <div class="card card-transparent card-block card-stretch card-height border-none">
        <div class="card-header p-0 mt-lg-2 mt-0">
            <h3 class="mb-3">Daftar Analisis Risiko</h3>
            <form method="get">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <select class="form-control" name="departemen" id="">
                                <option value="Semua Departemen">Semua Unit Kerja</option>
                                @foreach($departemen as $rowdpr)
                                <option value="{{$rowdpr->faktur}}" @if($active_departemen==$rowdpr->faktur) selected
                                    @endif>{{$rowdpr->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <select class="form-control" name="tahun" id="">
                                <option>Semua Tahun</option>
                                @foreach($tahun as $rowthn)
                                <option value="{{$rowthn->priode_penerapan}}" @if($active_tahun==$rowthn->priode_penerapan)
                                    selected @endif>{{$rowthn->priode_penerapan}}</option>
                                @endforeach
                            </select>
                            <div class="input-group-prepend" style="border-radius:10p;">
                                <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i></button>
                                <a href="{{url('/analisa-risiko')}}" class="btn btn-secondary"
                                    style="border-top-right-radius: 10px;border-bottom-right-radius: 10px;"><i
                                        class="fas fa-sync"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <hr>
        @if (session('status'))
        <div class="alert text-white bg-success" role="alert">
            <div class="iq-alert-text"><b>Info!</b> {{ session('status') }}</div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="ri-close-line"></i>
            </button>
        </div>
        @endif
        <div class="card-body p-0 mt-lg-2 mt-0">
            <div class="form-group">
                <div class="text-right">
                    <a href="{{url('analisa-risiko/create')}}" class="btn btn-primary add-list"><i
                            class="las la-plus mr-3"></i>Tambah Analisis Risiko</a>
                </div>
            </div>
            <div class="table-responsive rounded mb-3">
                <table id="list-data" class="table data-tables mb-0 tbl-server-info">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>Kode Risiko</th>
                            <th>Besaran Melekat</th>
                            <th>Besaran risiko Residu</th>
                            <th>Sudah Ada Pengendalian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        @foreach($data as $row)
                        <tr>
                            <td class="text-center">{{$row->kode_risiko}}</td>
                            <td>
                                <label for="">{{$row->frekuensi_melekat}}</label><br>
                                <label for="">{{$row->dampak_melekat}}</label><br>
                                <input type="text" class="box1" value="{{$row->besaran_melekat}}" style="background-color: {{$row->pr}}" readonly>
                            </td>
                            <td>
                                <label for="">{{$row->frekuensi_residu}}</label><br>
                                <label for="">{{$row->dampak_residu}}</label><br>
                                <input type="text" class="box1" value="{{$row->besaran_residu}}" style="background-color: {{$row->pr_residu}}" readonly>
                            </td>
                            @if($row->sudah_ada_pengendalian=='')
                            <td class="text-center">Belum</td>
                            @else
                            <td class="text-center">{{$row->sudah_ada_pengendalian}}</td>
                            @endif
                            <td class="text-center">
                                <a class="btn btn-success btn-sm m-1"
                                    href="{{url('/analisa-risiko/'.$row->id.'/edit')}}">
                                    <i class="ri-pencil-line mr-0"></i>
                                </a>
                                <button class="btn btn-sm btn-danger m-1" data-toggle="tooltip" data-placement="top"
                                    title="" data-original-title="Delete"
                                    onclick="hapusdatamanajemenrisiko({{$row->id}})"><i
                                        class="ri-delete-bin-line mr-0"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
function hapusdatamanajemenrisiko(kode) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger',
        },
        buttonsStyling: true
    })
    swalWithBootstrapButtons.fire({
        title: 'Hapus Data ?',
        text: "Data tidak dapat dipulihkan kembali!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Tidak',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.ajax({
                type: 'DELETE',
                url: '/analisa-risiko/' + kode,
                data: {
                    'token': $('input[name=_token]').val(),
                },
                success: function() {
                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Data Berhasil Dihapus.',
                        'success'
                    )
                    location.reload();
                }
            })
        }
    })
}
</script>
@endpush
