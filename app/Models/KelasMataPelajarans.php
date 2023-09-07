<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasMataPelajarans extends Model
{
    use HasFactory; 
    public $timestamps = false;
    protected $table = 'kelasmatapelajarans';
    protected $guarded = ['id'];
    protected $hidden = ['created_at','updated_at'];
    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }
    public function mapel(){
        return $this->belongsTo(MataPelajaran::class);
    }
}
