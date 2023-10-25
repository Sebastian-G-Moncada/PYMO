<x-slot name="header">
    <div class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Formulario Hospital') }}
    </div>
</x-slot>

<div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-4 py-12">
            <button wire:click="toggleForm" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                {{ $showForm ? 'Cancelar' : 'Agregar Insumo' }}
            </button>
        </div>

        <!-- Formulario de Agregar Insumo -->
        <div class="mb-4" wire:loading.remove>
            @if ($showForm)
                <div class="bg-white rounded-lg shadow p-6 md:w-1/2 mx-auto">
                    <form wire:submit.prevent="addInsumo">
                        <div class="mb-4">
                            <label for="nombre">Nombre del Insumo</label>
                            <input type="text" wire:model="Nombre" id="Nombre"
                                class="border rounded w-full py-2 px-3">
                        </div>
                        <div class="mb-4">
                            <label for="cantidad">Cantidad</label>
                            <input type="number" wire:model="Cantidad" id="Cantidad"
                                class="border rounded w-full py-2 px-3">
                        </div>
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">
                            Guardar
                        </button>
                    </form>
                </div>
            @endif
        </div>

        <!-- Lista de insumos en una tabla -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg shadow-lg">
                <thead>
                    <tr>
                        <th class="border-b-2 border-gray-300 text-left py-2 px-3">ID</th>
                        <th class="border-b-2 border-gray-300 text-left py-2 px-3">Nombre</th>
                        <th class="border-b-2 border-gray-300 text-left py-2 px-3">Cantidad</th>
                        <th class="border-b-2 border-gray-300 text-left py-2 px-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($insumos as $insumo)
                        <tr>
                            <td class="py-2 px-3">{{ $insumo->idInsumo ?? '' }}</td>
                            <td class="py-2 px-3">{{ $insumo->Nombre ?? '' }}</td>
                            <td class="py-2 px-3">{{ $insumo->Cantidad ?? '' }}</td>
                            <td class="py-2 px-3">
                                <button wire:click="editInsumo({{ $insumo->idInsumo }})"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Editar</button>
                                <button wire:click="confirmItemDeletion({{ $insumo->idInsumo }})"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded mt-2 md:mt-0">Eliminar</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Formulario de Edición de Insumo -->
    @if ($editingInsumoId)
        <div class="bg-white rounded-lg shadow p-6 md:w-1/2 mx-auto mt-4">
            <form wire:submit.prevent="updateInsumo">
                <div class="mb-4">
                    <label for="edit-nombre">Nombre del Insumo</label>
                    <input type="text" wire:model="editedNombre" id="edit-nombre"
                        class="border rounded w-full py-2 px-3">
                </div>
                <div class="mb-4">
                    <label for="edit-cantidad">Cantidad</label>
                    <input type="number" wire:model="editedCantidad" id="edit-cantidad"
                        class="border rounded w-full py-2 px-3">
                </div>
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">
                    Guardar cambios
                </button>
                <button wire:click="cancelEdit"
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded w-full mt-2">
                    Cancelar
                </button>
            </form>
        </div>
    @endif

    <!-- Confirmación de eliminación -->
    @if ($confirmingItemDeletion)
        <div class="bg-white mt-4 rounded p-4 border border-gray-300 md:w-1/2 mx-auto">
            <h4 class="font-bold">Confirmar eliminación</h4>
            <p>¿Estás seguro de que deseas eliminar este elemento?</p>
            <hr class="my-2 border border-gray-300">
            <button wire:click="deleteItem"
                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded w-full md:w-auto">Eliminar</button>
            <button wire:click="cancelItemDeletion"
                class="bg-blue-500 hover-bg-blue-700 text-white font-bold py-2 px-4 rounded w-full md:w-auto mt-2 md:mt-0">Cancelar</button>
        </div>
    @endif
</div>
