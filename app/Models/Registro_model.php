<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro_model extends Model
{
    use HasFactory;
    protected $table = 'registro';
    protected $fillable=['detalles'];
    public $timestamps = false;
}
