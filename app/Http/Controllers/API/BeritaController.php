<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;

class BeritaController extends Controller
{
    public function index(Request $request){
        $berita = Berita::get();

        return response()->json($berita, 200);
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
            'judul_berita' => $request->judul_berita,
            'isi_berita' => $request->isi_berita
        ];

        Berita::create($data);

        return response()->json(['message' => 'Data berhasil ditambah'], 200);
    }
    public function edit(Request $request, $id){
        $getberita = Berita::where('id', $id)->first();
        if(!$getberita){
            return response()->json(['message' => 'Berita Tidak ada'], 201);
        }
        $data = [
            'judul_berita' => $request->judul_berita,
            'isi_berita' => $request->isi_berita
        ];
        
        Berita::where('id', $id)->update($data);
        return response()->json(['message' => 'Data berhasil diedit'],200);
    }
    
    public function byid(Request $request, $id){
        $getberita = Berita::where('id', $id)->with('kelas')->first();
        $success = [
            'message' => 'Berhasil mendapatkan id',
            'data' => $getberita
        ];
        return response()->json($success, 200);
    }

    public function destroy(Request $request, $id){
        $beritaid = Berita::where('id', $id)->delete();
        if (!$beritaid){
            return response()->json(['message' => 'Berita Tidak ada'], 201);
        }
        $success = [
            'message' => 'Berita  Berhasil dihapus'
        ];
        
        return response()->json($success, 200);
    }
}
