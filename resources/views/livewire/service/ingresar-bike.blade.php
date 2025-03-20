<div> 
    <div class=" flex"> 
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg w-5/12 mx-auto sm:px-6 lg:px-8">
                <div class="p-2 w-full sm:px-5 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                    <div class="text-xl">Ingresar Rodado</div>
            
                    <div class="mt-3 w-full">
                        <div class="mb-4">
                            <div><strong>Buscar Cliente</strong></div>
                        </div>
            
                        <!-- Formulario de búsqueda -->
                        <div class="col-span-6 sm:col-span-4 mt-2 grid grid-flow-col justify-stretch">
                            <div class="flex items-center space-x-4 w-full">
                                <div class="w-1/3"> <!-- Ajuste del ancho de los campos -->
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
        </div>
        @if ($cliente)
            <div class="ml-4 flex-1 bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-5">
                <div class="text-xl">Deja tu Comentario</div>
                
                <div >
                    <strong>Parchar</strong>
                    <label>
                        <input type="checkbox" wire:model.live="parchadaD">Delantera
                    </label>
                    <label>
                        <input type="checkbox" wire:model.live="parchadaT">Tracera
                    </label>
                    
                    <p>Estado del checkbox: {{ $parchadaD ? 'Marcado' : 'No marcado' }}</p>
                </div>
               
               
               
                <div class="mt-3 w-full">
                    <label for="comment" class="block font-medium text-gray-700">Escribe un comentario</label>
                    <textarea id="comment" rows="4" class="mt-1 block w-full border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Escribe tu comentario aquí..."></textarea>
                </div>

                <!-- Botón para guardar el comentario -->
                <div class="mt-4">
                    <button onclick="saveComment()" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                        Guardar Comentario
                    </button>
                </div>
            </div>
        @endif
    </div>
    @if ($cliente)
    <div class="mx-auto sm:px-6 lg:px-8 mt-4 w-full ">
        <div class="flex flex-wrap gap-4 w-full">
            <!-- Contenedor para selección de colores -->
            <div class="flex-1 bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-5 w-full">
                <div class="text-xl">Selecciona tu Bicicleta</div>
        
                <!-- Selección de Colores -->
                <div class="mt-3 w-full py-4">
                    <div><strong>Selecciona el color:</strong></div>
                    <div class="flex flex-wrap gap-4">
                        @foreach($colors as $color)
                            <div class="flex-shrink-0 w-1/4 mb-2">
                                <label for="color_{{ $color->id }}" class="flex items-center space-x-2">
                                    <input type="checkbox" id="color_{{ $color->id }}" wire:model="selectedColors" value="{{ $color->color }}" class="form-checkbox text-blue-500">
                                    <span>{{ $color->color }}</span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        <x-label for="newColor" value="Agregar nuevo color" />
                        <x-input id="newColor" type="text" wire:model="newColor" placeholder="Escribe un color nuevo" class="mt-1 block w-full" />
                        <x-button wire:click="addColor" class="mt-2">Agregar Color</x-button>
                    </div>
                </div>
            </div>
        
            <!-- Contenedor para selección de marca -->
            <div class="flex-1 bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-5 w-full">
                <div class="text-xl">Selecciona tu Marca</div>
        
                <!-- Selección de Marcas -->
                <div class="mt-3 w-full py-4">
                    <div><strong>Selecciona la marca:</strong></div>
                    <div class="flex flex-wrap gap-4">
                        @foreach($brands as $brand)
                            <div class="flex-shrink-0 w-1/4 mb-2">
                                <label for="brand_{{ $brand->id }}" class="flex items-center space-x-2">
                                    <input type="checkbox" id="brand_{{ $brand->id }}" wire:model="selectedBrands" value="{{ $brand->marca }}" class="form-checkbox text-blue-500">
                                    <span>{{ $brand->marca }}</span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        <x-label for="newBrand" value="Agregar nueva marca" />
                        <x-input id="newBrand" type="text" wire:model="newBrand" placeholder="Escribe una marca nueva" class="mt-1 block w-full" />
                        <x-button wire:click="addBrand" class="mt-2">Agregar Marca</x-button>
                    </div>
                </div>
            </div>
        
            <!-- Contenedor para selección de tipo -->
            <div class="flex-1 bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-5 w-full">
                <div class="text-xl">Selecciona Tipo</div>
        
                <!-- Selección de Tipos -->
                <div class="mt-3 w-full py-4">
                    <div><strong>Selecciona el tipo:</strong></div>
                    <div class="flex flex-wrap gap-4">
                        @foreach($types as $type)
                            <div class="flex-shrink-0 w-1/4 mb-2">
                                <label for="type_{{ $type->id }}" class="flex items-center space-x-2">
                                    <input type="checkbox" id="type_{{ $type->id }}" wire:model="selectedTypes" value="{{ $type->tipo }}" class="form-checkbox text-blue-500">
                                    <span>{{ $type->tipo }}</span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        <x-label for="newType" value="Agregar nuevo tipo" />
                        <x-input id="newType" type="text" wire:model="newType" placeholder="Escribe un tipo nuevo" class="mt-1 block w-full" />
                        <x-button wire:click="addType" class="mt-2">Agregar Tipo</x-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-6 text-gray-700">
            @if($message)
                <p>{{ $message }}</p>
            @endif
    </div>
    @endif
</div>
