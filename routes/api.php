<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\KelolaUserController;
use App\Http\Controllers\API\KelolaMataPelajaranController;
use App\Http\Controllers\API\KelolaKelasController;
use App\Http\Controllers\API\PertemuanController;
use App\Http\Controllers\API\KelasMataPelajaran;
use App\Http\Controllers\API\TugasController;
use App\Http\Controllers\API\MateriController;
use App\Http\Controllers\API\BeritaController;
use App\Http\Controllers\API\PengumpulanTugasController;
use App\Http\Controllers\API\MarkAsDoneController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/detail', [AuthController::class, 'detail']);


Route::group(['middleware' => 'check_token'], function(){
    Route::get('/datame' ,[AuthController::class , 'datame']);
    Route::group(['prefix' => '/kelolauser'], function () {
        Route::get('/', [KelolaUserController::class , 'index']);
        Route::post('/tambah', [KelolaUserController::class , 'create']);
        Route::get('/{id}', [KelolaUserController::class, 'byid']);
        Route::put('/edit/{id}', [KelolaUserController::class , 'edit']);
        Route::delete('/{id}', [KelolaUserController::class , 'destroy']);
    });
    Route::group(['prefix' => '/kelolaberita'], function () {
        Route::get('/', [BeritaController::class , 'index']);
        Route::post('/tambah', [BeritaController::class , 'create']);
        Route::get('/{id}', [BeritaController::class, 'byid']);
        Route::put('/edit/{id}', [BeritaController::class , 'edit']);
        Route::delete('/{id}', [BeritaController::class , 'destroy']);
    });
    Route::group(['prefix' => '/kelolakelas'], function () {
        Route::get('/', [KelolaKelasController::class , 'index']);
        Route::get('/first', [KelolaKelasController::class , 'getkelasfirst']);
        Route::post('/tambah', [KelolaKelasController::class , 'create']);
        Route::get('/{id}', [KelolaKelasController::class, 'byid']);
        Route::put('/edit/{id}', [KelolaKelasController::class , 'edit']);
        Route::delete('/{id}', [KelolaKelasController::class , 'destroy']);
        
        
        Route::get('/{id}/kelolauser', [KelolaKelasController::class , 'getuserbykelasid']);
    });
    Route::group(['prefix' => '/kelolamapel'], function () {
        Route::get('/', [KelolaMataPelajaranController::class , 'index']);
        Route::post('/tambah', [KelolaMataPelajaranController::class , 'create']);
        Route::get('/{id}', [KelolaMataPelajaranController::class, 'byid']);
        Route::put('/edit/{id}', [KelolaMataPelajaranController::class , 'edit']);
        Route::delete('/{id}', [KelolaMataPelajaranController::class , 'destroy']);
    });
    Route::group(['prefix' => '/kelolakelasmapel'], function () {
        Route::get('/', [KelasMataPelajaran::class , 'index']);
        Route::post('/', [KelasMataPelajaran::class , 'getbyid']);
        Route::post('/tambah', [KelasMataPelajaran::class , 'create']);
        Route::get('/{id}', [KelasMataPelajaran::class, 'byid']);
        Route::put('/edit/{id}', [KelasMataPelajaran::class , 'edit']);
        Route::delete('/{id}', [KelasMataPelajaran::class , 'destroy']);
    });
    Route::group(['prefix' => '/pertemuan'], function () {
       Route::get('/', [PertemuanController::class, 'index']);
       Route::post('/tambah', [PertemuanController::class, 'create']);
       Route::delete('/{id}', [PertemuanController::class, 'destroy']);
       
       Route::post('/', [PertemuanController::class, 'filterbykelas']);
       Route::post('/mapel/{id}', [PertemuanController::class, 'getpertemuanbymapel']);
       Route::post('/mapel/{id}/tambah', [PertemuanController::class, 'addpertemuanbymapel']);
       
       Route::post('/mapel/{id}/pertemuan/{pertemuan}', [PertemuanController::class, 'getidpertemuanbymapeldankelas']);
    });

    Route::group(['prefix' => '/tugas'], function () {
        Route::get('/', [TugasController::class, 'index']);
        Route::post('/', [TugasController::class, 'create']);
        Route::post('/mapel/{id}', [TugasController::class, 'gettugasbymapelasli']);
        Route::post('/mapel/{id}/pertemuan/{pertemuan}', [TugasController::class, 'gettugasbymapel']);
        Route::post('/mapel/{id}/pertemuan/{pertemuan}/tugas/{tugas}', [TugasController::class, 'gettugasbytugas']);
    }); 
    Route::group(['prefix' => '/materi'], function () {
        Route::get('/', [MateriController::class, 'index']);
        Route::post('/', [MateriController::class, 'create']); 
    }); 



    Route::group(['prefix' => '/pengumpulan_tugas'], function () {
        Route::post('/', [PengumpulanTugasController::class, 'index']);
        Route::post('/upload', [PengumpulanTugasController::class, 'create']);
        
        Route::post('/getalltugas', [PengumpulanTugasController::class, 'getalltugas']);
        Route::put('/edit/{id}', [PengumpulanTugasController::class, 'editnilaiuploadtugas']);
        
        Route::delete('/{id}', [PengumpulanTugasController::class, 'destroy']);
        
        Route::get('/{id}', [PengumpulanTugasController::class, 'byid']);
        Route::put('/{id}', [PengumpulanTugasController::class, 'editfileuploadtugas']);
    });

    Route::group(['prefix' => '/markasdone'], function () {
        Route::post('/', [MarkAsDoneController::class, 'index']);
        Route::put('/upload', [MarkAsDoneController::class, 'create']);  
        Route::put('/{id}', [MarkAsDoneController::class, 'editfileuploadtugas']);
    });
    
});