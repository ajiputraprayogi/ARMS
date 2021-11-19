<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Captcha;
use DB;
use Carbon\Carbon;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function logout(Request $request) {
        function getBrowser() { 
            $u_agent = $_SERVER['HTTP_USER_AGENT'];
            $bname = 'Unknown';
            $platform = 'Unknown';
            $version= "";
    
            //First get the platform?
            if (preg_match('/linux/i', $u_agent)) {
                $platform = 'linux';
            }elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
                $platform = 'mac';
            }elseif (preg_match('/windows|win32/i', $u_agent)) {
                $platform = 'windows';
            }
    
            // Next get the name of the useragent yes seperately and for good reason
            if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)){
                $bname = 'Internet Explorer';
                $ub = "MSIE";
            }elseif(preg_match('/Firefox/i',$u_agent)){
                $bname = 'Mozilla Firefox';
                $ub = "Firefox";
            }elseif(preg_match('/OPR/i',$u_agent)){
                $bname = 'Opera';
                $ub = "Opera";
            }elseif(preg_match('/Chrome/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
                $bname = 'Google Chrome';
                $ub = "Chrome";
            }elseif(preg_match('/Safari/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
                $bname = 'Apple Safari';
                $ub = "Safari";
            }elseif(preg_match('/Netscape/i',$u_agent)){
                $bname = 'Netscape';
                $ub = "Netscape";
            }elseif(preg_match('/Edge/i',$u_agent)){
                $bname = 'Edge';
                $ub = "Edge";
            }elseif(preg_match('/Trident/i',$u_agent)){
                $bname = 'Internet Explorer';
                $ub = "MSIE";
            }
    
            // finally get the correct version number
            $known = array('Version', $ub, 'other');
            $pattern = '#(?<browser>' . join('|', $known) .
            ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
            if (!preg_match_all($pattern, $u_agent, $matches)) {
                // we have no matching number just continue
            }
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
            if ($version==null || $version=="") {$version="?";}
    
            return array(
                'userAgent' => $u_agent,
                'name'      => $bname,
                'version'   => $version,
                'platform'  => $platform,
                'pattern'    => $pattern
            );
            } 
    
            // $ua=getBrowser();
            // $yourbrowser= "Your browser: " . $ua['name'] . " " . $ua['version'] . " on " .$ua['platform'] . " reports: <br >" . $ua['userAgent'];
            // print_r($yourbrowser);
    
            // now try it
            $ua=getBrowser();
            $yourbrowser= $ua['name'] . " ";
            // print_r($yourbrowser);
            $ip = $request->getClientIp();
            $waktu = Carbon::now();
        DB::table('user_log_activity')->insert([
            'user_id'=>Auth::user()->id,
            'activity'=>'log-out',
            'waktu'=>$waktu,
            'ip_address'=>$ip,
            'browser_information'=>$yourbrowser,
        ]);
        Auth::logout();
        return redirect('/login');
    }

    public function reloadCaptcha() {
        return response()->json(['captcha'=> captcha_img()]);
    }
    
    protected function authenticated(Request $request, $user){
        function getBrowser() { 
            $u_agent = $_SERVER['HTTP_USER_AGENT'];
            $bname = 'Unknown';
            $platform = 'Unknown';
            $version= "";
    
            //First get the platform?
            if (preg_match('/linux/i', $u_agent)) {
                $platform = 'linux';
            }elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
                $platform = 'mac';
            }elseif (preg_match('/windows|win32/i', $u_agent)) {
                $platform = 'windows';
            }
    
            // Next get the name of the useragent yes seperately and for good reason
            if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)){
                $bname = 'Internet Explorer';
                $ub = "MSIE";
            }elseif(preg_match('/Firefox/i',$u_agent)){
                $bname = 'Mozilla Firefox';
                $ub = "Firefox";
            }elseif(preg_match('/OPR/i',$u_agent)){
                $bname = 'Opera';
                $ub = "Opera";
            }elseif(preg_match('/Chrome/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
                $bname = 'Google Chrome';
                $ub = "Chrome";
            }elseif(preg_match('/Safari/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
                $bname = 'Apple Safari';
                $ub = "Safari";
            }elseif(preg_match('/Netscape/i',$u_agent)){
                $bname = 'Netscape';
                $ub = "Netscape";
            }elseif(preg_match('/Edge/i',$u_agent)){
                $bname = 'Edge';
                $ub = "Edge";
            }elseif(preg_match('/Trident/i',$u_agent)){
                $bname = 'Internet Explorer';
                $ub = "MSIE";
            }
    
            // finally get the correct version number
            $known = array('Version', $ub, 'other');
            $pattern = '#(?<browser>' . join('|', $known) .
            ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
            if (!preg_match_all($pattern, $u_agent, $matches)) {
                // we have no matching number just continue
            }
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
            if ($version==null || $version=="") {$version="?";}
    
            return array(
                'userAgent' => $u_agent,
                'name'      => $bname,
                'version'   => $version,
                'platform'  => $platform,
                'pattern'    => $pattern
            );
            } 
    
            // $ua=getBrowser();
            // $yourbrowser= "Your browser: " . $ua['name'] . " " . $ua['version'] . " on " .$ua['platform'] . " reports: <br >" . $ua['userAgent'];
            // print_r($yourbrowser);
    
            // now try it
            $ua=getBrowser();
            $yourbrowser= $ua['name'] . " ";
            // print_r($yourbrowser);
            $ip = $request->getClientIp();
            $waktu = Carbon::now();
        DB::table('user_log_activity')->insert([
            'user_id'=>Auth::user()->id,
            'activity'=>'log-in',
            'waktu'=>$waktu,
            'ip_address'=>$ip,
            'browser_information'=>$yourbrowser,
        ]);
        
    }
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
        $this->username() => 'required|string',
        'password' => 'required|string',
        'captcha' => 'required|captcha',
        ]);
    }
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }
}
