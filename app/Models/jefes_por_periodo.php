<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jefes_por_periodo extends Model
{
    use HasFactory;
    protected $table = "jefes_por_periodo";
    protected $fillable = [
        'user_id',
        'identificacion',
        'jefe',
        'año',
        'periodo'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id', 'user_id');
    }
    /*
    public function jefe(){
        return $this->belongsTo(User::class,'jefe', 'user_id');
    }
    */

/*
    public function programa(){
        return $this->hasOne(Programa::class);
    }
    public function facultad(){
        return $this->hasOne(Facultad::class);
    }*/
}
