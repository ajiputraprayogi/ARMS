@extends('layouts.base')
@section('title')
    Daftar Pengendalian Risiko | Dashboard
@endsection
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card card-transparent card-block card-stretch card-height border-none">
            <div class="card-header p-0 mt-lg-2 mt-0">
                <h3 class="mb-3">Daftar Pencatatan Peristiwa Risiko</h3>
                <form class="form-horizontal" action="{{url('/pencatatan-peristiwa-cari')}}" method="post">
                <div class="row">
                        @csrf
                        <div class="col-md-3">
                            <label for="">Departemen</label>
                            <div class="form-group">
                                <select class="form-control select" name="dept" id="">
                                    <option selected disabled value="">Pilih Departemen</option>
                                    @foreach ($cari as $item)
                                        <option value="{{ $item->dept }}">{{ $item->dept }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <label for="">Tahun</label>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select class="form-control select" name="tahun" id="">
                                            <option selected disabled value="">Pilih Tahun</option>
                                            @foreach ($cari as $item)
                                                <option value="{{ $item->tahun }}">{{ $item->tahun }}</option>
                                            @endforeach
                                        </select>
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
            </form>
            </div>
            <hr>
            <div class="card-body p-0 mt-lg-2 mt-0">
                <div class="form-group">
                    <div class="text-right">
                        <a href="{{url('pencatatan-peristiwa/create')}}" class="btn btn-primary add-list"><i class="las la-plus mr-3"></i>Tambah Pencatatan Peristiwa </a>
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
                                <th>Kode Risiko</th>
                                <th>Pernyataan Risiko</th>
                                <th>Uraian Peristiwa</th>
                                <th>Waktu Kejadian</th>
                                <th>Skor Dampak</th>
                                <th>Kode Penyebab</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        @foreach($data as $item)
                        <tbody class="ligth-body">
                            <th class="text-center">{{$item->resiko_id}}</th>
                            <th>{{$item->pernyataan}}</th>
                            <th>{{$item->uraian}}</th>
                            <th>{{$item->waktu}}</th>
                            <th>{{ $item->skor }} || {{ $item->dampak }}</th>
                            <th>{{$item->penyebab}}</th>
                            <th>
                            <a class="btn btn-success btn-sm m-1"
                                    href="{{url('/pencatatan-peristiwa/'.$item->id.'/edit')}}">
                                    <i class="ri-pencil-line mr-0"></i>
                                </a>
                                <button class="btn btn-sm btn-danger m-1" data-toggle="tooltip" data-placement="top"
                                    title="" data-original-title="Delete"
                                    onclick="hapusdatamanajemenrisiko({{$item->id}})"><i
                                        class="ri-delete-bin-line mr-0"></i></button>
                            </th>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{asset('phppiechart/assets/js/highcharts.js')}}"></script>
    <!-- <script src="{{asset('assets/customjs/backend/manajemen_risiko.js')}}"></script> -->
    <script>
        $(function() {
            $(".select").select2();
        });
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
                        url: '/pencatatan-peristiwa/' + kode,
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

