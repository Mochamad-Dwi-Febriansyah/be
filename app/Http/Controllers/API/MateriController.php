<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Materi;
use App\Models\Pertemuan;

class MateriController extends Controller
{
    public function index(Request $request) {
        $data = Materi::all();
        return response()->json($data, 200);
    }
    public function create(Request $request) {
        $file = $request->file('file_materi');
        // $filename = $file->hasName();
        $filename = $file->getClientOriginalName();
        $location = 'uploads/materi';
        $file->move($location,$filename);
        $filepath = url('uploads/materi/'.$filename); 
        $data = [
            'pertemuan_id' => $request->pertemuan_id,
            'judul_materi' => $request->judul_materi, 
            'file_materi' => $filepath
        ];

        // query create tugas
        $oke = Materi::create($data);
        
        // query update tugas di pertemuan
        $cek = Pertemuan::where('id', $oke->pertemuan_id)->first();
        // $siswa = Siswa::where('kelas_id', $cek->kelas_id)->get();
        // PengumpulanTugas::create($datasiswa)
        // return response()->json($siswa);
        if ($cek->materi_1 == null) {
            $data = ['materi_1' => $oke->id ];
            Pertemuan::where('id', $oke->pertemuan_id)->update($data);
            return response()->json(['message'=> 'materi 1 berhasil dibuat'], 200);
            return false;
        } else if($cek->materi_2 == null){
            $data = ['materi_2' => $oke->id];
            Pertemuan::where('id', $oke->pertemuan_id)->update($data);
            return response()->json(['message'=> 'materi 2 berhasil dibuat'], 200);
            return false;
        }  else if($cek->materi_3 == null){
            $data = ['materi_3' => $oke->id];
            Pertemuan::where('id', $oke->pertemuan_id)->update($data);
            return response()->json(['message'=> 'materi 3 berhasil dibuat'], 200);
            return false;
        } else if($cek->materi_4 == null){
            $data = ['materi_4' => $oke->id];
            Pertemuan::where('id', $oke->pertemuan_id)->update($data);
            return response()->json(['message'=> 'materi 4 berhasil dibuat'], 200);
            return false;
        }  else if($cek->materi_5 == null){
            $data = ['materi_5' => $oke->id];
            Pertemuan::where('id', $oke->pertemuan_id)->update($data);
            return response()->json(['message'=> 'materi 5 berhasil dibuat'], 200);
            return false;
        }
        // return response()->json($cek, 200);
    }

}
