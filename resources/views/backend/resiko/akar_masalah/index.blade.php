@extends('layouts.base')
@section('title')
Analisis Akar Masalah | ARMS
@endsection
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div class="col-lg-12">
    <div class="card card-transparent card-block card-stretch card-height border-none">
        <div class="card-header p-0 mt-lg-2 mt-0">
            <h3 class="mb-3">Daftar Analisis Akar Masalah</h3>
            <form method="get">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <select class="form-control" name="departemen" id="">
                                <option>Semua Departemen</option>
                                @foreach($departemen as $rowdpr)
                                <option value="{{$rowdpr->id}}" @if($active_departemen==$rowdpr->id) selected
                                    @endif>{{$rowdpr->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <select class="form-control" name="kategori_penyebab" id="">
                                <option>Semua Kategori Penyebab</option>
                                @foreach($kategori_penyebab as $rowkat)
                                <option value="{{$rowkat->kode}}" @if($active_kategori==$rowkat->kode) selected
                                    @endif>{{$rowkat->kode}} - {{$rowkat->penyebab}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <select class="form-control select" name="kode_risiko" id="">
                                <option>Semua Kode Risiko</option>
                                @foreach($kode_risiko as $rowkdr)
                                <option value="{{$rowkdr->full_kode}}" @if($active_kode==$rowkdr->full_kode) selected
                                    @endif>{{$rowkdr->full_kode}}</option>
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
                                <a href="{{url('/analisa-akar-masalah')}}" class="btn btn-secondary"
                                    style="border-top-right-radius: 10px;border-bottom-right-radius: 10px;"><i
                                        class="fas fa-sync"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-4 text-right">
                        <a href="{{url('pelaksanaan/create')}}" class="btn btn-primary mb-3 btn-lg"><i
                                class="las la-plus mr-3"></i>Tambah Pelaksanaan Baru</a>
                    </div> -->
                </div>
            </form>
        </div>
        <hr>
        <div class="card-body p-0 mt-lg-2 mt-0">
            <div class="form-group">
                <div class="text-right">
                    <a href="{{url('analisa-akar-masalah/create')}}" class="btn btn-primary add-list"><i
                            class="las la-plus mr-3"></i>Tambah Analisis Akar Masalah</a>
                </div>
            </div>
            <div class="table-responsive rounded mb-3">
                <table id="" class="table data-tables">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>Kode Risiko</th>
                            <th>Kategori Penyebab</th>
                            <th>Akar Permasalahan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $row)
                        <tr>
                            <td>{{$row->kode_risiko}}</td>
                            <td>{{$row->kategori_penyebab}}</td>
                            <td>{{$row->akar_masalah}}</td>
                            <td class="text-center">
                                <a class="btn btn-success btn-sm m-1"
                                    href="{{url('/analisa-akar-masalah/'.$row->id.'/edit')}}">
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
                url: '/analisa-akar-masalah/' + kode,
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
<script>
        $(function() {
        flatpickr("#tanggal", {
            enableTime: false,
            dateFormat: "d-m-Y",
            mode: "range",
        });
        });
    </script>
    <script>
        $(function() {
            $(".select").select2();
        });
    </script>
@endpush