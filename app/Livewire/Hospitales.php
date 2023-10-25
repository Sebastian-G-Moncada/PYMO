<?php

namespace App\Livewire;

use App\Models\Hospital;
use Livewire\Component;

class Hospitales extends Component
{   
    public $hospital = [
        'Nombre' => '',
        'Mes' => '',
        'NumeroCasos' => '',
        'NumeroCubrebocas' => '',
        'NumeroMascarillas' => '',
        'NumeroCaretas' => '',
        'Empleados' => '',
        'Status' => 'Pendiente', // Valor predeterminado si es necesario
    ];

    public $showedModalExito = false;
    
    //crea las rules para validar los campos
    protected $rules = [
        'hospital.Nombre' => 'required',
        'hospital.Mes' => 'required',
        'hospital.NumeroCasos' => 'required|numeric',
        'hospital.NumeroCubrebocas' => 'required|numeric',
        'hospital.NumeroMascarillas' => 'required|numeric',
        'hospital.NumeroCaretas' => 'required|numeric',
        'hospital.Empleados' => 'required|numeric',
    ];

    //crea los messagees para validar los campos
    protected $messages = [
        'hospital.Nombre.required' => 'El campo Nombre es requerido',
        'hospital.Mes.required' => 'El campo Mes es requerido',
        'hospital.NumeroCasos.required' => 'El campo Numero de Casos es requerido',
        'hospital.NumeroCubrebocas.required' => 'El campo Numero de Cubrebocas es requerido',
        'hospital.NumeroMascarillas.required' => 'El campo Numero de Mascarillas es requerido',
        'hospital.NumeroCaretas.required' => 'El campo Numero de Caretas es requerido',
        'hospital.Empleados.required' => 'El campo Empleados es requerido',
        //agrega los mensajes para los campos que solo acepte numericos
        'hospital.NumeroCasos.numeric' => 'El campo Numero de Casos solo acepta numeros',
        'hospital.NumeroCubrebocas.numeric' => 'El campo Numero de Cubrebocas solo acepta numeros',
        'hospital.NumeroMascarillas.numeric' => 'El campo Numero de Mascarillas solo acepta numeros',
        'hospital.NumeroCaretas.numeric' => 'El campo Numero de Caretas solo acepta numeros',
        'hospital.Empleados.numeric' => 'El campo Empleados solo acepta numeros',

    ];


    public function mount()
    {
        
    }   

    //funcion para guardar los datos
    public function saveHospital()
    {
        $this->validate();
        Hospital::create($this->hospital);
        $this->limpiarCampos();
        $this->showedModalExito = true;
        // Redireccionar a la página de inicio
        
    }

    //fucnion para limpiar los campos
    public function limpiarCampos()
    {
        $this->hospital = [
            'Nombre' => '',
            'Mes' => '',
            'NumeroCasos' => '',
            'NumeroCubrebocas' => '',
            'NumeroMascarillas' => '',
            'NumeroCaretas' => '',
            'Empleados' => '',
        ];
    }

    //funcion de cerrarModalExito
    public function cerrarModalExito()
    {
        $this->showedModalExito = false;
    }
    

    public function render()
    {
        return view('livewire.hospital');
    }
}
