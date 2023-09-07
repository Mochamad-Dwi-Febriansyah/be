<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengumpulanTugas extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'pengumpulan_tugas';
    protected $guarded = ['id'];
    protected $hidden = ['siswa_id','created_at','updated_at'];
    public function siswa () {
        return $this->belongsTo(Siswa::class);
    }
}
