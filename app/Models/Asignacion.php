<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
    protected $table = 'asignacions';
    protected $primaryKey = 'idAsignacion';
    public $timestamps = false;
    
    protected $fillable = [
        'idAsignacion',
        'idHospital',
        'idInsumo',
        'Cantidad'
    ];

    //relacion de Asignacion con Hospital
    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'idHospital', 'idHospital');
    }

    //relacion de Asignacion con Insumo
    public function insumo()
    {
        return $this->belongsTo(Insumos::class, 'idInsumo', 'idInsumo');
    }

    use HasFactory;
}
