<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;

class KelolaUserController extends Controller
{
    public function index(Request $request){
        $siswa = Siswa::with('kelas')->get();

        return response()->json($siswa, 200);
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
            'nisn' => $request->nisn,
            'nama' => $request->nama,
            'kelas_id' => $request->kelas_id
        ];

        Siswa::create($data);

        return response()->json(['message' => 'Data berhasil ditambah'], 200);
    }
    public function edit(Request $request, $id){
        $getsiswa = Siswa::where('id', $id)->first();
        if(!$getsiswa){
            return response()->json(['message' => 'User Tidak ada'], 201);
        }
        $data = [
            'nisn' => $request->nisn,
            'nama' => $request->nama,
            'kelas_id' => $request->kelas_id
        ];
        
        Siswa::where('id', $id)->update($data);
        return response()->json($request,200);
    }
    
    public function byid(Request $request, $id){
        $getsiswa = Siswa::where('id', $id)->with('kelas')->first();
        $success = [
            'message' => 'Berhasil mendapatkan id',
            'data' => $getsiswa
        ];
        return response()->json($success, 200);
    }

    public function destroy(Request $request, $id){
        $userid = Siswa::where('id', $id)->delete();
        if (!$userid){
            return response()->json(['message' => 'User Tidak ada'], 201);
        }
        $success = [
            'message' => 'user  Berhasil dihapus'
        ];
        
        return response()->json($success, 200);
    }
}
