<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pertemuan;
use App\Models\MarkAsDone; 

class MarkAsDoneController extends Controller
{
  public function create(Request $request){
    $pertemuan = Pertemuan::where('kelas_id', $request->kelas_id)->where('mapel_id', $request->mapel_id)->where('pertemuan_ke', $request->pertemuan_ke)->first();
    $data = [
        'siswa_id' => $request->siswa_id,
        'tugas_id' => $request->tugas_id,
        'materi_id' => $request->materi_id,
        'pertemuan_id' => $pertemuan->id,
        'status' => $request->status
    ];
    $cek = MarkAsDone::where('siswa_id', $request->siswa_id)->where('tugas_id', $request->tugas_id)->first();
    if (!$cek) {
        MarkAsDone::create($data);
        return response()->json(['message'=>'data berhasil di buat'], 201);
    }
    if ($cek){ 
        if ($cek['status'] == '0'){
            MarkAsDone::where('id', $cek->id)->update(['status' => '1']);
            return response()->json(['message'=>'data berhasil di udbah'], 201);
        } else if ($cek['status'] == '1'){
            MarkAsDone::where('id', $cek->id)->update(['status' => '0']);
            return response()->json(['message'=>'data berhasil di ubah'], 201);
        }
    }
  }
}
