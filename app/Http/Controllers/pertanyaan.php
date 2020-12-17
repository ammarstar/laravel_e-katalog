<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\tbl_pertanyaan;

class pertanyaan extends Controller
{
    public function ambil_pertanyaan(){
      $data=DB::table('tbl_pertanyaan')->get();
      $res['message']="melihat data";
      $res['value']=$data;
      return response($res);
    }
    public function masukkan_pertanyaan(Request $request){
      $data=tbl_pertanyaan::create([
        'pertanyaan'=>$request->pertanyaan,
        'jawaban'=>'null'
      ]);
      $res['message']='berhasil upload pertanyaan';
      $res['value']=$data;
      return response($res);
    }
    public function masukkan_jawaban(Request $request){
      $data=DB::table('tbl_pertanyaan')->where('id',$request->id)->update([
        'jawaban'=>$request->jawaban
      ]);
      $res['message']='berhasil upload jawaban';
      $res['value']=$data;
      return response($res);
    }
}
