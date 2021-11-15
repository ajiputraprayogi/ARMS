@extends('layouts.base')
@section('title')
    Daftar Pelaksanaan Manajemen Risiko | ARMS
@endsection
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card card-transparent card-block card-stretch card-height border-none">
            <div class="card-header p-0 mt-lg-2 mt-0">
                <h3 class="mb-3">Daftar Pelaksanaan Tindak Pengendalian Risiko</h3>
                <form method="get">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <select class="form-control" name="departemen" id="">
                                    <option>Semua Departemen</option>
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
                        <a href="{{url('pelaksanaan-pengendalian/create')}}" class="btn btn-primary add-list"><i class="las la-plus mr-3"></i>Tambah Pelaksanaan Pengendalian</a>
                    </div>
                </div>
                <div class="table-responsive rounded mb-3">
                    <table id="" class="table mb-0 tbl-server-info data-tables">
                        <thead class="bg-white text-uppercase">
                            <tr class="ligth ligth-data">
                                <!-- <th>
                                    <div class="checkbox d-inline-block">
                                        <input type="checkbox" class="checkbox-input" id="checkbox1">
                                        <label for="checkbox1" class="mb-0"></label>
                                    </div>
                                </th> -->
                                <th>Kode Pengendalian</th>
                                <th>Kode Risiko</th>
                                <th>Kegiatan Pengendalian</th>
                                <th>Penanggung Jawab</th>
                                <th>Tanggal Pelaksanaan Waktu</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="ligth-body">
                            @foreach($data as $row)
                                <tr>
                                    <td>{{$row->kode_tindak_pengendalian}}</td>
                                    <td>{{$row->full_kode}}</td>
                                    <td>{{$row->kegiatan_pengendalian}}</td>
                                    <td>{{$row->penanggung_jawab}}</td>
                                    <td>{{$row->realisasi_waktu}}</td>
                                    <td>{{$row->status_pelaksanaan}}</td>
                                    <td>
                                    <a class="btn btn-success btn-sm m-1"
                                    href="{{url('/pelaksanaan-pengendalian/'.$row->id.'/edit')}}">
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
    <script src="{{asset('phppiechart/assets/js/highcharts.js')}}"></script>
    <script src="{{asset('assets/customjs/backend/manajemen_risiko.js')}}"></script>
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
                        url: '/pelaksanaan-pengendalian/' + kode,
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

