<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tbl_user;
use Illuminate\Support\Facades\DB;

class user extends Controller
{
    public function tambah_akun(Request $request){
      $data=tbl_user::create([
        'name'=>$request->name,
        'username'=>$request->username,
        'password'=>$request->password
      ]);
      $res['meesage']='berhasl menambahkan user';
      $res['value']=$data;
      return response($res);
    }

    public function ubah_akun(Request $request){
      $data=DB::table('tbl_user')->where('id',$request->id)->update([
        'name'=>$request->name,
        'username'=>$request->username,
        'password'=>$request->password
      ]);
      $res['meesage']='berhasl memperbarui user';
      $res['value']=$data;
      return response($res);
    }

    public function detail($username){
      $data=DB::table('tbl_user')->where('username',$username)->get();
      if (count($data)>0) {
        $res['mesage']='success';
        $res['value']=$data;
        return response($res);
      }
      else {
        $res['mesage']='gagal';
        return response($res);
      }
    }
}
