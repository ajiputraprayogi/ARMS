<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use DataTables;
use Hash;
use App\roles;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();
        return view('backend.user.index',['data'=>$data]);
    }

    public function listdata(){
        return Datatables::of(User::leftjoin('roles','roles.id','=','users.level')
                ->leftjoin('departemen','departemen.id','=','users.id_departemen')
                ->select('users.*','roles.role','departemen.nama')
                ->get())
                ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $data = roles::all();
        return view('backend.user.add_user',['data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'level' => ['required'],
            'telp' => ['required'],
            'username' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        User::insert([
            'username' => $request->username,
            'telp' => $request->telp,
            'level' => $request->level,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect('user')->with('status','Sukses menyimpan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::find($id);
        $unit_kerja = DB::table('departemen')->get();
        $roles = roles::all();
        return view('backend.user.edit_user',['data'=>$data,'roles'=>$roles,'unit_kerja'=>$unit_kerja]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'level' => ['required'],
            'telp' => ['required'],
            'username' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $password = $request->password;
        if($password==''){
            User::find($id)->update([
            'username' => $request->username,
            'telp' => $request->telp,
            'level' => $request->level,
            'id_departemen' => $request->unit_kerja,
            'name' => $request->name,
            'email' => $request->email,
            // 'password' => Hash::make($request->password),
            ]);
        }else{
            User::find($id)->update([
            'username' => $request->username,
            'telp' => $request->telp,
            'level' => $request->level,
            'id_departemen' => $request->unit_kerja,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        }
        return redirect('user')->with('status','Sukses mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
