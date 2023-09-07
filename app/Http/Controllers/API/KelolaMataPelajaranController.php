<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;

class KelolaMataPelajaranController extends Controller
{
    public function index(Request $request){
        $mapel = MataPelajaran::all();
        if (!$mapel){
            return response()->json(['message'=>'Data Kosong'], 200);
        }
        return response()->json($mapel, 200);
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
            'nama_mata_pelajaran' => $request->nama_mata_pelajaran
        ];

        MataPelajaran::create($data);

        return response()->json(['message' => 'Mata Pelajaran berhasil ditambah'], 200);
    }
    public function edit(Request $request, $id){
        $getMapel = MataPelajaran::where('id', $id)->first();
        if(!$getMapel){
            return response()->json(['message' => 'Kelas Tidak ada'], 201);
        }
        $data = [
            'nama_mata_pelajaran' => $request->nama_mata_pelajaran
        ];
        
        MataPelajaran::where('id', $id)->update($data);
        return response()->json(['message' => 'Mata Pelajaran berhasil diedit'],200);
    }
    
    public function byid(Request $request, $id){
        $getMapel = MataPelajaran::where('id', $id)->first();
        $success = [
            'message' => 'Berhasil mendapatkan id',
            'data' => $getMapel
        ];
        return response()->json($success, 200);
    }

    public function destroy(Request $request, $id){
        $mapelid = MataPelajaran::where('id', $id)->delete();
        if (!$mapelid){
            return response()->json(['message' => 'Kelas Tidak ada'], 201);
        }
        $success = [
            'message' => 'Mata Pelajaran  Berhasil dihapus'
        ];
        
        return response()->json($success, 200);
    }
}
