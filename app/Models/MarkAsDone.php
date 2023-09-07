<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarkAsDone extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'markasdone';
    protected $guarded = ['id'];
    protected $hidden = ['created_at','updated_at'];
}
