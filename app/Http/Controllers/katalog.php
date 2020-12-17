<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\tbl_katalog;

class katalog extends Controller
{
  public function lihat(){
    $data=DB::table('tbl_katalog')->get();
    if (count($data)>0) {
      $res['message']='berhasil tampil';
      $res['value']=$data;
      return response($res);
    }
    else {
      $res['message']="data kosong";
      return response($res);
    }
  }

  public function masukkan(Request $request){
    $this->validate($request, [
      'file'=> 'required || max: 2048mb'
      ]);
      $file=$request->file('file');
      $nama=time().'_'.$file->getClientOriginalName();
      $tampung='data_file';

    if ($file->move($tampung,$nama)) {
      $data=tbl_katalog::create([
        'nama_produk'=>$request->nama_produk,
        'berat'=>$request->berat,
        'harga'=>$request->harga,
        'gambar'=>$nama,
        'keterangan'=>$request->keterangan
      ]);
      $res['message']='berhsil menambahkan';
      $res['value']=$data;
      return response($res);
    }
    else {
      $res['message']="gagal menyimpan data";
      return response($res);
    }
  }

  public function perbarui(Request $request){
    if (!empty($request->file)) {
      $this->validate($request,[
        'file'=> 'required | max:2048mb'
      ]);
      $file=$request->file('file');
      $nama=time().'_'.$file->getClientOriginalName();
      $tampung='data_file';

      $file->move($tampung,$nama);
      $data=DB::table('tbl_katalog')->where('id',$request->id)->get();
      foreach ($data as $katalog) {
        @unlink(public_path('data_file/'.$katalog->gambar));
        $ket=DB::table('tbl_katalog')->where('id',$request->id)->update([
          'nama_produk'=>$request->nama_produk,
          'berat'=>$request->berat,
          'harga'=>$request->harga,
          'gambar'=>$nama,
          'keterangan'=>$request->keterangan
        ]);
        $res['message']='berhasil update dengan gambar';
        $res['value']=$ket;
        return response($res);
      }
    }
    else {
      $data=DB::table('tbl_katalog')->where('id',$request->id)->get();
      foreach ($data as $katalog) {
        $ket=DB::table('tbl_katalog')->where('id',$request->id)->update([
          'nama_produk'=>$request->nama_produk,
          'berat'=>$request->berat,
          'harga'=>$request->harga,

          'keterangan'=>$request->keterangan
        ]);
        $res['message']='berhasil update tanpa gambar';
        $res['value']=$ket;
        return response($res);
      }
    }
  }

  public function hapus($id){
    $data=DB::table('tbl_katalog')->where('id',$id)->get();
    foreach ($data as $katalog) {
      if (file_exists(public_path('data_file/'.$katalog->gambar))) {
        @unlink(public_path('data_file/'.$katalog->gambar));
        DB::table('tbl_katalog')->where('id',$id)->delete();
        $res['message']='berhasil hapus';
        return response($res);
      }
      else {
        DB::table('tbl_katalog')->where('id',$id)->delete();
        $res['message']='hapus tanpa gambar';
        return response($res);
      }
    }
  }

}
