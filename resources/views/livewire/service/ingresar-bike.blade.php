<div class="space-y-4">

    {{-- ================= BUSCAR CLIENTE ================= --}}
    @if(!$cliente)
        <div class="bg-white shadow rounded p-4">
            <h2 class="text-lg font-semibold mb-3">Buscar Cliente</h2>

            <div class="flex items-end gap-4">
                <x-input
                    wire:model.defer="dni"
                    wire:keydown.enter="buscarCliente"
                />

                <button
                    wire:click="buscarCliente"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Buscar
                </button>
            </div>
        </div>
    @endif

    {{-- ================= DATOS CLIENTE ================= --}}
    @if($cliente)
        <div class="bg-cyan-50 border border-cyan-400 rounded p-3 flex justify-between items-center">
            <div class="text-sm">
                <strong>{{ $cliente->apellido }}, {{ $cliente->nombre }}</strong> |
                DNI: {{ $cliente->dni }} |
                Tel: {{ $cliente->telefono }}
            </div>

            <button
                wire:click="$set('cliente', null)"
                class="text-sm text-red-600 hover:underline"
            >
                Cambiar cliente
            </button>
        </div>
    @endif

    {{-- ================= CONTENIDO ================= --}}
    @if($cliente)

    <div class="flex flex-col lg:flex-row gap-4">

        {{-- ================= IZQUIERDA ================= --}}
        <div class="lg:w-[35%] space-y-3">

            {{-- Tipo --}}
            <div class="bg-white shadow rounded p-3">
                <h3 class="font-semibold mb-1">Tipo de bicicleta</h3>
                <select
                    wire:model.live="selectedTypes"
                    class="w-full border rounded px-2 py-1 text-sm"
                >
                    <option value="">Seleccionar</option>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}">{{ $type->tipo }}</option>
                    @endforeach
                </select>
                <div class="flex justify-between items-center mb-1">
                    <h3 class="font-semibold"></h3>

                    <button
                        wire:click="$set('modalTipo', true)"
                        class="text-xs px-2 py-1 bg-green-600 text-white rounded hover:bg-green-700"
                    >
                        ➕ Agregar
                    </button>
                </div>
            </div>

            {{-- Marca --}}
            <div class="bg-white shadow rounded p-3">
                <h3 class="font-semibold mb-1">Marca</h3>
                <select
                        wire:model.live="selectedBrands"
                        class="w-full border rounded px-2 py-1 text-sm"
                    >         
                        <option value="">Seleccionar</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->marca }}</option>
                        @endforeach
                    </select>

                    <div class="flex justify-between items-center mb-1">
                    <h3 class="font-semibold"></h3>

                        <button
                            wire:click="$set('modalMarca', true)"
                            class="text-xs px-2 py-1 bg-green-600 text-white rounded hover:bg-green-700"
                        >
                            ➕ Agregar
                        </button>
                    </div>






            </div>

            {{-- Colores --}}
            <div class="bg-white shadow rounded p-3">
                <h3 class="font-semibold mb-1">Color</h3>
                <div class="flex flex-wrap gap-2 text-sm">
                    @foreach($colors as $color)
                        <label class="flex items-center gap-1">
                            <input type="checkbox" 
                                wire:modellive="selectedColors" 
                                
                                value="{{ $color->id }}">
                            {{ $color->color }}
                        </label>
                    @endforeach
                </div>
                
            </div>
        </div>

        {{-- ================= DERECHA ================= --}}
        <div class="lg:w-[65%] bg-white shadow rounded p-4 relative overflow-hidden">

            <h3 class="text-lg font-semibold mb-2">Procesos</h3>

            {{-- BOTÓN NOTA --}}
            <div class="flex justify-end mb-2">
                <button
                    wire:click="$toggle('mostrarNotaProceso')"
                    class="px-3 py-1 text-sm bg-indigo-600 text-white rounded hover:bg-indigo-700"
                >
                    📝 Nota
                </button>
            </div>

            {{-- Buscador --}}
            <div class="flex items-center gap-4 mb-3">
                <input
                    type="text"
                    wire:model.live="buscarProceso"
                    placeholder="Buscar proceso..."
                    class="w-full border rounded px-2 py-1 text-sm"
                >

               




                <label class="text-sm flex items-center gap-1">
                    <input type="checkbox" wire:model="filtroActivos">
                    Solo activos
                </label>
            </div>

            <div class="grid grid-cols-2 gap-3">

                {{-- DISPONIBLES --}}
                <div class="border rounded p-2 max-h-[320px] overflow-y-auto">
                    <h4 class="font-semibold text-sm mb-2">Disponibles</h4>

                    @foreach($procesos as $proceso)
                        @if(!in_array($proceso->id, $procesosSeleccionados))
                            <button
                                wire:click="agregarProceso({{ $proceso->id }})"
                                class="w-full text-left px-2 py-1 text-sm rounded hover:bg-gray-100"
                            >
                                ➕ {{ $proceso->articulo }}
                            </button>
                        @endif
                    @endforeach
                </div>

                {{-- SELECCIONADOS --}}
                <div class="border rounded p-2 max-h-[320px] overflow-y-auto bg-gray-50">
                    <h4 class="font-semibold text-sm mb-2">
                        Seleccionados ({{ count($procesosSeleccionados) }})
                    </h4>

                    @foreach($procesos as $proceso)
                        @if(in_array($proceso->id, $procesosSeleccionados))
                            <button
                                wire:click="quitarProceso({{ $proceso->id }})"
                                class="w-full text-left px-2 py-1 text-sm rounded bg-white hover:bg-red-50"
                            >
                                ❌ {{ $proceso->articulo }}
                            </button>
                        @endif
                    @endforeach
                </div>
            </div>

            {{-- ===== PANEL FLOTANTE DESDE LA DERECHA ===== --}}
            <div
                class="absolute top-0 right-0 h-full w-96 bg-white border-l shadow-xl
                       transform transition-transform duration-300
                       {{ $mostrarNotaProceso ? 'translate-x-0' : 'translate-x-full' }}"
            >
                <button
                    wire:click="$toggle('mostrarNotaProceso')"
                    class="absolute -left-4 top-4 bg-indigo-600 text-white w-8 h-8 rounded-full flex items-center justify-center shadow"
                >
                    {{ $mostrarNotaProceso ? '→' : '←' }}
                </button>

                <div class="p-4">
                    <h3 class="font-semibold mb-2">Nota del proceso</h3>
                    <textarea
                        wire:model.defer="notaProceso"
                        rows="8"
                        class="w-full border rounded px-2 py-1 text-sm resize-none"
                        placeholder="Escriba aquí la observación..."
                    ></textarea>
                </div>
            </div>

        </div>
    </div>

    {{-- ================= GUARDAR ================= --}}
    <div class="flex justify-end">
        <button
            wire:click="guardarIngreso"
            class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700"
        >
            Guardar ingreso
        </button>
    </div>

    @endif

    {{-- ================= RESÚMENES ================= --}}
    <div>
        @if($selectedBrands)
           <h3 class="text-lg font-semibold mb-2">Marca seleccionada:</h3>
            <ul class="list-disc list-inside">
                <li>{{ $brands->firstWhere('id', $selectedBrands)?->marca }}</li>
            </ul>
        @endif
        @if($selectedTypes)
           <h3 class="text-lg font-semibold mb-2">Tipo seleccionado:</h3>
            <ul class="list-disc list-inside">
                <li>{{ $types->firstWhere('id', $selectedTypes)?->tipo }}</li>
            </ul>
        @endif

         @if(count($selectedColors))
        <div>
            <h3 class="text-sm font-semibold mb-1">Colores seleccionados</h3>
            <ul class="flex flex-wrap gap-2 text-sm">
                @foreach ($selectedColors as $colorId)
                    @php
                        $color = $colors->firstWhere('id', $colorId);
                    @endphp
                    @if ($color)
                        <li class="px-2 py-1 bg-white border rounded">
                            🎨 {{ $color->color }}
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
        @endif



        
        @if ($procesosSeleccionados)
            <h3 class="text-lg font-semibold mb-2">Procesos Seleccionados</h3>
            <ul class="list-disc list-inside">
                @foreach ($procesosSeleccionados as $procesoId)
                    @php
                        $proceso = $procesos->firstWhere('id', $procesoId);
                    @endphp
                    @if ($proceso)
                        <li>{{ $proceso->articulo }}</li>
                    @endif
                @endforeach
            </ul>
            
        @endif
    </div>

            {{-- @if($modalTipo)
            <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">

                <div class="bg-white w-full max-w-md rounded shadow-lg p-4 relative">

                    <h2 class="text-lg font-semibold mb-3">Agregar Tipo</h2>

                    <div>
                    <x-label for="nuevoTipo" value="nuevoTipo" />
                        <x-input
                            id="nuevoTipo"
                            type="text"
                            class="mt-1 block w-full"
                            wire:model.defer="nuevoTipo"
                        />

                        <x-input-error for="nuevoTipo" class="mt-2" />
                    </div>


                    <div class="flex justify-end gap-2 mb-3">
                        <button
                            wire:click="$set('modalTipo', false)"
                            class="px-3 py-1 text-sm border rounded"
                        >
                            Cancelar
                        </button>

                        <button
                            wire:click="guardarTipo"
                            class="px-3 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700"
                        >
                            Guardar Tipo
                        </button>
                    </div>

                    <h3 class="text-sm font-semibold mb-1">Tipos cargados</h3>

                    <ul class="max-h-40 overflow-y-auto text-sm border rounded p-2">
                        @foreach($types as $type)
                            <li class="border-b last:border-b-0 py-1">
                                {{ $type->tipo }}
                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>
            @endif --}}

            @if($modalMarca)
<div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">

    <div class="bg-white w-full max-w-md rounded shadow-lg p-4 relative">

        <h2 class="text-lg font-semibold mb-3">Agregar Marca</h2>

        <input
            type="text"
            wire:model.defer="nuevaMarca"
            placeholder="Nombre de la marca"
            class="w-full border rounded px-2 py-1 mb-3 text-sm"
        >

        <div class="flex justify-end gap-2 mb-3">
            <button
                wire:click="$set('modalMarca', false)"
                class="px-3 py-1 text-sm border rounded"
            >
                Cancelar
            </button>

            <button
                wire:click="guardarMarca"
                class="px-3 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700"
            >
                Guardar
            </button>
        </div>

        <h3 class="text-sm font-semibold mb-1">Marcas cargadas</h3>

        <ul class="max-h-40 overflow-y-auto text-sm border rounded p-2">
            @foreach($brands as $brand)
                <li class="border-b last:border-b-0 py-1">
                    {{ $brand->marca }}
                </li>
            @endforeach
        </ul>

    </div>
</div>
@endif




</div>
