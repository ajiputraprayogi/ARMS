@extends('layouts.base')
@section('title')
    Daftar Resiko Teridentifikasi | ARMS
@endsection
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card card-transparent card-block card-stretch card-height border-none">
            <div class="card-header p-0 mt-lg-2 mt-0">
                <h3 class="mb-3">Daftar Risiko Teridentifikasi</h3>
                <form method="get">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <select class="form-control" name="departemen" id="departemen">
                                    <option>Semua Departemen</option>
                                    @foreach($departemen as $rowdpr)
                                    <option value="{{$rowdpr->faktur}}" @if($active_departemen==$rowdpr->faktur) selected
                                        @endif>{{$rowdpr->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <select class="form-control" name="konteks" id="konteks">
                                    <option>Semua Konteks</option>
                                    @foreach($konteks as $rowkts)
                                    <option value="{{$rowkts->id}}" @if($active_konteks==$rowkts->id) selected
                                        @endif>{{$rowkts->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <select class="form-control" name="kategori" id="">
                                    <option>Semua Kategori</option>
                                    @foreach($kategori as $rowktg)
                                    <option value="{{$rowktg->id}}" @if($active_kategori==$rowktg->id) selected
                                        @endif>{{$rowktg->resiko}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <select class="form-control" name="status" id="">
                                    <option>Semua Status</option>
                                    @foreach($status as $rowsts)
                                    <option value="{{$rowsts->status}}" @if($active_status==$rowsts->status) selected
                                        @endif>{{$rowsts->status}}</option>
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
                                    <a href="{{url('/resiko-teridentifikasi')}}" class="btn btn-secondary"
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
                        <a href="{{url('resiko-teridentifikasi/create')}}" class="btn btn-primary add-list"><i class="las la-plus mr-3"></i>Tambah Risiko Baru</a>
                    </div>
                </div>
                <div class="table-responsive rounded mb-3">
                    <table id="list-data" class="table data-tables">
                        <thead class="bg-white text-uppercase">
                            <tr class="ligth ligth-data">
                                <!-- <th>
                                    <div class="checkbox d-inline-block">
                                        <input type="checkbox" class="checkbox-input" id="checkbox1">
                                        <label for="checkbox1" class="mb-0"></label>
                                    </div>
                                </th> -->
                                <th>PR</th>
                                <th>Kode Risiko</th>
                                <th>Pernyataan Risiko</th>
                                <th>Konteks</th>
                                <th>Kategori</th>
                                <th>Besaran Risiko awal</th>
                                <th>Besaran Risiko Terakhir</th>
                                
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="ligth-body">
                        @foreach($data as $item)
                            <tr>
                                <td><div class="box1" style="background-color: {{$item->pr_akhir}}"></div></td>
                                <td>{{$item->full_kode}}</td>
                                <td>{{$item->pernyataan_risiko}}</td>
                                <td>{{$item->namakonteks}}</td>
                                <td>{{$item->namakat}}</td>
                                <td>
                                    <label for="">{{$item->frekuensi_awal}}</label><br>
                                    <label for="">{{$item->dampak_awal}}</label><br>
                                    <input type="text" class="box1" value="{{$item->besaran_awal}}" style="background-color: {{$item->pr}}" readonly>
                                </td>
                                <td>
                                    <label for="">{{$item->frekuensi_akhir}}</label><br>
                                    <label for="">{{$item->dampak_akhir}}</label><br>
                                    <input type="text" class="box1" value="{{$item->besaran_akhir}}" style="background-color: {{$item->pr_akhir}}" readonly>
                                </td>
                                <td>{{$item->status}}</td>
                                <td>
                                <a class="btn btn-success btn-sm m-1"
                                        href="{{url('/resiko-teridentifikasi/'.$item->id.'/edit')}}">
                                        <i class="ri-pencil-line mr-0"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger m-1" data-toggle="tooltip" data-placement="top"
                                        title="" data-original-title="Delete"
                                        onclick="hapusdatamanajemenrisiko({{$item->id}})"><i
                                            class="ri-delete-bin-line mr-0"></i></button>
                                </td>
                            </tr>
                            <div class="modal fade" id="show{{$item->id}}" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Kategori Risiko</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" action="{{url('resikoteridentifikasi')}}" method="post">
                                            @csrf
                                            <!-- <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="">PR</label>
                                                <div class="col-sm-9">
                                                    <div class="box1"></div>
                                                </div>
                                            </div> -->
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="">Kode Risiko</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="resiko" class="form-control" value="{{$item->kode_risiko}}" id="" readonly required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="">Pernyataan Risiko</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="resiko" class="form-control" value="{{$item->pernyataan_risiko}}" id="" readonly required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="">Konteks</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="resiko" class="form-control" value="{{$item->konteks}}" id="" readonly required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="">Kategori</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="resiko" class="form-control" value="{{$item->kategori_risiko}}" id="" readonly required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="">Besaran Risiko Awal</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="resiko" class="form-control" value="23" id="" readonly required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="">Besaran Risiko Akhir</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="resiko" class="form-control" value="18" id="" readonly required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="">Status</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="resiko" class="form-control" value="Belum memenuhi selera risiko" id="" readonly required>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                </div>
                            </div>
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
    <script src="{{asset('assets/customjs/backend/resiko_teridentifikasi_filter.js')}}"></script>
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
                        url: '/resiko-teridentifikasi/' + kode,
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

