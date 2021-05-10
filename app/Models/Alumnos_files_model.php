<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumnos_files_model extends Model
{
    use HasFactory;
    protected $table="table_alumnos_files";
    protected $fillable=["id_alumno","ruta_path","status"];

    public function alumnos()
    {
        return $this->belongsTo(Alumnos_model::class,"id_alumno");
    }

}


