@extends('layouts.base')
@section('title')
    Penyebab | ARMS
@endsection
@section('content')
   <div class="col-md-12">
        <div class="card card-transparent card-block card-stretch card-height border-none">
            <div class="card-header p-0 mt-lg-2 mt-0">
                <h3 class="mb-3">Penyebab</h3>
            </div>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="card-body">
                <form class="form-horizontal" action="{{url('user')}}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Nama Lengkap</label>
                        <div class="col-sm-9">
                        <input id="name" class="floating-input form-control @error('name') is-invalid @enderror" type="text" placeholder=" " value="{{ old('name') }}" name="name" required autocomplete="off">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Username</label>
                        <div class="col-sm-9">
                        <input id="username" class="floating-input form-control @error('username') is-invalid @enderror" type="text" placeholder=" " value="{{ old('username') }}" name="username" required autocomplete="off">
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">E-Mail Address</label>
                        <div class="col-sm-9">
                        <input id="email" class="floating-input form-control @error('email') is-invalid @enderror" type="email" placeholder=" " value="{{ old('email') }}" name="email" required autocomplete="off">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">No. Telp</label>
                        <div class="col-sm-9">
                        <input id="telp" class="floating-input form-control @error('telp') is-invalid @enderror" type="text" placeholder=" " value="{{ old('telp') }}" name="telp" required autocomplete="off">
                        @error('telp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Password</label>
                        <div class="col-sm-9">
                        <input id="password" class="floating-input form-control @error('password') is-invalid @enderror" type="password" placeholder=" "  name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror</input>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Confirm Password</label>
                        <div class="col-sm-9">
                            <input id="password-confirm" class="floating-input form-control" type="password" placeholder=" " name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="">Roles</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="level" id="" required>
                                <option selected disabled value="">Pilih Roles</option>
                                @foreach($data as $item)
                                    <option value="{{$item->role}}">{{$item->role}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="form-group">
                            <button class="btn btn-primary">Simpan</button>
                            <button type="reset" onclick="history.go(-1)" class="btn btn-danger">Batal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
   </div>
@endsection
@push('script')
    <script src="{{asset('phppiechart/assets/js/highcharts.js')}}"></script>
    <script src="{{asset('assets/customjs/backend/konteks.js')}}"></script>
    <script src="{{asset('assets/customjs/backend/pemangku_kepentingan.js')}}"></script>
@endpush

 