<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PengumpulanTugas;
use Illuminate\Http\Request;
use App\Models\Tugas;
use App\Models\Siswa;
use App\Models\Pertemuan;

class TugasController extends Controller
{
    public function index(Request $request) {
        $data = Tugas::all();
        return response()->json($data, 200);
    }
    public function create(Request $request) {
        $file = $request->file('file_tugas');
        // $filename = $file->hasName();
        $filename = $file->getClientOriginalName();
        $location = 'uploads';
        $file->move($location,$filename);
        $filepath = url('uploads/'.$filename); 
        $data = [
            'pertemuan_id' => $request->pertemuan_id,
            'judul_tugas' => $request->judul_tugas,
            'tugas_open' => $request->tugas_open,
            'tugas_closed' => $request->tugas_closed,
            'deskripsi_tugas' => $request->deskripsi_tugas,
            'file_tugas' => $filepath
        ];

        // query create tugas
        $oke = Tugas::create($data);
        
        // query update tugas di pertemuan
        $cek = Pertemuan::where('id', $oke->pertemuan_id)->first();
        // $siswa = Siswa::where('kelas_id', $cek->kelas_id)->get();
        // PengumpulanTugas::create($datasiswa)
        // return response()->json($siswa);
        if ($cek->tugas_1 == null) {
            $data = ['tugas_1' => $oke->id ];
            Pertemuan::where('id', $oke->pertemuan_id)->update($data);
            return response()->json(['message'=> 'tugas 1 berhasil dibuat'], 200);
            return false;
        } else if($cek->tugas_2 == null){
            $data = ['tugas_2' => $oke->id];
            Pertemuan::where('id', $oke->pertemuan_id)->update($data);
            return response()->json(['message'=> 'tugas 2 berhasil dibuat'], 200);
            return false;
        }  else if($cek->tugas_3 == null){
            $data = ['tugas_3' => $oke->id];
            Pertemuan::where('id', $oke->pertemuan_id)->update($data);
            return response()->json(['message'=> 'tugas 3 berhasil dibuat'], 200);
            return false;
        } else if($cek->tugas_4 == null){
            $data = ['tugas_4' => $oke->id];
            Pertemuan::where('id', $oke->pertemuan_id)->update($data);
            return response()->json(['message'=> 'tugas 4 berhasil dibuat'], 200);
            return false;
        }  else if($cek->tugas_5 == null){
            $data = ['tugas_5' => $oke->id];
            Pertemuan::where('id', $oke->pertemuan_id)->update($data);
            return response()->json(['message'=> 'tugas 5 berhasil dibuat'], 200);
            return false;
        }
        // return response()->json($cek, 200);
    }
    public function gettugasbymapel(Request $request, $id, $pertemuan){
        $getpertemuan = Pertemuan::where('kelas_id',$request->kelas_id)->where('mapel_id', $id)->where('pertemuan_ke', $pertemuan)->first();
        $data =  Tugas::where('pertemuan_id',$getpertemuan->id)->get();
        return response()->json($data, 200);
    }
    public function gettugasbytugas(Request $request, $id, $pertemuan, $tugas){
        $getpertemuan = Pertemuan::where('kelas_id',$request->kelas_id)->where('mapel_id', $id)->where('pertemuan_ke', $pertemuan)->first();
        $data =  Tugas::where('id', $tugas)->where('pertemuan_id',$getpertemuan->id)->first();
        return response()->json($data, 200);
    }
    public function gettugasbymapelasli(Request $request, $id){
        $getpertemuan = Pertemuan::where('kelas_id',$request->kelas_id)->where('mapel_id', $id)->first();
        $data =  Tugas::where('pertemuan_id',$getpertemuan->id)->get();
        return response()->json($data, 200);
    }
}
