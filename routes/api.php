<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/getData','katalog@lihat');
Route::post('/pushData','katalog@masukkan');
Route::post('/updateData','katalog@perbarui');
Route::get('/deleteData/{id}','katalog@hapus');

// controller pertanyaan
Route::get('/getPertanyaan','pertanyaan@ambil_pertanyaan');
Route::post('/pushPertanyaan','pertanyaan@masukkan_pertanyaan');
Route::post('/pushJawaban','pertanyaan@masukkan_jawaban');

// controller users
Route::post('/pushUser','user@tambah_akun');
Route::post('/pushUbah','user@ubah_akun');
Route::get('/detailUser/{username}','user@detail');
