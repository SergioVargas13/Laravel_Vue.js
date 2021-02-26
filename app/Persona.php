<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    //
    protected $fillable = ['documento', 'nombre', 'apelllido','edad','genero','telefono','imagen'];
}
