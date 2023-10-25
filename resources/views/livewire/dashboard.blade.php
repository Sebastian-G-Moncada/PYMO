<div class="">
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </div>
    </x-slot>
    <div class="">
        <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="overflow-x-auto rounded-lg shadow-xl">
                <table class="w-full ">
                    <thead class="bg-blue-100">
                        <tr class="text-center">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider text-center">
                                Nombre</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider text-center">
                                Numero de Casos
                            </th>
                            <th
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider text-center">
                                Status
                            </th>
                            <th
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 tracking-wider text-center">
                                Ver Detalles
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hospitales as $hospital)
                            <tr class="{{ $rowNumber % 2 === 0 ? 'bg-slate-50' : 'bg-slate-100' }}">
                                <td class="px-6 py-4 whitespace-nowrap text-black text-center">{{ $hospital->Nombre }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-black text-center">
                                    {{ $hospital->NumeroCasos }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-black text-center">
                                    @if ($hospital->Status === 'Pendiente')
                                        <i class="fa-solid fa-circle text-red-500"></i> {{ $hospital->Status }}
                                    @elseif ($hospital->Status === 'Asignado')
                                        <i class="fa-solid fa-circle text-yellow-500"></i> {{ $hospital->Status }}
                                    @elseif ($hospital->Status === 'Entregado')
                                        <i i class="fa-solid fa-circle text-green-500"></i> {{ $hospital->Status }}
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <x-button type="button" class="font-white"
                                        wire:click="showModalDetalles('{{ $hospital->idHospital }}')">
                                        <i class="fa-solid fa-eye"></i>
                                    </x-button>
                                    <x-button wire:click="mostrarModalEntrega('{{ $hospital->idHospital }}')">
                                        <i class="fa-solid fa-truck"></i>
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </x-button>
                                </td>
                            </tr>
                            @php $rowNumber++; @endphp
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- modal de Detalles --}}
    <x-dialog-modal wire:model='showedModalDetalles'>
        <x-slot name="title">
            Detalles
        </x-slot>
        <x-slot name="content">
            @if ($selectedSolicitud !== null)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-label for="mes" value='Mes:'>
                        <x-slot name="input">
                            <x-input type="text" id="mes" wire:model="hospital.Mes" class="w-full" disabled />
                            @error('hospital.Mes')
                                <span class="text-red-600">
                                    {{ $message }}
                                </span>
                            @enderror
                        </x-slot>
                    </x-label>

                    <x-label for="casos" value='Numero De Casos Del Ultimo Mes'>
                        <x-slot name="input">
                            <x-input type="text" id="casos" wire:model="hospital.NumeroCasos" class="w-full"
                                disabled />
                            @error('hospital.NumeroCasos')
                                <span class="text-red-600">
                                    {{ $message }}
                                </span>
                            @enderror
                        </x-slot>
                    </x-label>

                    <!-- Repite lo mismo para los demás campos -->


                    <x-label for="cubrebocas" value='Numero De Cubrebocas que Requiere'>
                        <x-slot name="input">
                            <x-input type="text" id="cubrebocas" wire:model="hospital.NumeroCubrebocas"
                                class="w-full" disabled />
                            @error('hospital.NumeroCubrebocas')
                                <span class="text-red-600">
                                    {{ $message }}
                                </span>
                            @enderror
                        </x-slot>
                    </x-label>

                    <x-label for="mascarillas" value='Numero De Mascarillas que Requiere'>
                        <x-slot name="input">
                            <x-input type="text" id="mascarillas" wire:model="hospital.NumeroMascarillas"
                                class="w-full" disabled />
                            @error('hospital.NumeroMascarillas')
                                <span class="text-red-600">
                                    {{ $message }}
                                </span>
                            @enderror
                        </x-slot>
                    </x-label>

                    <x-label for="caretas" value='Numero De Caretas que Requiere'>
                        <x-slot name="input">
                            <x-input type="text" id="caretas" wire:model="hospital.NumeroCaretas" class="w-full"
                                disabled />
                            @error('hospital.NumeroCaretas')
                                <span class="text-red-600">
                                    {{ $message }}
                                </span>
                            @enderror
                        </x-slot>
                    </x-label>

                    <x-label for="empleados" value='Numero De Empleados en el Hospital'>
                        <x-slot name="input">
                            <x-input type="text" id="empleados" wire:model="hospital.Empleados" class="w-full"
                                disabled />
                            @error('hospital.Empleados')
                                <span class="text-red-600">
                                    {{ $message }}
                                </span>
                            @enderror
                        </x-slot>
                    </x-label>


                </div>
            @endif
        </x-slot>
        <x-slot name="footer">
            <div class="mt-4">
                @if ($selectedSolicitud && $selectedSolicitud->Status !== 'Asignado')
                    <x-button type="button" wire:click="asignarInsumos">
                        {{ __('Asignar Insumos Pedidos') }}
                    </x-button>
                @endif
            </div>
        </x-slot>
    </x-dialog-modal>

    {{-- <-- Modal de Asignacion --> --}}
    <x-dialog-modal wire:model="showedModalAsignacion">
        <x-slot name="title">
            Asignación De Los Productos
        </x-slot>
        <x-slot name="content">
            @if ($insumos->isNotEmpty())
                <h2 class="text-lg font-semibold">Insumos Disponibles:</h2>
                @foreach ($insumos as $insumo)
                    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <x-label for="cantidadAsignada_{{ $insumo->idInsumo }}"
                            value="{{ $insumo->Nombre }} (Cantidad disponible: {{ $insumo->Cantidad }})">
                            <x-slot name="input">
                                <x-input type="text" id="cantidadAsignada_{{ $insumo->idInsumo }}"
                                    wire:model="cantidadAsignada.{{ $insumo->idInsumo }}" class="w-full" />
                                @error("cantidadAsignada.{$insumo->idInsumo}")
                                    <span class="text-red-600">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </x-slot>
                        </x-label>
                    </div>
                @endforeach
            @else
                <p>No hay insumos disponibles.</p>
            @endif
        </x-slot>
        <x-slot name="footer">
            @if ($insumos->isNotEmpty())
                <div class="mt-4">
                    <x-button type="button" wire:click="asignarProductos">
                        {{ __('Asignar Los Productos') }}
                    </x-button>
                </div>
            @endif
        </x-slot>
    </x-dialog-modal>


    {{-- <-- Modal de exito --> --}}
    <x-dialog-modal wire:model='showedModalExito'>
        <x-slot name="title">
            ¡Asignación Exitosa!
        </x-slot>
        <x-slot name="content">
            <p>Tu asignación de insumos ha sido completada con éxito. <i class="fa-solid fa-check fa-beat-fade fa-2xl"
                    style="color: #1bd039;"></i></p>

        </x-slot>
        <x-slot name="footer">
            <div class="mt-4">
                <x-button type="button" wire:click="cerrarModalExito">
                    {{ __('Cerrar') }}
                </x-button>
            </div>
        </x-slot>
    </x-dialog-modal>

    {{-- <-- Modal de Entrega --> --}}
    <x-dialog-modal wire:model="showedModalEntrega">
        <x-slot name="title">
            Productos a Entregar
        </x-slot>
        <x-slot name="content">
            @if ($asignaciones->isNotEmpty())
                <h2 class="text-lg font-semibold">Insumos a Entregar:</h2>
                <ul>
                    @foreach ($asignaciones as $asignacion)
                        <li>
                            <div
                                class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                                <x-label for="cantidadAsignada_{{ $asignacion->idAsignacion }}"
                                    value="{{ $asignacion->insumo->Nombre ?? '' }} (Cantidad a entregar: {{ $asignacion->Cantidad }})">

                                </x-label>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No se a asignado insumos</p>
            @endif
        </x-slot>
        <x-slot name="footer">
            <div class="mt-4">
                @if ($asignaciones->isNotEmpty())
                    <x-button type="button" wire:click="marcarEntregado({{ $hospital->idHospital ?? '' }})">
                        {{ __('Marcar Entregados') }}
                    </x-button>
                @else
                    <p></p>
                @endif
            </div>
        </x-slot>
    </x-dialog-modal>
</div>
