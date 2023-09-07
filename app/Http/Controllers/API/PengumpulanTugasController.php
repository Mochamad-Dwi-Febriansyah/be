<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PengumpulanTugas;
use App\Models\Pertemuan;
use Illuminate\Http\Request;

class PengumpulanTugasController extends Controller
{
    public function index(Request $request){
        $pertemuan = Pertemuan::where('kelas_id', $request->kelas_id)->where('mapel_id', $request->mapel_id)->where('pertemuan_ke', $request->pertemuan_ke)->first(); 
        $data = PengumpulanTugas::where('siswa_id', $request->siswa_id)->where('tugas_id', $request->tugas_id)->where('pertemuan_id', $pertemuan->id)->first();
        if (!$data){
            return response()->json(['message' => 'belum upload tugas']);
        }
        return response()->json($data, 200);
    }
    public function create(Request $request){
        $pertemuan = Pertemuan::where('kelas_id', $request->kelas_id)->where('mapel_id', $request->mapel_id)->where('pertemuan_ke', $request->pertemuan_ke)->first();
        $file = $request->file('file_pengumpulan');
        // $filename = $file->hasName();
        $filename = $file->getClientOriginalName();
        $location = 'uploads/pengumpulan_tugas';
        $file->move($location,$filename);
        $filepath = url('uploads/pengumpulan_tugas/'.$filename); 
        $data = [
            'siswa_id' => $request->siswa_id,
            'tugas_id' => $request->tugas_id,
            'pertemuan_id' => $pertemuan->id,
            'status_pengumpulan' => $request->status_pengumpulan,
            'nilai_pengumpulan' => $request->nilai_pengumpulan,
            'telat_pengumpulan' => $request->telat_pengumpulan,
            'terakhir_diubah' => $request->terakhir_diubah,
            'file_pengumpulan' => $filepath,
            'keterangan_pengumpulan' => $request->keterangan_pengumpulan
        ];
        $cek = PengumpulanTugas::where('siswa_id', $request->siswa_id)->where('tugas_id', $request->tugas_id)->where('pertemuan_id', $pertemuan->id)->first();
        if ($cek){
            return response()->json(['message'=>'data sudah di upload']);
        }
        if (!$cek) {
            PengumpulanTugas::create($data);
            return response()->json(['message'=>'data berhasil di upload'], 201);
        }

    }
    public function getalltugas(Request $request){
        $pertemuan = Pertemuan::where('kelas_id', $request->kelas_id)->where('mapel_id', $request->mapel_id)->where('pertemuan_ke', $request->pertemuan_ke)->first();
        $tugas = PengumpulanTugas::where('pertemuan_id', $pertemuan->id)->where('tugas_id', $request->tugas_id)->with('siswa')->get();
        return response()->json($tugas, 200);
    }
    public function editnilaiuploadtugas(Request $request, $id){
        $cek = PengumpulanTugas::where('id', $id)->first();
        if(!$cek){
            return response()->json(['message' => 'data Tidak ada'], 201);
        }
        $data = [  
            'nilai_pengumpulan' => $request->nilai_pengumpulan, 
        ];
        PengumpulanTugas::where('id', $id)->update($data);
        return response()->json(['message'=>'data Berhasil  di edit'], 201);
    }
    public function editfileuploadtugas(Request $request, $id){
        $cek = PengumpulanTugas::where('id', $id)->first();
        if(!$cek){
            return response()->json(['message' => 'data Tidak ada'], 201);
        }
        $data = [  
            'file_pengumpulan' => $request->file_pengumpulan, 
            'keterangan_pengumpulan' => $request->keterangan_pengumpulan, 
            'terakhir_diubah' => $request->terakhir_diubah, 
        ];
        PengumpulanTugas::where('id', $id)->update($data);
        return response()->json(['message'=>'data Berhasil  di edit'], 201);
    }


    public function destroy(Request $request, $id){
        $cek = PengumpulanTugas::where('id', $id)->delete();
        if (!$cek) return response()->json(['message' => 'Data tidak ada']);
        return response()->json(['message'=>'Data Berhasil Dihapus']);
    }
    public function byid(Request $request, $id){
        $data = PengumpulanTugas::where('id', $id)->first();
        $success = [
            'message' => 'Berhasil mendapatkan id',
            'data' => $data
        ];
        return response()->json($success);
    }
}
