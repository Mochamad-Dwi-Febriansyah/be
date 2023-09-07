<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory; 
    public $timestamps = false;
    protected $table = 'kelas';
    protected $guarded = ['id'];
    protected $hidden = ['created_at','updated_at'];
    public function jml(){
        return $this->belongsTo(Siswa::class, 'id');
    }
}
