<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facultad extends Model
{
    use HasFactory;

    protected $fillable = [
        'anio',
        'estado',
    ];
    public function Programa(){
        return $this->hasMany(Programa::class);
    }
}
