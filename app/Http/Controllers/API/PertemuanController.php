<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pertemuan;

class PertemuanController extends Controller
{
    public function index(Request $request){
        $data = Pertemuan::with('kelas')->with('mapel')->get();
        if (!$data) return response()->json(['Pertemuan Kosong'], 401);
        return response()->json($data,200);
    }
    public function create(Request $request){
        // $cek = Pertemuan::where('pertemuan_ke' , $request->pertemuan_ke)->first();
        $cek = Pertemuan::where('kelas_id', $request->kelas_id)->where('mapel_id', $request->mapel_id)->where('pertemuan_ke' , $request->pertemuan_ke)->first();
        if ($cek) return response()->json(['message'=>'pertemuan Sudah Ada']);
        $data = [
            'kelas_id' => $request->kelas_id,
            'mapel_id' => $request->mapel_id,
            'pertemuan_ke' => $request->pertemuan_ke,
            'judul_pertemuan' => $request->judul_pertemuan,
            'tgl_pertemuan' => $request->tgl_pertemuan,
            'title_pertemuan' => $request->title_pertemuan
        ];

        Pertemuan::create($data);
        return response()->json(['message'=>'pertemuan Berhasil dibuat'], 201);
    }
    public function destroy(Request $request, $id){
        $mapelid = Pertemuan::where('id', $id)->delete();
        if (!$mapelid){
            return response()->json(['message' => 'Pertemuan Tidak ada'], 201);
        }

        return response()->json(['message' => 'Pertemuan Berhasil dihapus'], 200);
    }
    
    public function filterbykelas(Request $request){
        if (!$request->idmapel){
            $data = Pertemuan::where('kelas_id' , $request->idkelas)->with('kelas')->with('mapel')->get();
            return response()->json($data, 200);
        } else if(!$request->idkelas){
            $data = Pertemuan::where('mapel_id', $request->idmapel)->with('kelas')->with('mapel')->get();
            return response()->json($data, 200);
        }
            $data = Pertemuan::where('kelas_id' , $request->idkelas)->where('mapel_id', $request->idmapel)->with('kelas')->with('mapel')->get(); 
            return response()->json($data, 200);
        
    }
    public function getpertemuanbymapel(Request $request, $id){
        $data =  Pertemuan::where('kelas_id', $request->kelas_id)->where('mapel_id', $id)->with('kelas')->with('mapel')->with('tugas')->with('materi')->get();
        return response()->json($data, 200);
    }
    public function addpertemuanbymapel(Request $request, $id){
        $cek = Pertemuan::where('kelas_id', $request->kelas_id)->where('mapel_id', $id)->where('pertemuan_ke' , $request->pertemuan_ke)->first();
        if ($cek) return response()->json(['message'=>'pertemuan Sudah Ada']);
        $data = [
            'kelas_id' => $request->kelas_id,
            'mapel_id' => $id,
            'pertemuan_ke' => $request->pertemuan_ke,
            'judul_pertemuan' => $request->judul_pertemuan,
            'tgl_pertemuan' => $request->tgl_pertemuan,
            'title_pertemuan' => $request->title_pertemuan
        ];
        Pertemuan::create($data);
        return response()->json(['message'=>'pertemuan Berhasil dibuat'], 200);
    }
    public function getidpertemuanbymapeldankelas(Request $request, $id, $pertemuan){
        $cek = Pertemuan::where('kelas_id', $request->kelas_id)->where('mapel_id', $id)->where('pertemuan_ke' , $pertemuan)->first();
        $data = [
            'message' => 'id pertemuan',
            'data_id_pertemuan' => $cek->id
        ];
        return response()->json($data, 200);
    }
}
