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
                <h3 class="mb-3">Daftar Tindak Pengendalian</h3>
                <form method="get">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Departemen</label>
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
                    <label for="">Tahun</label>
                    <div class="input-group mb-3">
                        <select class="form-control"  id="">
                            <option>Semua Tahun</option>
                           
                        </select>
                        <div class="input-group-prepend" style="border-radius:10p;">
                            <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i></button>
                            <a href="{{url('/pengendalian')}}" class="btn btn-secondary"
                                style="border-top-right-radius: 10px;border-bottom-right-radius: 10px;"><i
                                    class="fas fa-sync"></i></a>
                        </div>
                    </div>
                </div>
                    <!-- <div class="col-md-9">
                        <label for="">Tahun</label>
                        <div class="row">
                            <div class="col-md-3">
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
                    </div> -->
                </div>
            </form>
            </div>
            <hr>
            <div class="card-body p-0 mt-lg-2 mt-0">
                <div class="form-group">
                    <div class="text-right">
                        <a href="{{url('pengendalian/create')}}" class="btn btn-primary add-list"><i class="las la-plus mr-3"></i>Tambah Tindakan Pengendalian</a>
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
                                <th>Respons Risiko</th>
                                <th>Kegiatan Pengendalian</th>
                                <th>Penanggung Jawab</th>
                                <th>Target Waktu</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="ligth-body">
                        @foreach($data as $item)
                            <tr>
                                <td class="text-center">{{$item->kode_tindak_pengendalian}}</td>
                                <td>{{$item->respons_risiko}}</td>
                                <td>{{$item->kegiatan_pengendalian}}</td>
                                <td>{{$item->penanggung_jawab}}</td>
                                <td>{{$item->target_waktu}}</td>
                                <td>{{$item->status_pelaksanaan}}</td>
                                <td>
                                <a class="btn btn-success btn-sm m-1"
                                        href="{{url('/pengendalian/'.$item->id.'/edit')}}">
                                        <i class="ri-pencil-line mr-0"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger m-1" data-toggle="tooltip" data-placement="top"
                                        title="" data-original-title="Delete"
                                        onclick="hapusdatamanajemenrisiko({{$item->id}})"><i
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
                        url: '/pengendalian/' + kode,
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

