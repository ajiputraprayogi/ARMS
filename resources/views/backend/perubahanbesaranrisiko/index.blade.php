@extends('layouts.base')
@section('title')
ARMS | Analisa Risiko
@endsection
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div class="col-lg-12">
    <div class="card card-transparent card-block card-stretch card-height border-none">
        <div class="card-header p-0 mt-lg-2 mt-0">
            <h3 class="mb-3">Perubahan Besaran Risiko</h3>
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
                                <input type="date" class="form-control" id="dob" name="tanggal1" />
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
                    <a href="{{url('/perubahan-besaran-risiko/create')}}" class="btn btn-primary add-list"><i
                            class="las la-plus mr-3"></i>Tambah Perubahan Besaran Risiko</a>
                </div>
            </div>
            <div class="table-responsive rounded mb-3">
                <table id="list-data" class="table data-tables mb-0 tbl-server-info">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th class="text-left">Kode Risiko</th>
                            <th class="text-center">Besaran Risiko Yang Di Respons</th>
                            <th class="text-center">Beseran Risiko Aktual</th>
                            <th class="text-center">Deviasi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        @foreach($data as $row)
                        <tr>
                            <td class="text-left">{{$row->kode_resiko_teridentifikasi}}</td>
                            <td class="text-center">{{$row->besaran_akhir}}</td>
                            <td class="text-center">{{$row->besaran_aktual}}</td>
                            <td class="text-center">{{$row->deviasi}}</td>
                            <td class="text-center">
                                <a class="btn btn-success btn-sm m-1"
                                    href="{{url('/perubahan-besaran-risiko/'.$row->id.'/edit')}}">
                                    <i class="ri-pencil-line mr-0"></i>
                                </a>
                                <button class="btn btn-sm btn-danger m-1" data-toggle="tooltip" data-placement="top"
                                    title="" data-original-title="Delete" onclick="hapusdata({{$row->id}})"><i
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
function hapusdata(kode) {
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
                url: '/perubahan-besaran-risiko/' + kode,
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