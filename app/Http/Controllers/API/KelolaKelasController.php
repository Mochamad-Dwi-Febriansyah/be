<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Siswa;

class KelolaKelasController extends Controller
{
    public function getkelasfirst(Request $request){
        $kelas = Kelas::first();
        if (!$kelas){
            return response()->json(['message'=>'Data Kosong'], 200);
        }
        return response()->json($kelas, 200);
    }
    public function index(Request $request){
        $kelas = Kelas::all();
        if (!$kelas){
            return response()->json(['message'=>'Data Kosong'], 200);
        }
        return response()->json($kelas, 200);
    }
    public function create(Request $request){
        // $request->validate([
        //     'nisn' => 'required',
        //     'nama' => 'required',
        // ]);
        // if (!$request->nama){
        //     return response()->json(['message' => 'nama harus di isi']);
        // }
        $data = [
            'nama_kelas' => $request->nama_kelas,
            'jumlah_siswa' => $request->jumlah_siswa
        ];

        Kelas::create($data);

        return response()->json(['message' => 'Kelas berhasil ditambah'], 200);
    }
    public function edit(Request $request, $id){
        $getKelas = Kelas::where('id', $id)->first();
        if(!$getKelas){
            return response()->json(['message' => 'Kelas Tidak ada'], 201);
        }
        $data = [
            'nama_kelas' => $request->nama_kelas,
            'jumlah_siswa' => $request->jumlah_siswa 
        ];
        
        Kelas::where('id', $id)->update($data);
        return response()->json(['message' => 'Kelas berhasil diedit'],200);
    }
    
    public function byid(Request $request, $id){
        $getKelas = Kelas::where('id', $id)->first();
        $success = [
            'message' => 'Berhasil mendapatkan id',
            'data' => $getKelas
        ];
        return response()->json($success, 200);
    }

    public function destroy(Request $request, $id){
        $kelasid = Kelas::where('id', $id)->delete();
        if (!$kelasid){
            return response()->json(['message' => 'Kelas Tidak ada'], 201);
        }
        $success = [
            'message' => 'Kelas  Berhasil dihapus'
        ];
        
        return response()->json($success, 200);
    }

    public function getuserbykelasid (Request $request, $id){
        $datauser = Siswa::where('kelas_id', $id)->get();
        return response()->json($datauser, 200);
    } 
}
