@extends('layouts.base')
@section('title')
ARMS | Dashboard
@endsection
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
    .center {
  margin: auto;
  width: 50%;
  border: 3px solid red;
  padding: 10px;
}
</style>
@endsection
@section('content')
@php
    // $this->data['pengendalian_risiko'] = \DB::table('pengendalian_risiko')->where('status_pelaksanaan', ?'like', 'Selesai Dilaksanakan%')->whereDate('target_waktu_akhir', '>', Carbon::now())->count();
    use Carbon\Carbon;
    $tgl = Carbon::now();
    $now = $tgl->format('Y-m-d');
    $id_pengendalian = [];
    $data = DB::table('pengendalian_risiko')->where('status_pelaksanaan','Selesai Dilaksanakan')->get();
    if(count($data)>0){
        foreach ($data as $row) {
            array_push($id_pengendalian,$row->id);
        }
    }
    $update_status = DB::table('pengendalian_risiko')->whereNotIn('id',$id_pengendalian)->whereDate('target_waktu_akhir', '<', $now)->update([
        'status_pelaksanaan'=>'Terlambat',
    ]);
    // dd($update_status);

    // =====================================================================================================
    // function getBrowser() { 
        // $u_agent = $_SERVER['HTTP_USER_AGENT'];
        // $bname = 'Unknown';
        // $platform = 'Unknown';
        // $version= "";

        // //First get the platform?
        // if (preg_match('/linux/i', $u_agent)) {
        //     $platform = 'linux';
        // }elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        //     $platform = 'mac';
        // }elseif (preg_match('/windows|win32/i', $u_agent)) {
        //     $platform = 'windows';
        // }

        // // Next get the name of the useragent yes seperately and for good reason
        // if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)){
        //     $bname = 'Internet Explorer';
        //     $ub = "MSIE";
        // }elseif(preg_match('/Firefox/i',$u_agent)){
        //     $bname = 'Mozilla Firefox';
        //     $ub = "Firefox";
        // }elseif(preg_match('/OPR/i',$u_agent)){
        //     $bname = 'Opera';
        //     $ub = "Opera";
        // }elseif(preg_match('/Chrome/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
        //     $bname = 'Google Chrome';
        //     $ub = "Chrome";
        // }elseif(preg_match('/Safari/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
        //     $bname = 'Apple Safari';
        //     $ub = "Safari";
        // }elseif(preg_match('/Netscape/i',$u_agent)){
        //     $bname = 'Netscape';
        //     $ub = "Netscape";
        // }elseif(preg_match('/Edge/i',$u_agent)){
        //     $bname = 'Edge';
        //     $ub = "Edge";
        // }elseif(preg_match('/Trident/i',$u_agent)){
        //     $bname = 'Internet Explorer';
        //     $ub = "MSIE";
        // }

        // // finally get the correct version number
        // $known = array('Version', $ub, 'other');
        // $pattern = '#(?<browser>' . join('|', $known) .
        // ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        // if (!preg_match_all($pattern, $u_agent, $matches)) {
        //     // we have no matching number just continue
        // }
        // see how many we have
        // $i = count($matches['browser']);
        // if ($i != 1) {
        //     //we will have two since we are not using 'other' argument yet
        //     //see if version is before or after the name
        //     if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
        //         $version= $matches['version'][0];
        //     }else {
        //         $version= $matches['version'][1];
        //     }
        // }else {
        //     $version= $matches['version'][0];
        // }

        // check if we have a number
        // if ($version==null || $version=="") {$version="?";}

        // return array(
        //     'userAgent' => $u_agent,
        //     'name'      => $bname,
        //     'version'   => $version,
        //     'platform'  => $platform,
        //     'pattern'    => $pattern
        // );
        // } 

        // $ua=getBrowser();
        // $yourbrowser= "Your browser: " . $ua['name'] . " " . $ua['version'] . " on " .$ua['platform'] . " reports: <br >" . $ua['userAgent'];
        // print_r($yourbrowser);

        // now try it
        // $ua=getBrowser();
        // $yourbrowser= $ua['name'] . " ";
        // print_r($yourbrowser);
    // =====================================================================================================

