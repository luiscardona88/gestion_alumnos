<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class asignaturas_model extends Model
{
    protected $table = 'asignaturas';
    protected $fillable=['nombre'];
    public $timestamps = false;
    public function alumnos()
    {
    
    //return $this->belongsToMany(Tag::class);
    return $this->morphedByMany(Alumnos_model::class,"taggables", null, 'tag_id');
    
    }
}
