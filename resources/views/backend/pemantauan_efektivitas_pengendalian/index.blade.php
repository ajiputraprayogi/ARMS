@extends('layouts.base')
@section('title')
    Daftar Rencana Tindak Pengendalian | ARMS
@endsection
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card card-transparent card-block card-stretch card-height border-none">
            <div class="card-header p-0 mt-lg-2 mt-0">
                <h3 class="mb-3">Daftar Rencana Tindak Pengendalian</h3>
                <form method="get">
                <div class="row">
                    <!-- <div class="col-md-4">
                        <label for="">Departemen</label>
                        <div class="form-group">
                        <select class="form-control" name="departemen" id="">
                            <option>Semua Departemen</option>
                            <option value="" selected></option>
                        </select>
                      
                        </div>
                    </div> -->
                    <!-- <div class="col-md-4">
                        <label for="">Kode Risiko</label>
                        <div class="form-group">
                        <select class="form-control select" name="kode_risiko" required>
                            <option value="Semua Kode Risiko">Semua Kode Risiko</option>
                            <option value="" selected></option>
                        </select>
                      
                        </div>
                    </div> -->
                    <!-- <div class="col-md-4">
                        <label for="">Status</label>
                        <div class="form-group">
                        <select class="form-control" name="status" required>
                            <option>Semua Status</option>
                            <option value="" selected></option>
                        </select>
                        </div>
                    </div> -->
                    <!-- <div class="col-md-4">
                        <label for="">Target Waktu Awal</label>
                        <div class="input-group mb-3">
                                <input class="form-control" id="tanggal"
                                        name="target_waktu" placeholder="Pilih Target Waktu Awal" value="" />
                        </div>
                    </div> -->
                    <div class="col-md-4">
                        <!-- <label for="">Target Waktu Akhir</label> -->
                        <div class="input-group mb-3">
                                <!-- <input class="form-control" id="tanggal"
                                        name="target_waktu_akhir" placeholder="Pilih Target Waktu Akhir" value="" /> -->
                            <div class="input-group-prepend" style="border-radius:10p;">
                                <!-- <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i></button> -->
                                <!-- <a href="" class="btn btn-secondary"
                                    style="border-top-right-radius: 10px;border-bottom-right-radius: 10px;"><i
                                        class="fas fa-sync"></i></a> -->
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
            <!-- <hr> -->
            <div class="card-body p-0 mt-lg-2 mt-0">
                <div class="form-group">
                    <div class="text-right">
                        <a href="{{url('pemantauan-efektivitas/create')}}" class="btn btn-primary add-list"><i class="las la-plus mr-3"></i>Tambah Tindakan Pengendalian</a>
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
                                <th>Kode Tindak Pengendalian</th>
                                <th>Besaran Risiko Yang Direspons</th>
                                <th>Besaran Risiko Aktual</th>
                                <th>Pemilik Risiko</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="ligth-body">
                        @foreach($data as $item)
                            <tr>
                                <td>{{$item->full_kode}}</td>
                                <td>{{$item->pernyataan_risiko}}</td>
                                <td>{{$item->kode_tindak_pengendalian}}</td>
                                <td>
                                    <label for="">{{$item->frekuensi_saat_ini}}</label><br>
                                    <label for="">{{$item->dampak_saat_ini}}</label><br>
                                    <input type="text" class="box1" value="{{$item->besaran_saat_ini}}" style="background-color: {{$item->pr_saat_ini}}" readonly>
                                </td>
                                <td>
                                    <label for="">{{$item->frekuensi_akhir}}</label><br>
                                    <label for="">{{$item->dampak_akhir}}</label><br>
                                    <input type="text" class="box1" value="{{$item->besaran_akhir}}" style="background-color: {{$item->pr_akhir}}" readonly>
                                </td>
                                <td>{{$item->nama}}</td>
                                <td>{{$item->keterangan}}</td>
                                <td>
                                <a class="btn btn-success btn-sm m-1"
                                        href="{{url('pemantauan-efektivitas/'.$item->id.'/edit')}}">
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
                        url: '/pemantauan-efektivitas/' + kode,
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
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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

