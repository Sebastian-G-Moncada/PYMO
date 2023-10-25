<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $table = 'hospitals';
    protected $primaryKey = 'idHospital';
    public $timestamps = false;

    protected $fillable = [
        'idHospital',
        'Nombre',
        'Mes',
        'NumeroCasos',
        'NumeroCubrebocas',
        'NumeroMascarillas',
        'NumeroCaretas',
        'Empleados',
        'Status'
    ];

    //relacion de Hospital con Asignacion
    public function asignacion()
    {
        return $this->hasOne(Asignacion::class, 'idHospital', 'idHospital');
    }

    use HasFactory;
}
