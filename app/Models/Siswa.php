<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;

class Siswa extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'siswas';
    protected $guarded = ['id'];
    protected $hidden = ['kelas_id'];
    public function kelas(){
        return $this->belongsTo(kelas::class);
    }
}
