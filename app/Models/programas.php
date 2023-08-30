<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class programas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'facultad',
    ];

    public function facultad(){
        return $this->hasOne(facultades::class,'id','faculty_id');
    }
}
