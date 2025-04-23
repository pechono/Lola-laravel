<div class="flex flex-col md:flex-row gap-4">
    <!-- Primer div (comandos de búsqueda) - 30% -->
    <div class="w-full md:w-4/12 bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg sm:px-6 lg:px-8">
        <div class="p-2 w-full sm:px-5 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
            <div class="text-xl">Ingresar Rodado</div>
            {{$message}}
            <button wire:click='ver'>ver</button>
            <div class="mt-3 w-full">
                <div class="mb-4">
                    <div><strong>Buscar Cliente</strong></div>
                </div>
    
                <!-- Formulario de búsqueda -->
                <div class="col-span-6 sm:col-span-4 mt-2 grid grid-flow-col justify-stretch">
                    <div class="flex items-center space-x-4 w-full">
                        <div class="w-1/3">
                            <x-label for="dni" value="Buscar DNI" />
                            <x-input id="dni" type="text" class="mt-1 block w-full" wire:model='dni' placeholder="Ingrese DNI"/>
                            <x-input-error for="dni" class="mt-2" />
                        </div>
                        <div class="w-1/6">
                            <button wire:click="buscarCliente" class="mt-6 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                                Buscar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            @if ($cliente)
                <div class="flex space-x-6 p-2 border my-3 border-cyan-500 rounded">
                    <div> 
                        <strong>Apellido y Nombre:</strong> {{$cliente->apellido}}, {{$cliente->nombre}}
                    </div>
                    <div class="ml-4"> 
                        <strong>DNI:</strong> {{$cliente->dni}}
                    </div> 
                    <div class="ml-4"> 
                        <strong>Teléfono:</strong> {{$cliente->telefono}}
                    </div>
                </div> 
            @endif
        </div>
        <div>
        </div>
    </div>

    @if ($cliente)
    <!-- Contenedor para los dos divs derechos - 70% -->
    <div class="w-full md:w-8/12 flex ">
        <!-- Div superior (selección de bicicleta) - 60% del espacio derecho -->
        <div class="flex-1 bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-5">
            <div class="text-xl">Selecciona tu Bicicleta</div>
            
            <!-- Contenedores de selección (colores, marcas, tipos) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                <!-- Colores -->
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                    <div class="font-bold mb-2">Color</div>
                    <div class="flex flex-wrap gap-2">
                        @foreach($colors as $color)
                            <label class="flex items-center">
                                <input type="checkbox" wire:model="selectedColors" value="{{ $color->color }}" class="mr-2">
                                {{ $color->color }}
                            </label>
                        @endforeach
                    </div>
                    <div class="mt-3">
                        <x-input wire:model="newColor" placeholder="Nuevo color" class="w-full"/>
                        <x-button wire:click="addColor" class="mt-2">Agregar</x-button>
                    </div>
                </div>
                
                <!-- Marcas -->
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                    <div class="font-bold mb-2">Marca</div>
                    <div class="flex flex-wrap gap-2">
                        @foreach($brands as $brand)
                            <label class="flex items-center">
                                <input type="checkbox" wire:model="selectedBrands" value="{{ $brand->marca }}" class="mr-2">
                                {{ $brand->marca }}
                            </label>
                        @endforeach
                    </div>
                    <div class="mt-3">
                        <x-input wire:model="newBrand" placeholder="Nueva marca" class="w-full"/>
                        <x-button wire:click="addBrand" class="mt-2">Agregar</x-button>
                    </div>
                </div>
                
                <!-- Tipos -->
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                    <div class="font-bold mb-2">Tipo</div>
                    <div class="flex flex-wrap gap-2">
                        @foreach($types as $type)
                            <label class="flex items-center">
                                <input type="checkbox" wire:model="selectedTypes" value="{{ $type->tipo }}" class="mr-2">
                                {{ $type->tipo }}
                            </label>
                        @endforeach
                    </div>
                    <div class="mt-3">
                        <x-input wire:model="newType" placeholder="Nuevo tipo" class="w-full"/>
                        <x-button wire:click="addType" class="mt-2">Agregar</x-button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Div inferior (comentarios) - 40% del espacio derecho -->
        <div class="flex-1 bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-5">
            <div class="text-xl">Deja tu Comentario</div>
            <div class="flex mt-4">
                
                
{{-- oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo --}}

                <div class="p-6 bg-white rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Selección de Procesos</h2>
                
                <!-- Filtros -->
                <div class="mb-4 flex items-center space-x-4">
                    <label class="flex items-center">
                        <input 
                            type="checkbox" 
                            wire:model.live="filtroActivos" 
                            class="rounded border-gray-300 text-indigo-600 shadow-sm"
                        >
                        <span class="ml-2">Mostrar solo procesos activos</span>
                    </label>
                </div>
                
                <!-- Lista de checkboxes -->
                <div class="space-y-2 mb-4 max-h-96 overflow-y-auto p-2 border rounded flex">
                    @forelse($procesos as $proceso)
                        <label class="flex items-center p-2 hover:bg-gray-50 rounded">
                            <input 
                                type="checkbox" 
                                wire:model.live="procesosSeleccionados" 
                                value="{{ $proceso->id }}" 
                                class="rounded border-gray-300 text-indigo-600 shadow-sm"
                            >
                            <div class="ml-3">
                                <span class="block font-medium">{{ $proceso->nombre }}</span>
                               
                            </div>
                        </label>
                    @empty
                        <p class="text-gray-500">No hay procesos disponibles</p>
                    @endforelse
                </div>
                
                <!-- Visualización de seleccionados -->
                @if(count($procesosSeleccionados) > 0)
                    <div class="mb-4 p-3 bg-gray-50 rounded">
                        <h3 class="font-medium">Procesos seleccionados ({{ count($procesosSeleccionados) }}):</h3>
                        <ul class="mt-2 space-y-1">
                            @foreach($procesos as $proceso)
                                @if(in_array($proceso->id, $procesosSeleccionados))
                                    <li class="flex items-center">
                                        <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        {{ $proceso->nombre }}
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                @else
                    <div class="mb-4 p-3 bg-yellow-50 text-yellow-700 rounded">
                        No has seleccionado ningún proceso
                    </div>
                @endif
                
                <!-- Botón de acción -->
                <div class="flex justify-end space-x-3">
                    <button 
                        wire:click="guardarSeleccion" 
                        wire:loading.attr="disabled"
                        class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 disabled:opacity-50"
                    >
                        <span wire:loading.remove>Guardar Selección</span>
                        <span wire:loading>Procesando...</span>
                    </button>
                </div>
                
                <!-- Mensajes -->
                @if(session()->has('message'))
                    <div class="mt-4 p-3 bg-green-100 text-green-800 rounded">
                        {{ session('message') }}
                    </div>
                @endif
                </div>
            </div>
            
            <div class="mt-4">
                <label for="comment" class="block font-medium">Comentario</label>
                <textarea id="comment" rows="4" class="mt-1 block w-full border-gray-300 rounded shadow-sm"></textarea>
            </div>

            <div class="mt-4">
                <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                    Guardar
                </button>
            </div>
        </div>
    </div>
    @endif
</div>