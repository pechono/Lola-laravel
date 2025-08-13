<div class=" ">

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg m-2 p-4">
        <div class="flex flex-col md:flex-row md:items-start md:space-x-4 space-y-4 md:space-y-0">

            <!-- Proveedor -->
            <div class="flex flex-col">
                <div class="flex flex-col">
                    <label for="proveedor" class="text-sm font-medium text-black mb-1">Proveedor</label>
                    <select wire:model.live="proveedor_id" id="proveedor"
                            wire:change="mostrarGrupo"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Seleccionar proveedor...</option>
                        @foreach($proveedores as $prov)
                            <option value="{{ $prov->id }}">{{ $prov->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                @error('proveedor_id') 
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                <button wire:click="crearProveedor" type="button"
                    class="text-xs text-blue-600 hover:underline mt-1 self-start">
                    + Agregar proveedor
                </button>
            </div>

            <!-- Grupo -->
            <div class="flex flex-col">
                <div class="flex flex-col">
                    <label for="grupo" class="text-sm font-medium text-black mb-1">Grupo</label>
                    <select wire:model="grupo" id="grupo"
                            wire:change="articulosGrupos"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Seleccionar grupo...</option>
                        @foreach($grupos as $g)
                            <option value="{{ $g->id }}">{{ $g->NombreGrupo }}</option>
                        @endforeach
                    </select>
                </div>
                @error('grupo') 
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                <button wire:click="crearGrupo" type="button"
                    class="text-xs text-green-600 hover:underline mt-1 self-start">
                    + Agregar grupo
                </button>
            </div>

            <div class="flex flex-col">
                <div class="flex flex-col">
                        <label for="categoria" class="text-sm font-medium text-black mb-1">Categoria</label>
                        <select id="categoria" wire:model="categoria_id" 
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Seleccionar...</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}">
                                    {{ $categoria->id }} - {{ $categoria->categoria }}
                                </option>
                            @endforeach
                        </select>
                        @error('categoria_id') 
                          <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                </div> 
            </div>


            <!-- Botón Seleccionar -->
            <div class="flex flex-col justify-end pt-[28px]">
                <button wire:click="seleccionar" type="button"
                    class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 shadow w-full">
                    Seleccionar
                </button>
            </div>

        </div>
    </div>
   

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 m-2 justify-center">

        <!-- 📋 Lista de artículos del grupo -->
        <div class="bg-white rounded-lg shadow-xl p-4">
            <h2 class="text-lg font-semibold text-black mb-4">Artículos en el grupo</h2>

            @if(count($articulosGrupo) > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 border border-gray-200">
                        <thead class="bg-gray-100">
                            <tr>                                <th class="px-4 py-2 text-left text-sm font-semibold text-black">id</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-black">Codigo Prov</th>

                                <th class="px-4 py-2 text-left text-sm font-semibold text-black">Artículo</th>
                            
                                <th class="px-4 py-2 text-left text-sm font-semibold text-black">Unidad/Venta</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($articulosGrupo as $articulo)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2 text-sm text-gray-700">
                                        {{ $articulo->id }}
                                    </td>
                                    <td class="px-4 py-2 text-sm text-gray-700">
                                        {{ $articulo->codigo }}
                                    </td>
                                    <td class="px-4 py-2 text-sm font-medium text-black">
                                        {{ $articulo->articulo }} {{ $articulo->presentacion }}
                                    </td>
                                    
                                   
                                    <td class="px-4 py-2 text-sm text-gray-700">
                                        {{ $articulo->unidadVenta }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                    <p class="text-gray-500 text-sm">No hay artículos en este grupo.</p>
                @endif

        </div>

        <!-- 🆕 Formulario para agregar artículo -->
        <div class="bg-white rounded-lg shadow-xl p-4 ">
            <h2 class="text-lg font-semibold text-black mb-4">Agregar artículo al grupo</h2>
            <div class="col-span-6 sm:col-span-4 flex gap-4">
                <!-- Campo Código (30%) -->
                    <div class="w-[30%]">
                        <label for="codigo" class="text-sm font-medium text-black mb-1">Codigo Proveedor</label>
                        <x-input id="codigo" type="text" class="mt-1 block w-full bg-white" wire:model="codigo" placeholder="Codigo"/>
                        <x-input-error for="codigo" class="mt-2" />
                    </div>
                    
                    <!-- Campo Artículo (70%) -->
                    <div class="flex-grow bg-white"> <!-- O usar w-[70%] -->
                        <label for="codigo" class="text-sm font-medium text-black mb-1">Articulo</label>
                        <x-input id="articulo" type="text" class="mt-1 block w-full " wire:model="articulo" placeholder="Articulo"/>
                        <x-input-error for="articulo" class="mt-2" />
                    </div>
            </div>

            <div class="bg-white  rounded shadow">
                 <!-- Campo presentacion -->
                 <div class="flex gap-4">
                    <div class="w-1/2">
                        <label for="codigo" class="text-sm font-medium text-black mb-1">Presentacion</label>
                        <x-input id="presentacion" type="text" class="mt-1 block w-full" wire:model='presentacion' placeholder="Presentacion"  />
                        <x-input-error for="presentacion" class="mt-2" />
                    </div>
                    <!-- Campo Unidad -->
                    <div class="w-1/2">
                        <label for="unidad" class="text-sm font-medium text-black mb-1">Unidad (Ejemplo: 500-gm)</label>
                        <select id="unidad" wire:model="unidad_id" class="block w-full rounded border-gray-300">
                            <option value="">Seleccionar...</option>
                            @foreach ($unidades as $unidad)
                                <option value="{{ $unidad->id }}">
                                    {{ $unidad->unidad }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error for="unidad" class="mt-2" />
                    </div>
                </div>
            </div>

            <div class=" bg-white  rounded shadow">
                <div class="flex gap-4">
                    <!-- Campo Grupo -->
                    <div class="w-1/3">
                        <label for="codigo" class="text-sm font-medium text-black mb-1">Descuento (Ejemplo: 10%)</label>
                        <x-input id="descuento" type="text" class="mt-1 block w-full" wire:model='descuento' placeholder="Descuento"/>
                        <x-input-error for="descuento" class="mt-2" />
                    </div>

                    <!-- Campo Unidad -->
                    <div class="w-1/3">
                        <label for="codigo" class="text-sm font-medium text-black mb-1">Unidad (Ejemplo: Unidad/Pack)</label>
                        <x-input id="'unidadVenta" type="text" class="mt-1 block w-full" wire:model='unidadVenta' placeholder="Unidad"/>
                        <x-input-error for="'unidadVenta" class="mt-2" />
                    </div>

                    <!-- Campo Código -->
                        
                    </div>
            </div>

            <div class="bg-white  rounded shadow">
                <div class="flex gap-4">
                    <!-- Campo Grupo -->
                    <div class="w-1/3">
                        <label for="codigo" class="text-sm font-medium text-black mb-1">Precio Inicial</label>

                        <x-input id="precioI" type="text" class="mt-1 block w-full" wire:model='precioI' placeholder="0"/>
                        <x-input-error for="precioI" class="mt-2" />
                    </div>

                    <!-- Campo Unidad -->
                    <div class="w-1/3">
                        <label for="codigo" class="text-sm font-medium text-black mb-1">Precio Final</label>
                        <x-input id="precioF" type="text" class="mt-1 block w-full" wire:model='precioF' placeholder="0"/>
                        <x-input-error for="precioF" class="mt-2" />
                    </div>

                    <!-- Campo Código -->
                        <div class="w-1/3">
                            <label for="codigo" class="text-sm font-medium text-black mb-1">Porecentaje</label>
                            <x-input id="porecentaje" type="text" class="mt-1 block w-full" wire:model='porcentaje' placeholder="0"/>
                            <x-input-error for="porcentaje" class="mt-2" />
                        </div>
                    <!-- Campo Código -->
                        <div class="w-1/3">
                            <label for="codigo" class="text-sm font-medium text-black mb-1">calcular Porcentaje</label>
                            <button wire:click='calcular()' class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded " >Calcular Precio</button>
                        </div>                
                    </div>
            </div>

            <div class="bg-white  rounded shadow">
                <div class="flex gap-4">
                    <!-- Campo Grupo -->
                    

                    <!-- Campo Código -->
                        <div class="w-1/3">
                            <label for="stockMinimo" class="text-sm font-medium text-black mb-1">Stock minimo</label>
                            <x-input id="stockMinimo" type="text" class="mt-1 block w-full" wire:model='stockMinimo' placeholder="0"/>
                            <x-input-error for="stockMinimo" class="mt-2" />
                        </div>
                        <div class="w-1/3">
                            <label for="stock" class="text-sm font-medium text-black mb-1">Stock </label>
                            <x-input id="stock" type="text" class="mt-1 block w-full" wire:model='stock' placeholder="0"/>
                            <x-input-error for="stock" class="mt-2" />
                        </div>
                    <!-- Campo Código -->
                                        
                    </div>
            </div>
            <div class="bg-white  rounded shadow">
                    <x-label for="detalles" value="Detalles" />
                    <x-input id="detalles" type="text" class="mt-1 block w-full" wire:model='detalles'   />
                    <x-input-error for="detalles" class="mt-2" />
            </div>
            <div class="bg-white  rounded shadow">
                <div class="flex gap-4">
                    <label for="codigo" class="text-sm font-medium text-black mb-1"> </label>
                    <button wire:click='cargarArticulo()' class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded " >Cargar Articulo</button>
                </div>
            </div>
        </div>
    </div>

    

   
</div>

    
