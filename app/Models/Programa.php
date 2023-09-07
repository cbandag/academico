<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'facultad_id',
    ];

    public function facultad(){
        return $this->hasOne(Facultad::class,'id', 'facultad_id');
    }
}