@endphp
<div class="col-lg-12">
    {{-- <div class="center">
        <h3 class="text-center">User Log Activity</h3>
        <div class="row">
            <div class="col-md-3">
                <p class="mb-0">User ID</p>
                <p class="mb-0">User IP</p>
                <p class="mb-0">Waktu</p>
                <p class="mb-0">Browser</p>
                <p class="mb-0">Aktivitas</p>
            </div>
            <div class="col-md-9">
                <p class="mb-0">: {{Auth::user()->id}}</p>
                <p class="mb-0">: {{$user}}</p>
                <p class="mb-0">: {{$waktu}}</p>
                <p class="mb-0">: {{$yourbrowser}}</p>
                <p class="mb-0">: Log-in</p>
            </div>
        </div>
    </div> --}}
    <div class="card card-transparent card-block card-stretch card-height border-none">
        <div class="card-header p-0 mt-lg-2 mt-0">
            <h3 class="mb-3">Dashboard Pengawasan</h3>
            <form method="get">
                <div class="row">
                    <div class="col-md-4">
                        <label class="m-0">Unit Pemilik Risiko</label>
                        <div class="input-group mb-3">
                            <select class="form-control" name="departemen" id="departemen">
                                <option value="semua">Semua Unit Kerja</option>
                                @foreach($data_departemen as $row_departemen)
                                <option value="{{$row_departemen->id}}" @if(request()->get('departemen')) @if(request()->get('departemen')==$row_departemen->id) selected @endif @endif>{{$row_departemen->nama}}</option>
                                @endforeach
                            </select>
                            <div class="input-group-prepend" style="border-radius:10p;">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                <a href="{{url('/dashboard')}}" class="btn btn-primary"
                                    style="border-top-right-radius: 10px;border-bottom-right-radius: 10px;"><i
                                        class="fas fa-sync"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <hr>
        <div class="card-body p-0 mt-lg-2 mt-0">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Risiko</h4>
                            <div class="row">
                                <div class="col-md-6 text-center">
                                    <h2>{{$populasi_risiko}}</h2>
                                    <p class="mb-2">Teridentifikasi</p>
                                </div>
                                <div class="col-md-6 text-center">
                                    <h3>{{$risiko_termitigasi}}</h3>
                                    <p class="mb-2">Termitigasi</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Penyebab</h4>
                            <div class="row">
                                <div class="col-md-6 text-center">
                                    <h3>{{$penyebab_teridentifikasi}}</h3>
                                    <p class="mb-2">Teridentifikasi</p>
                                </div>
                                <div class="col-md-6 text-center">
                                    <h3>{{$penyebab_termitigasi}}</h3>
                                    <p class="mb-2">Termitigasi</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Rencana Tindak Pengendalian</h4>
                            <div class="row">
                                <div class="col-md-6 text-center">
                                    <h3>{{$pengendalian_risiko}}</h3>
                                    <p class="mb-2">Terjadwal</p>
                                </div>
                                <div class="col-md-6 text-center">
                                    <h3>{{$pengendalian_risiko_termitigasi}}</h3>
                                    <p class="mb-2">Terealisasi</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Peristiwa Risiko</h4>
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <h3>{{$kejadian_peristiwa_risiko}}</h3>
                                    <p class="mb-2">Kejadian</p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <h3>{{count($risiko_peristiwa_risiko)}}</h3>
                                    <p class="mb-2">Risiko</p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <h3>{{count($penyebab_peristiwa_risiko)}}</h3>
                                    <p class="mb-2">Penyebab</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
$(function() {
    flatpickr("#tanggal", {
        enableTime: false,
        dateFormat: "d-m-Y",
        mode: "range"
    });
});
</script>
@endpush
