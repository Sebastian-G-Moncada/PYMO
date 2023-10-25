<x-slot name="header">
    <div class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Formulario Hospital') }}
    </div>
</x-slot>


<div class=" py-12 flex-grow flex flex-col">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <p class="text-lg text-gray-600">
                En el año 2020, el mundo enfrentó una crisis de salud sin precedentes. La pandemia afectó a
                comunidades, hospitales y trabajadores de la salud de todo el mundo. En estos momentos
                difíciles, la
                Organización sin Fines de Lucro PYMO se compromete a brindar apoyo a los hospitales que
                luchan en la
                primera línea contra el virus.
            </p>

            <p class="text-lg text-gray-600">
                Nuestra misión es proporcionar a los hospitales el material de protección esencial que
                necesitan
                para garantizar la seguridad de sus pacientes y personal. Este formulario es una herramienta
                importante para recopilar información que nos permitirá entender sus necesidades y
                brindarles el
                apoyo necesario en esta lucha.
            </p>
            <!-- Tu contenido del formulario aquí -->
            <x-label for="nombre" value='Nombre Del Hospital'>
                <x-slot name="input">
                    <x-input type="text" id="nombre" wire:model="hospital.Nombre" class="w-full" />
                    @error('hospital.Nombre')
                        <span class="text-red-600">
                            {{ $message }}
                        </span>
                    @enderror
                </x-slot>
            </x-label>

            <x-label for="mes" value='Mes:'>
                <x-slot name="input">
                    <x-input type="text" id="mes" wire:model="hospital.Mes" class="w-full" />
                    @error('hospital.Mes')
                        <span class="text-red-600">
                            {{ $message }}
                        </span>
                    @enderror
                </x-slot>
            </x-label>

            <x-label for="casos" value='Numero De Casos Del Ultimo Mes'>
                <x-slot name="input">
                    <x-input type="text" id="casos" wire:model="hospital.NumeroCasos" class="w-full" />
                    @error('hospital.NumeroCasos')
                        <span class="text-red-600">
                            {{ $message }}
                        </span>
                    @enderror
                </x-slot>
            </x-label>

            <x-label for="cubrebocas" value='Numero De Cubrebocas que Requiere'>
                <x-slot name="input">
                    <x-input type="text" id="cubrebocas" wire:model="hospital.NumeroCubrebocas" class="w-full" />
                    @error('hospital.NumeroCubrebocas')
                        <span class="text-red-600">
                            {{ $message }}
                        </span>
                    @enderror
                </x-slot>
            </x-label>

            <x-label for="mascarillas" value='Numero De Mascarillas que Requiere'>
                <x-slot name="input">
                    <x-input type="text" id="mascarillas" wire:model="hospital.NumeroMascarillas" class="w-full" />
                    @error('hospital.NumeroMascarillas')
                        <span class="text-red-600">
                            {{ $message }}
                        </span>
                    @enderror
                </x-slot>
            </x-label>

            <x-label for="caretas" value='Numero De Caretas que Requiere'>
                <x-slot name="input">
                    <x-input type="text" id="caretas" wire:model="hospital.NumeroCaretas" class="w-full" />
                    @error('hospital.NumeroCaretas')
                        <span class="text-red-600">
                            {{ $message }}
                        </span>
                    @enderror
                </x-slot>
            </x-label>

            <x-label for="empleados" value='Numero De Empleados trabajando en el Hospital'>
                <x-slot name="input">
                    <x-input type="text" id="empleados" wire:model="hospital.Empleados" class="w-full" />
                    @error('hospital.Empleados')
                        <span class="text-red-600">
                            {{ $message }}
                        </span>
                    @enderror
                </x-slot>
            </x-label>

            <div class="md:col-span-2 text-right">
                <x-button wire:click="saveHospital" wire:loading.attr="disabled" class="bg-blue-500 text-white">
                    {{ __('Mandar Formulario') }}
                </x-button>
            </div>

        </div>
    </div>

    {{-- <-- Modal de exito --> --}}
    <x-dialog-modal wire:model='showedModalExito'>
        <x-slot name="title">
            ¡Asignación Exitosa!
        </x-slot>
        <x-slot name="content">
            <p>Tu Formulario Se Envio Con Exite. <i class="fa-solid fa-check fa-beat-fade fa-2xl"
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
    
</div>
