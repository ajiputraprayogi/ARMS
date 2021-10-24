@extends('layouts.base')
@section('title')
Daftar Pelaksanaan Manajemen Risiko | ARMS
@endsection
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div class="col-lg-12">
    <div>
        <h4 class="mb-3">Data Pelaksanaan Manajemen Risiko</h4>
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
                            <a href="{{url('/pelaksanaan')}}" class="btn btn-secondary"
                                style="border-top-right-radius: 10px;border-bottom-right-radius: 10px;"><i
                                    class="fas fa-sync"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-right">
                    <a href="{{url('pelaksanaan/create')}}" class="btn btn-primary mb-3 btn-lg"><i
                            class="las la-plus mr-3"></i>Tambah Pelaksanaan Baru</a>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="col-lg-12 mt-2">
    <div class="card card-transparent card-block card-stretch card-height border-none">
        <div class="card-body p-0 mt-lg-2 mt-0">
            <div class="table-responsive rounded mb-3">
                <table id="" class="table data-tables">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No</th>
                            <th>Departemen</th>
                            <th>Tahun</th>
                            <th>Jumlah Konteks</th>
                            <th>Jumlah Risiko</th>
                            <th>Selera Risiko</th>
                            <th>PIC</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                    @php $i=($data->currentpage()-1)* $data->perpage(); @endphp
                    @foreach($data as $row)
                    @php $i++ @endphp
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$row->nama}}</td>
                            <td class="text-center">{{$row->priode_penerapan}}</td>
                            <td class="text-center">{{$row->totalkonteks}}</td>
                            <td class="text-center">{{$row->totalrisiko}}</td>
                            <td class="text-center">{{$row->selera_risiko}}</td>
                            <td>{{$row->nama_pemilik_risiko}}</td>
                            <td class="text-center">
                                <a class="badge badge-info mr-2" data-toggle="modal" data-target="#showpemangku{{$row->id}}"
                                    title="View" data-original-title="View"><i class="ri-eye-line mr-0"></i></a>
                                <a class="badge bg-success mr-2" href="{{url('edit-pelaksanaan/'.$row->faktur)}}"
                                    title="View" data-original-title="View"><i class="ri-pencil-line mr-0"></i></a>
                                <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title=""
                                    data-original-title="Delete" onclick="hapusdatamanajemenrisiko({{$row->faktur}})"><i
                                        class="ri-delete-bin-line mr-0"></i><input type="hidden" name="faktur"
                                        value="{{$row->faktur}}"></a>
                                <!-- <a class="badge bg-warning mr-2" data-original-title="Delete" href="{{''}}"><i class="ri-delete-bin-line mr-0"></i></a> -->
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $data->appends($_GET)->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<!-- <script src="{{asset('assets/customjs/backend/manajemen_risiko.js')}}"></script> -->
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
                        url: '/pelaksanaan/' + kode,
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