<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insumos extends Model
{
    protected $table = 'insumos';
    protected $primaryKey = 'idInsumo';
    public $timestamps = false;

    protected $fillable = [
        'idInsumo',
        'Nombre',
        'Cantidad'
    ];

    //relacion de Insumos con Asignacion
    public function asignacion()
    {
        return $this->hasOne(Asignacion::class, 'idInsumo', 'idInsumo');
    }

    use HasFactory;
}
