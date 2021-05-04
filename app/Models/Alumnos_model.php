<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumnos_model extends Model
{

    protected $table = 'alumnos';
    protected $fillable=['nombre',"estatus"];
    public $timestamps = false;
    use HasFactory;

    public function asignaturas()
{

//return $this->belongsToMany(Tag::class);
return $this->morphToMany(asignaturas_model::class,"taggables", null, 'tag_id');

}
}


