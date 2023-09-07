<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KelasMataPelajarans;

class KelasMataPelajaran extends Controller
{
    public function index(Request $request){
        $data = KelasMataPelajarans::with('kelas')->with('mapel')->get();
        if (!$data){
            return response()->json(['message'=>'Data Kosong'], 200);
        }
        return response()->json($data, 200);
    }
    public function create(Request $request){
        // $request->validate([
        //     'nisn' => 'required',
        //     'nama' => 'required',
        // ]);
        // if (!$request->nama){
        //     return response()->json(['message' => 'nama harus di isi']);
        // }
        $cek = KelasMataPelajarans::where('kelas_id', $request->kelas_id)->where('mapel_id', $request->mapel_id)->first();
        if ($cek) return response()->json(['message'=>'pertemuan Sudah Ada']);
        $data = [
            'kelas_id' => $request->kelas_id,
            'mapel_id' => $request->mapel_id
        ];

        KelasMataPelajarans::create($data);

        return response()->json(['message' => 'Kelas matapelajaran berhasil ditambah'], 200);
    }
    public function edit(Request $request, $id){
        $getKelasPelajaran = KelasMataPelajarans::where('id', $id)->first();
        if(!$getKelasPelajaran){
            return response()->json(['message' => 'Kelas matapelajaran Tidak ada'], 201);
        }
        $data = [
            'kelas_id' => $request->kelas_id,
            'mapel_id' => $request->mapel_id
        ];
        
        KelasMataPelajarans::where('id', $id)->update($data);
        return response()->json(['message' => 'Kelas matapelajaran berhasil diedit'],200);
    }
    
    public function byid(Request $request, $id){
        $getKelasPelajaran = KelasMataPelajarans::where('id', $id)->first();
        $success = [
            'message' => 'Berhasil mendapatkan id',
            'data' => $getKelasPelajaran
        ];
        return response()->json($success, 200);
    }

    public function destroy(Request $request, $id){
        $getKelasPelajaran = KelasMataPelajarans::where('id', $id)->delete();
        if (!$getKelasPelajaran){
            return response()->json(['message' => 'Kelas matapelajaran Tidak ada'], 201);
        }
        $success = [
            'message' => 'Kelas matapelajaran Berhasil dihapus'
        ];
        
        return response()->json($success, 200);
    }
    public function getbyid(Request $request) {
        $data = KelasMataPelajarans::where('kelas_id', $request->kelas_id)->with('kelas')->with('mapel')->get();
        return response()->json($data, 200);
    }
}

