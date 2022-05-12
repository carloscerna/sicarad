<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    use HasFactory;
    protected $table = "asignatura";
    protected $fillable = ['nombre','codigo','codigo_cc','codigo_area','codigo_servicio_educativo']; // es para definir que registros van hacer guardados, o sea solo los campos que esten en el listado.
    
}
