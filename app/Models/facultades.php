<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class facultades extends Model
{
    use HasFactory;

    protected $fillable = [
        'anio',
        'estado',
    ];
    public function program(){
        return $this->hasMany(Programas::class);
    }
}
