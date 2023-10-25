<?php

namespace App\Livewire;

use App\Models\Asignacion;
use App\Models\Hospital;
use App\Models\Insumos;
use Livewire\Component;

class Dashboard extends Component
{
    //variable publica
    public $hospitales;
    public $rowNumber;
    public $selectedSolicitud;
    public $showedModalDetalles = false;
    public $showedModalExito = false;
    public $showedModalAsignacion = false;
    public $insumos;
    public $cantidadAsignada = [];
    public $rules = [];
    public $messages = [];
    public $asignaciones;
    public $showedModalEntrega = false;


    public $hospital = [
        'Nombre' => '',
        'Mes' => '',
        'NumeroCasos' => '',
        'NumeroCubrebocas' => '',
        'NumeroMascarillas' => '',
        'NumeroCaretas' => '',
        'Empleados' => '',
        'Status' => 'activo', // Valor predeterminado si es necesario
    ];

    public $insumo = [
        'idAsignacion' => '',
        'idHospital' => '',
        'idInsumo' => '',
        'Cantidad' => '', // Valor predeterminado si es necesario
    ];

    //funcion mount 
    public function mount()
    {
        //traeme todos los datos de la tabla Hospitales
        $this->hospitales = Hospital::all();
        $this->insumos = Insumos::all();
        $this->asignaciones = Asignacion::all();

        foreach ($this->insumos as $insumo) {
            $this->rules["cantidadAsignada.{$insumo->idInsumo}"] = 'required|numeric|min:0';

            // Agregar mensajes personalizados para cada campo
            $this->messages["cantidadAsignada.{$insumo->idInsumo}.required"] = 'El campo cantidad es obligatorio.';
            $this->messages["cantidadAsignada.{$insumo->idInsumo}.numeric"] = 'El campo cantidad debe ser numérico.';
            $this->messages["cantidadAsignada.{$insumo->idInsumo}.min"] = 'El campo cantidad debe ser mayor o igual a 0.';
        }
        // dd($this->hospitales);
    }

    public function showModalDetalles($IdHospital)
    {
        $this->selectedSolicitud = Hospital::where('IdHospital', $IdHospital)->first();
        $this->showedModalDetalles = true;

        if ($this->selectedSolicitud) {
            $this->hospital['Nombre'] = $this->selectedSolicitud->Nombre;
            $this->hospital['Mes'] = $this->selectedSolicitud->Mes;
            $this->hospital['NumeroCasos'] = $this->selectedSolicitud->NumeroCasos;
            $this->hospital['NumeroCubrebocas'] = $this->selectedSolicitud->NumeroCubrebocas;
            $this->hospital['NumeroMascarillas'] = $this->selectedSolicitud->NumeroMascarillas;
            $this->hospital['NumeroCaretas'] = $this->selectedSolicitud->NumeroCaretas;
            $this->hospital['Empleados'] = $this->selectedSolicitud->Empleados;
            $this->hospital['Status'] = $this->selectedSolicitud->Status;
        }
    }

    public function asignarInsumos()
    {
        $this->showedModalAsignacion = true;
        $this->showedModalDetalles = false; // Oculta el modal de detalles
    }


    public function mostrarModalExito()
    {
        $this->showedModalExito = true;
        $this->showedModalDetalles = false; // Oculta el modal de detalles
    }


    public function cerrarModalExito()
    {
        $this->showedModalExito = false;
    }

    public function asignarProductos()
    {
        $this->validate();
        // Itera a través de la cantidad asignada y realiza la asignación en la base de datos
        foreach ($this->cantidadAsignada as $insumoId => $cantidad) {
            // Encuentra el insumo por su ID
            $insumo = Insumos::where('idInsumo', $insumoId)->first();

            if ($insumo) {
                // Realiza la asignación y descuento de insumos
                $insumo->decrement('Cantidad', $cantidad);

                // Crea una nueva instancia de Asignacion y guárdala en la base de datos
                $asignacion = new Asignacion();
                $asignacion->idHospital = $this->selectedSolicitud->idHospital;
                $asignacion->idInsumo = $insumo->idInsumo;
                $asignacion->Cantidad = $cantidad;
                $asignacion->save();
                // Limpia el registro de la cantidad asignada
                $this->cantidadAsignada = [];
                $hospital = $this->selectedSolicitud;

                if ($hospital) {
                    $hospital->status = 'Asignado'; // Cambiar el estado a "Asignado".
                    $hospital->save(); // Guardar el cambio en la base de datos si es necesario.
                }

                $this->hospitales = Hospital::all();
                $this->mostrarModalExito();
            }
        }

        $this->showedModalAsignacion = false; // Oculta el modal de asignación
        // Vuelve a cargar la lista de insumos después de la asignación
        $this->insumos = Insumos::all();
    }

    public function mostrarModalEntrega($IdHospital)
    {
        $this->showedModalEntrega = true;

        $this->asignaciones = Asignacion::where('IdHospital', $IdHospital)->get();

        if ($this->asignaciones->isNotEmpty()) {
            foreach ($this->asignaciones as $asignacion) {
                // Accede a las propiedades de cada asignación y haz lo que necesites hacer con ellas
                $idAsignacion = $asignacion->idAsignacion;
                $idHospital = $asignacion->idHospital;
                $idInsumo = $asignacion->idInsumo;
                $cantidad = $asignacion->Cantidad;

                // Puedes usar estas propiedades en tu lógica o asignarlas a un arreglo si es necesario
                // Ejemplo: $this->insumo['idAsignacion'] = $idAsignacion;
            }
        }
    }

    //funcion marcar como entregado
    public function marcarEntregado($IdHospital)
    {
        $hospital = Hospital::where('IdHospital', $IdHospital)->first();

        if ($hospital) {
            $hospital->status = 'Entregado'; // Cambiar el estado a "Entregado".
            $hospital->save(); // Guardar el cambio en la base de datos si es necesario.
        }

        $this->hospitales = Hospital::all();
        $this->showedModalEntrega = false; // Oculta el modal de entrega
    }
    
    public function render()
    {
        return view('livewire.dashboard');
    }
}
