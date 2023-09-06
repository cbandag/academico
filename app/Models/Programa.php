<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    use HasFactory;
    protected $table = 'periodos';
    protected $fillable = [
        'nombre',
        'facultad',
    ];

    public function Facultad(){
        return $this->hasOne(Facultad::class,'id','faculty_id');
    }
}
