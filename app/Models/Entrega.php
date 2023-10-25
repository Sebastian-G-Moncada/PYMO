<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{   
    protected $table = 'entregas';
    protected $primaryKey = 'idEntrega';
    public $timestamps = false;

    protected $fillable = [
        'idEntrega',
        'idHospital',
        'idInsumo',
        'Cantidad',
        'Fecha'
    ];

    //relacion de Entrega con Hospital
    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'idHospital', 'idHospital');
    }

    //relacion de Entrega con Insumo
    public function insumo()
    {
        return $this->belongsTo(Insumo::class, 'idInsumo', 'idInsumo');
    }
    use HasFactory;
}
