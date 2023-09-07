<?php

namespace App\Models;

use App\Http\Controllers\API\KelasMataPelajaran;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertemuan extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'pertemuans';
    protected $guarded = ['id'];
    protected $hidden = ['tugas_1','tugas_2','tugas_3','tugas_4','tugas_5','created_at', 'updated_at','materi_1','materi_2','materi_3','materi_4','materi_5'];
    public function kelasmapel(){
        return $this->belongsTo(KelasMataPelajarans::class);
    }
    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }
    public function mapel(){
        return $this->belongsTo(MataPelajaran::class);
    }
    public function tugas(){
        return $this->hasMany(Tugas::class);
    } 
    public function materi(){
        return $this->hasMany(Materi::class);
    }
}
