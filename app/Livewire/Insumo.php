<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Insumos;

class Insumo extends Component
{
    public $insumos;
    public $showForm = false;
    public $Nombre;
    public $Cantidad;
    public $editingInsumoId;
    public $confirmingItemDeletion = false;
    public $itemIdToDelete = null;
    public $editedNombre;
    public $editedCantidad;

    // Crea los mensajes para validar los campos
    protected $messages = [
        'Nombre.required' => 'El campo Nombre es requerido',
        'Cantidad.numeric' => 'El campo Cantidad solo acepta números'
    ];

    public function mount()
    {
        $this->insumos = Insumos::all();
    }

    public function render()
    {
        return view('livewire.insumo');
    }

    public function toggleForm()
    {
        $this->showForm = !$this->showForm;
    }

    public function hideForm()
    {
        $this->showForm = false;
        $this->reset(['Nombre', 'Cantidad']);
    }

    public function addInsumo()
    {
        $this->validate([
            'Nombre' => 'required|string|max:255',
            'Cantidad' => 'required|numeric',
        ]);

        // Consulta el último ID utilizado
        $ultimoId = Insumos::max('idInsumo');
        $nuevoId = $ultimoId + 1;

        Insumos::create([
            'idInsumo' => $nuevoId, // Asigna el nuevo ID
            'Nombre' => $this->Nombre,
            'Cantidad' => $this->Cantidad
        ]);

        $this->hideForm();
        session()->flash('success', 'Insumo agregado correctamente.');

        // Recargar los datos de insumos
        $this->insumos = Insumos::all();
    }

    // Editar funciones
    public function editInsumo($id)
    {
        $this->editingInsumoId = $id;
    }

    public function cancelEdit()
    {
        $this->editingInsumoId = null;
        $this->editedNombre = '';
        $this->editedCantidad = '';
    }

    public function updateInsumo()
    {
        $this->validate([
            'editedNombre' => 'required|string|max:255',
            'editedCantidad' => 'required|numeric',
        ]);

        // Buscar el insumo que se está editando
        $insumo = Insumos::find($this->editingInsumoId);

        if (!$insumo) {
            // Manejar el caso en el que el insumo no se encuentra
            return;
        }

        // Actualizar los atributos del insumo
        $insumo->update([
            'Nombre' => $this->editedNombre,
            'Cantidad' => $this->editedCantidad,
        ]);

        // Restablecer las variables después de la actualización
        $this->cancelEdit();

        // Recargar los datos de insumos
        $this->insumos = Insumos::all();
    }

    // Elimina el elemento
    public function confirmItemDeletion($itemId)
    {
        $this->confirmingItemDeletion = true;
        $this->itemIdToDelete = $itemId;
    }

    public function cancelItemDeletion()
    {
        $this->confirmingItemDeletion = false;
        $this->itemIdToDelete = null;
    }

    public function deleteItem()
    {
        if ($this->itemIdToDelete) {
            $insumo = Insumos::find($this->itemIdToDelete);

            if ($insumo) {
                $insumo->delete();

                // Luego de eliminar el elemento, restablece las variables
                $this->confirmingItemDeletion = false;
                $this->itemIdToDelete = null;
                $this->insumos = Insumos::all();

                session()->flash('success', 'Elemento eliminado correctamente.');
            } else {
                session()->flash('error', 'Insumo no encontrado.');
            }
        } else {
            session()->flash('error', 'ID de insumo no válido.');
        }
    }

    // Otras funciones para editar y eliminar insumos si las tienes
}
