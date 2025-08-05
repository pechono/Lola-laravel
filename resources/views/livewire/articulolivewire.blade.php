<div class="w-auto p-2 sm:px-5 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
    <div class="mt-4 text-2xl flex justify-between shadow-inner">
        <div>Articulo</div>
        <div class="mr-2">

            <x-button wire:click='confirmarArticuloAdd' class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Crear Nuevo articulo
            </x-button>
        </div>
    </div>

    <div class="mt-3 w-full ">
        <div class="flex justify-between">
            <div>
                <input wire:model.live='q' type="search" placeholder="Buscar" class="shadow appearance-none border rounded w-full py-2 px-3

                text-gray-706 leading-tight focus:outline-none focus: shadow-outline placeholder-blue-400" name="">
            </div>
            <div class="mr-2">
                <input class="mr-2 leading-tight" type="checkbox" wire:model.live ='active'/ value="1" checked>Articulos Activos
            </div>
        </div>

        <table class="table-auto w-full">
            <thead>
                <tr>
                    <td class="px-4 py-2">
                        <div class="flex items-center" >
                            <button wire:click="sortby('id')">Id</button>
                            <x-sort-icon 
                                 sort-field="id': sortBy=$sortBy, sortAsc=$sortAsc/>
                        </div>
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="sortby('articulo')">Articulo</button>
                            <x-sort-icon 
            sort-field="apellido" 
            :sort-by="$sortBy" 
            :sort-asc="$sortAsc">

                        </div>
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="sortby('categoria_id')">Categoria</button>
                            <x-sort-icon 
                        sort-field="nombre" 
                        :sort-by="$sortBy" 
                        :sort-asc="$sortAsc" /> 
                        </div>
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex items-center">
                            <button >Presentacion</button>
                            <x-sort-icon 
            sort-field="telefono" 
            :sort-by="$sortBy" 
            :sort-asc="$sortAsc" /> 
                        </div>
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="sortby('descuento')">Desc.</button>
                            <x-sort-icon 
            sort-field="telefono" 
            :sort-by="$sortBy" 
            :sort-asc="$sortAsc" /> 
                        </div>
                    </td>
                    

            <td class="px-4 py-2">
                <div class="flex items-center">
                    <button wire:click="sortby('unidadVenta')">Unidad Cant.</button>
                    <x-sort-icon 
                        sort-field="unidadVenta" 
                        :sort-by="$sortBy" 
                        :sort-asc="$sortAsc" 
                    />
                </div>
            </td>



                    <td class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="sortby('precioI')">Precio Inicial</button>
                            <x-sort-icon 
            sort-field="telefono" 
            :sort-by="$sortBy" 
            :sort-asc="$sortAsc" /> 
                        </div>
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="sortby('precioF')">Precio Final</button>
                            <x-sort-icon 
            sort-field="telefono" 
            :sort-by="$sortBy" 
            :sort-asc="$sortAsc" /> 
                        </div>
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="sortby('caducidad')">Cadc.</button>
                            <x-sort-icon 
            sort-field="telefono" 
            :sort-by="$sortBy" 
            :sort-asc="$sortAsc" /> 
                        </div>
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="sortby('detalles')">Detalles</button>
                            <x-sort-icon 
            sort-field="telefono" 
            :sort-by="$sortBy" 
            :sort-asc="$sortAsc" /> 
                        </div>
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="sortby('stockMinimo')">Stock Min.</button>
                            <x-sort-icon 
            sort-field="telefono" 
            :sort-by="$sortBy" 
            :sort-asc="$sortAsc" /> 
                        </div>
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="sortby('stock')">Stock
                                <div class="w-15 h-8 p-2 grid justify-items-center content-center bg-green-400 rounded-full">suelto</div>

                            </button>
                            <x-sort-icon 
            sort-field="telefono" 
            :sort-by="$sortBy" 
            :sort-asc="$sortAsc" /> 
                        </div>
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex items-center">Accion</div>

                    </td>
                </tr>
            </thead>
            <tbody>
                @foreach ($articulos as $articulo)
                    <tr class="{{ $this->Ofeta($articulo->id) ? 'text-green-500 font-bold':'' }}">
                        <td class="rounder border px-4 py-2">{{ $articulo->id }}</td>
                        <td class="rounder border px-4 py-2">{{ $articulo->articulo }}</td>
                        <td class="rounder border px-4 py-2">{{ $articulo->categoria }}</td>
                        <td class="rounder border px-4 py-2">{{ $articulo->presentacion }}-{{ $articulo->unidad }}</td>
                        <td class="rounder border px-4 py-2">{{ $articulo->descuento }}</td>
                        <td class="rounder border px-4 py-2">{{ $articulo->unidadVenta }}</td>
                        <td class="rounder border px-4 py-2">{{ $articulo->precioI }}</td>
                        <td class="rounder border px-4 py-2">{{ $articulo->precioF }}</td>
                        <td class="rounder border px-4 py-2">{{ $articulo->caducidad }}</td>
                        <td class="rounder border px-4 py-2">{{ $articulo->detalles }}</td>
                        <td class="rounder border px-4 py-2">{{ $articulo->stockMinimo }}</td>
                        <td class="rounder border px-4 py-2">
                            @if ($articulo->suelto == 1)
                                <div class="w-8 h-8 p-2 grid justify-items-center content-center bg-green-400 rounded-full">{{ $articulo->stock }}</div>
                            @else
                                {{ $articulo->stock }}
                            @endif
                        </td>
                        <td class="rounder border px-4 py-2">
                            @if ($articulo->activo != 1)
                                <x-secondary-button wire:click="ActivarArticuloEdit({{ $articulo->id }})" wire:loading.attr="disabled" class="bg-green-700 hover:bg-green-500">
                                    Activar
                                </x-secondary-button>
                            @else
                                <x-secondary-button wire:click="confirmarArticuloEdit({{ $articulo->id }})" wire:loading.attr="disabled" class="bg-green-700 hover:bg-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </x-secondary-button>
                                <x-danger-button wire:click="confirmarArticuloDeletion({{ $articulo->id }})" wire:loading.attr="disabled">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </x-danger-button>
                            @endif
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
    </div>
    <div class="mt-2">
      {{ $articulos->links() }}
    </div>

   <!-- Delete User Confirmation Modal ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    <x-dialog-modal wire:model.live="confirmingArticuloDeletion">
        <x-slot name="title">
            {{ __('Eliminar articulo') }}
        </x-slot>

        <x-slot name="content">
            {{ __('¿Esta seguro de Desea Eliminar Un articulo?') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingArticuloDeletion', false)" wire:loading.attr="disabled">
                {{ __('Cancelar') }}
            </x-secondary-button>

            <x-danger-button class="ms-3" wire:click="deleteArticulo({{ $confirmingArticuloDeletion }})" wire:loading.attr="disabled">
                {{ __('Eliminar') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
    <!--Fin Delete  Confirmation Modal +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

    <!-- aDD User Confirmation Modal ***************************************************************-->
    <x-dialog-modal wire:model.live="confirmingArticuloAdd" maxWidth="2xl">
        <x-slot name="title">
            {{ __('Cargar Articulo') }}
        </x-slot>
        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-label for="articulo" value="{{ __('Articulo') }}" />
                <x-input id="articulo" type="text" class="mt-1 block w-full" wire:model='articulo' placeholder="Articulo"/>
                <x-input-error for="articulo" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-2 rounded">
                <x-label for="categoria" value="{{ __('Categoria') }}" />
                <select id="categoria"  class="block mt-1 w-full"  wire:model='categoria_id' class="rounded"/>
                <option value="">Seleccionar...</option>
                @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id}}"  >
                            {{ $categoria->id}}-{{ $categoria->categoria}}
                        </option>
                    @endforeach
                </select>
                <x-input-error for="categoria" class="mt-2" />
                <button wire:click='addCategoria'>Crear Categoria</button>

            </div>
            <div class="col-span-6 sm:col-span-4 mt-2 rounded grid grid-flow-col justify-stretch">
                <div>
                    <x-label for="presentacion" value="{{ __('Presentacion ') }}" />
                    <x-input id="presentacion" type="text" class="mt-1 block w-full" wire:model='presentacion' placeholder="Presentacion"  />
                    <x-input-error for="presentacion" class="mt-2" />

                </div>
                <div >
                    <x-label for="unidad" value="       (Ejemplo: 500-gm)" />
                    <select  id="inidad"  class="block mt-1 w-full" name="unidad" wire:model='unidad_id' class="rounded"/>
                         <option value="">Seleccionar...</option>
                         @foreach ($unidades as $unidad)
                            <option value="{{ $unidad->id}}"  >
                                    {{ $unidad->unidad}}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error for="unidad" class="mt-2" />
                </div>
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2 grid grid-flow-col justify-stretch" >
                <div class="">
                    <x-label for="descuento" value="'Descuento (Ejemplo: 10%') " />
                    <x-input id="descuento" type="text" class="mt-1 block w-full" wire:model='descuento' placeholder="Descuento"/>
                    <x-input-error for="descuento" class="mt-2" />
                </div>
                <div>
                    <x-label for="'unidadVenta" value="Unidad (Ejemplo: Unidad/Pack) " />
                    <x-input id="'unidadVenta" type="text" class="mt-1 block w-full" wire:model='unidadVenta' placeholder="Unidad"/>
                    <x-input-error for="'unidadVenta" class="mt-2" />
                </div>
            </div>
            <div class="col-span-6 sm:col-span-4 mt-2 grid grid-flow-col justify-stretch" >
                <div class="">
                    <x-label for="precioI" value="'Precio Inicial" />
                    <x-input id="precioI" type="text" class="mt-1 block w-full" wire:model='precioI' placeholder="0"/>
                    <x-input-error for="precioI" class="mt-2" />
                </div>
                <div>
                    <x-label for="precioF" value="Precio Final" />
                    <x-input id="precioF" type="text" class="mt-1 block w-full" wire:model='precioF' placeholder="0"/>
                    <x-input-error for="precioF" class="mt-2" />
                </div>
                <div>
                    <x-label for="porecentaje" value="Porecentaje" />
                    <x-input id="porecentaje" type="text" class="mt-1 block w-full" wire:model='porcentaje' placeholder="0"/>
                    <x-input-error for="porcentaje" class="mt-2" />
                </div>
                <div class="mt-2 justify-stretch">
                    <x-label for="porecentaje" value="calcular Porcentaje" />
                    <button wire:click='calcular()' class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded " >Calcular Precio</button>
                </div>
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2 grid grid-flow-col justify-stretch " >
                <div>
                    <x-label for="detalles" value="Detalles" />
                    <x-input id="detalles" type="text" class="mt-1 block w-full" wire:model='detalles'  />
                    <x-input-error for="detalles" class="mt-2" />
                </div>
                <div class="px-5">
                    <div >
                        <x-label for="Caducidad" value="Selecionar" />
                        <input wire:model='cad' id="caducidad" type="checkbox" value="Si" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="caducidad" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Caducidad</label>
                        {{ $a }}

                    </div>
                    <div >
                        <input wire:model='suelto' id="Suelto" type="checkbox" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="Suelto" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Suelto</label>
                    </div>
                </div>
            </div>

        {{-- -----------------------------------stock--------------------------------- --}}
            <div class="col-span-6 sm:col-span-4 mt-2 rounded">
                <x-label for="proveedor" value="{{ __('Proveedor') }}" />
                <select id="proveedor"  class="block mt-1 w-full"  wire:model='proveedor_id' class="rounded"/>
                <option value="">Seleccionar...</option>
                @foreach ($proveedores as $proveedor)
                        <option value="{{ $proveedor->id}}"  >
                            {{ $proveedor->id}}-{{ $proveedor->nombre}}-{{ $proveedor->rubro}}-{{ $proveedor->localidad}}
                        </option>
                    @endforeach
                </select>
                <x-input-error for="categoria" class="mt-2" />

            </div>

            <div class="col-span-6 sm:col-span-4 mt-2 grid grid-flow-col justify-stretch" >
                <div class="">
                    <x-label for="stockMinimo" value="Stock Minimo Deseable " />
                    <x-input id="stockMinimo" type="text" class="mt-1 block w-full" wire:model='stockMinimo' placeholder="Stock Minimo"/>
                    <x-input-error for="stockMinimo" class="mt-2" />
                </div>
                <div>
                    <x-label for="Stock" value="Stock " />
                    <x-input id="Stock" type="text" class="mt-1 block w-full" wire:model='stock' placeholder="Stock"/>
                    <x-input-error for="Stock" class="mt-2" />
                </div>
            </div>
        </x-slot>
        {{-------------------------------------fin stock---------------------------------}}
         <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingArticuloAdd', false)" wire:loading.attr="disabled">
                {{ __('Cancelar') }}
            </x-secondary-button>

            <x-primary-button class="ms-3" wire:click="saveArticulo()" wire:loading.attr="disabled">
                {{ __('Guardar') }}
            </x-primary-button>
        </x-slot>
    </x-dialog-modal>
      <!--Fin Add  Confirmation Modal **************************************************************-->


          <!-- aDD User Confirmation Modal **********************************************************-->
    <x-dialog-modal wire:model.live="confirmingArticuloEdit" maxWidth="2xl">
        <x-slot name="title">
            {{ __('Editar Articulo') }}
        </x-slot>
        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-label for="articulo" value="{{ __('Articulo') }}" />
                <x-input id="articulo" type="text" class="mt-1 block w-full" wire:model='articulo' placeholder="Articulo"/>
                <x-input-error for="articulo" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-2 rounded">
                <x-label for="categoria" value="{{ __('Categoria') }}" />
                <select id="categoria"  class="block mt-1 w-full"  wire:model='categoria_id' class="rounded"/>
                <option value="">Seleccionar...</option>
                @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id}}"  >
                            {{ $categoria->id}}-{{ $categoria->categoria}}
                        </option>
                    @endforeach
                </select>
                <x-input-error for="categoria" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2 rounded grid grid-flow-col justify-stretch">
                <div>
                    <x-label for="presentacion" value="{{ __('Presentacion ') }}" />
                    <x-input id="presentacion" type="text" class="mt-1 block w-full" wire:model='presentacion' placeholder="Presentacion"  />
                    <x-input-error for="presentacion" class="mt-2" />

                </div>
                <div >
                    <x-label for="unidad" value="       (Ejemplo: 500-gm)" />
                    <select  id="inidad"  class="block mt-1 w-full" name="unidad" wire:model='unidad_id' class="rounded"/>
                         <option value="">Seleccionar...</option>
                         @foreach ($unidades as $unidad)
                            <option value="{{ $unidad->id}}"  >
                                    {{ $unidad->unidad}}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error for="unidad" class="mt-2" />
                </div>
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2 grid grid-flow-col justify-stretch" >
                <div class="">
                    <x-label for="descuento" value="'Descuento (Ejemplo: 10%') " />
                    <x-input id="descuento" type="text" class="mt-1 block w-full" wire:model='descuento' placeholder="Descuento"/>
                    <x-input-error for="descuento" class="mt-2" />
                </div>
                <div>
                    <x-label for="'unidadVenta" value="Unidad (Ejemplo: Unidad/Pack) " />
                    <x-input id="'unidadVenta" type="text" class="mt-1 block w-full" wire:model='unidadVenta' placeholder="Unidad"/>
                    <x-input-error for="'unidadVenta" class="mt-2" />
                </div>
            </div>


            <div class="col-span-6 sm:col-span-4 mt-2 grid grid-flow-col justify-stretch " >
                <div>
                    <x-label for="detalles" value="Detalles" />
                    <x-input id="detalles" type="text" class="mt-1 block w-full" wire:model='detalles'   />
                    <x-input-error for="detalles" class="mt-2" />
                </div>

            </div>

        </x-slot>
         <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingArticuloEdit', false)" wire:loading.attr="disabled">
                {{ __('Cancelar') }}
            </x-secondary-button>

            <x-primary-button class="ms-3" wire:click="updateArticulo()" wire:loading.attr="disabled">
                {{ __('Guardar') }}
            </x-primary-button>
        </x-slot>
    </x-dialog-modal>
      <!--Fin Add  Confirmation Modal **************************************************************-->

       {{-- ----modal confirmar venta---- --}}
    <x-dialog-modal wire:model.live="activarArt" maxWidth="2xl">
        <x-slot name="title">
            {{ __('Cambio de estado del Articulo') }}
        </x-slot>

        <x-slot name="content">
            {{ __('¿Esta seguro de Desea Activar este Articulo? Este Estara disponible Nuevamente') }}
        </x-slot>

        <x-slot name="footer">
            <x-danger-button wire:click="$toggle('activarArt', false)" wire:loading.attr="disabled">
                {{ __('Cancelar') }}
            </x-danguer-button>

            <x-secondary-button class="ms-3" wire:click="ConfirmarActivar()" wire:loading.attr="disabled">
                {{ __('Activar') }}
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>

     {{-- ---- Fin modal confirmar venta---- --}}
    <x-dialog-modal wire:model.live="categoriaAdd" maxWidth="2xl">
        <x-slot name="title">
            {{ __('Cargar Categoria') }}
        </x-slot>
        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-label for="categoria" value="{{ __('Categoria') }}" />
                <x-input id="categoria" type="text" class="mt-1 block w-full" wire:model="categoria" name='categoria' />
                <x-input-error for="categoria" class="mt-2" />
            </div>

        </x-slot>
        <x-slot name="footer">
            <x-danger-button wire:click="$toggle('categoriaAdd', false)" wire:loading.attr="disabled">
                {{ __('Cancelar') }}
            </x-danger-button>

            <x-secondary-button class="ms-3" wire:click="saveCategoria()" wire:loading.attr="disabled">
                {{ __('Guardar') }}
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>



</div>

<div class="w-auto p-2 sm:px-5 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
    <div class="mt-4 text-2xl flex justify-between shadow-inner">
        <div>Articulo</div>
        <div class="mr-2">

            <x-button wire:click='confirmarArticuloAdd' class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Crear Nuevo articulo
            </x-button>
        </div>
    </div>

    <div class="mt-3 w-full ">
        <div class="flex justify-between">
            <div>
                <input wire:model.live='q' type="search" placeholder="Buscar" class="shadow appearance-none border rounded w-full py-2 px-3

                text-gray-706 leading-tight focus:outline-none focus: shadow-outline placeholder-blue-400" name="">
            </div>
            <div class="mr-2">
                <input class="mr-2 leading-tight" type="checkbox" wire:model.live ='active'/ value="1" checked>Articulos Activos
            </div>

        </div>
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <td class="px-4 py-2">
                        <div class="flex items-center" >
                        <button wire:click="sortby('id')">Id</button>
                        <x-sort-icon 
            sort-field="id': sortBy=$sortBy, sortAsc=$sortAsc/>
                        </div>
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="sortby('articulo')">Articulo</button>
                            <x-sort-icon 
            sort-field="apellido" 
            :sort-by="$sortBy" 
            :sort-asc="$sortAsc" '>

                        </div>
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="sortby('categoria_id')">Categoria</button>
                            <x-sort-icon 
            sort-field="nombre" 
            :sort-by="$sortBy" 
            :sort-asc="$sortAsc" /> 
                        </div>
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex items-center">
                            <button >Presentacion</button>
                            <x-sort-icon 
            sort-field="telefono" 
            :sort-by="$sortBy" 
            :sort-asc="$sortAsc" /> 
                        </div>
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="sortby('descuento')">Desc.</button>
                            <x-sort-icon 
            sort-field="telefono" 
            :sort-by="$sortBy" 
            :sort-asc="$sortAsc" /> 
                        </div>
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="sortby('unidadVenta')">Unidad Cant.</button>
                            <x-sort-icon 
            sort-field="telefono" 
            :sort-by="$sortBy" 
            :sort-asc="$sortAsc" /> 
                        </div>
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="sortby('precioI')">Precio Inicial</button>
                            <x-sort-icon 
            sort-field="telefono" 
            :sort-by="$sortBy" 
            :sort-asc="$sortAsc" /> 
                        </div>
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="sortby('precioF')">Precio Final</button>
                            <x-sort-icon 
            sort-field="telefono" 
            :sort-by="$sortBy" 
            :sort-asc="$sortAsc" /> 
                        </div>
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="sortby('caducidad')">Cadc.</button>
                            <x-sort-icon 
            sort-field="telefono" 
            :sort-by="$sortBy" 
            :sort-asc="$sortAsc" /> 
                        </div>
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="sortby('detalles')">Detalles</button>
                            <x-sort-icon 
            sort-field="telefono" 
            :sort-by="$sortBy" 
            :sort-asc="$sortAsc" /> 
                        </div>
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="sortby('stockMinimo')">Stock Min.</button>
                            <x-sort-icon 
            sort-field="telefono" 
            :sort-by="$sortBy" 
            :sort-asc="$sortAsc" /> 
                        </div>
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="sortby('stock')">Stock
                                <div class="w-15 h-8 p-2 grid justify-items-center content-center bg-green-400 rounded-full">suelto</div>

                            </button>
                            <x-sort-icon 
            sort-field="telefono" 
            :sort-by="$sortBy" 
            :sort-asc="$sortAsc" /> 
                        </div>
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex items-center">Accion</div>

                    </td>
                </tr>
            </thead>
            <tbody>
                @foreach ($articulos as $articulo)
                    <tr class="{{ $this->Ofeta($articulo->id) ? 'text-green-500 font-bold':'' }}">
                        <td class="rounder border px-4 py-2">{{ $articulo->id }}</td>
                        <td class="rounder border px-4 py-2">{{ $articulo->articulo }}</td>
                        <td class="rounder border px-4 py-2">{{ $articulo->categoria }}</td>
                        <td class="rounder border px-4 py-2">{{ $articulo->presentacion }}-{{ $articulo->unidad }}</td>
                        <td class="rounder border px-4 py-2">{{ $articulo->descuento }}</td>
                        <td class="rounder border px-4 py-2">{{ $articulo->unidadVenta }}</td>
                        <td class="rounder border px-4 py-2">{{ $articulo->precioI }}</td>
                        <td class="rounder border px-4 py-2">{{ $articulo->precioF }}</td>
                        <td class="rounder border px-4 py-2">{{ $articulo->caducidad }}</td>
                        <td class="rounder border px-4 py-2">{{ $articulo->detalles }}</td>
                        <td class="rounder border px-4 py-2">{{ $articulo->stockMinimo }}</td>
                        <td class="rounder border px-4 py-2">
                            @if ($articulo->suelto == 1)
                                <div class="w-8 h-8 p-2 grid justify-items-center content-center bg-green-400 rounded-full">{{ $articulo->stock }}</div>
                            @else
                                {{ $articulo->stock }}
                            @endif
                        </td>
                        <td class="rounder border px-4 py-2">
                            @if ($articulo->activo != 1)
                                <x-secondary-button wire:click="ActivarArticuloEdit({{ $articulo->id }})" wire:loading.attr="disabled" class="bg-green-700 hover:bg-green-500">
                                    Activar
                                </x-secondary-button>
                            @else
                                <x-secondary-button wire:click="confirmarArticuloEdit({{ $articulo->id }})" wire:loading.attr="disabled" class="bg-green-700 hover:bg-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </x-secondary-button>
                                <x-danger-button wire:click="confirmarArticuloDeletion({{ $articulo->id }})" wire:loading.attr="disabled">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </x-danger-button>
                            @endif
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
    </div>
    <div class="mt-2">
      {{ $articulos->links() }}
    </div>

   <!-- Delete User Confirmation Modal ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    <x-dialog-modal wire:model.live="confirmingArticuloDeletion">
        <x-slot name="title">
            {{ __('Eliminar articulo') }}
        </x-slot>

        <x-slot name="content">
            {{ __('¿Esta seguro de Desea Eliminar Un articulo?') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingArticuloDeletion', false)" wire:loading.attr="disabled">
                {{ __('Cancelar') }}
            </x-secondary-button>

            <x-danger-button class="ms-3" wire:click="deleteArticulo({{ $confirmingArticuloDeletion }})" wire:loading.attr="disabled">
                {{ __('Eliminar') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
    <!--Fin Delete  Confirmation Modal +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

    <!-- aDD User Confirmation Modal ***************************************************************-->
    <x-dialog-modal wire:model.live="confirmingArticuloAdd" maxWidth="2xl">
        <x-slot name="title">
            {{ __('Cargar Articulo') }}
        </x-slot>
        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-label for="articulo" value="{{ __('Articulo') }}" />
                <x-input id="articulo" type="text" class="mt-1 block w-full" wire:model='articulo' placeholder="Articulo"/>
                <x-input-error for="articulo" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-2 rounded">
                <x-label for="categoria" value="{{ __('Categoria') }}" />
                <select id="categoria"  class="block mt-1 w-full"  wire:model='categoria_id' class="rounded">
                <option value="">Seleccionar...</option>
                @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id}}"  >
                            {{ $categoria->id}}-{{ $categoria->categoria}}
                        </option>
                    @endforeach
                </select>
                <x-input-error for="categoria" class="mt-2" />
                <button wire:click='addCategoria'>Crear Categoria</button>

            </div>
            <div class="col-span-6 sm:col-span-4 mt-2 rounded grid grid-flow-col justify-stretch">
                <div>
                    <x-label for="presentacion" value="{{ __('Presentacion ') }}" />
                    <x-input id="presentacion" type="text" class="mt-1 block w-full" wire:model='presentacion' placeholder="Presentacion"  />
                    <x-input-error for="presentacion" class="mt-2" />

                </div>
                <div >
                    <x-label for="unidad" value="       (Ejemplo: 500-gm)" />
                    <select  id="unidad"  class="block mt-1 w-full" name="unidad" wire:model='unidad_id' class="rounded">
                         <option value="">Seleccionar...</option>
                         @foreach ($unidades as $unidad)
                            <option value="{{ $unidad->id}}"  >
                                    {{ $unidad->unidad}}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error for="unidad" class="mt-2" />
                </div>
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2 grid grid-flow-col justify-stretch" >
                <div class="">
                    <x-label for="descuento" value="Descuento (Ejemplo: 10%) " />
                    <x-input id="descuento" type="text" class="mt-1 block w-full" wire:model='descuento' placeholder="Descuento"/>
                    <x-input-error for="descuento" class="mt-2" />
                </div>
                <div>
                    <x-label for="unidadVenta" value="Unidad (Ejemplo: Unidad/Pack) " />
                    <x-input id="unidadVenta" type="text" class="mt-1 block w-full" wire:model='unidadVenta' placeholder="Unidad"/>
                    <x-input-error for="unidadVenta" class="mt-2" />
                </div>
            </div>
            <div class="col-span-6 sm:col-span-4 mt-2 grid grid-flow-col justify-stretch" >
                <div class="">
                    <x-label for="precioI" value="'Precio Inicial" />
                    <x-input id="precioI" type="text" class="mt-1 block w-full" wire:model='precioI' placeholder="0"/>
                    <x-input-error for="precioI" class="mt-2" />
                </div>
                <div>
                    <x-label for="precioF" value="Precio Final" />
                    <x-input id="precioF" type="text" class="mt-1 block w-full" wire:model='precioF' placeholder="0"/>
                    <x-input-error for="precioF" class="mt-2" />
                </div>
                <div>
                    <x-label for="porcentaje" value="Porcentaje" />
                    <x-input id="porcentaje" type="text" class="mt-1 block w-full" wire:model='porcentaje' placeholder="0"/>
                    <x-input-error for="porcentaje" class="mt-2" />
                </div>
                <div class="mt-2 justify-stretch">
                    <x-label for="porecentaje" value="calcular Porcentaje" />
                    <button wire:click='calcular' class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded " >Calcular Precio</button>
                </div>
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2 grid grid-flow-col justify-stretch " >
                <div>
                    <x-label for="detalles" value="Detalles" />
                    <x-input id="detalles" type="text" class="mt-1 block w-full" wire:model='detalles'  />
                    <x-input-error for="detalles" class="mt-2" />
                </div>
                <!-- <div class="px-5">
                    <div >
                        <x-label for="Caducidad" value="Selecionar" />
                        <input wire:model='cad' id="caducidad" type="checkbox" value="Si" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="caducidad" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Caducidad</label>
                        {{ $a }}

                    </div>
                    <div >
                        <input wire:model='suelto' id="Suelto" type="checkbox" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="Suelto" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Suelto</label>
                    </div>
                </div> -->
            </div>

        {{-- -----------------------------------stock--------------------------------- --}}
            <div class="col-span-6 sm:col-span-4 mt-2 rounded">
                <x-label for="proveedor" value="{{ __('Proveedor') }}" />
                <select id="proveedor"  class="block mt-1 w-full"  wire:model='proveedor_id' class="rounded">
                <option value="">Seleccionar...</option>
                @foreach ($proveedores as $proveedor)
                        <option value="{{ $proveedor->id}}"  >
                            {{ $proveedor->id}}-{{ $proveedor->nombre}}-{{ $proveedor->rubro}}-{{ $proveedor->localidad}}
                        </option>
                    @endforeach
                </select>
                <x-input-error for="categoria" class="mt-2" />

            </div>

            <div class="col-span-6 sm:col-span-4 mt-2 grid grid-flow-col justify-stretch" >
                <div class="">
                    <x-label for="stockMinimo" value="Stock Minimo Deseable " />
                    <x-input id="stockMinimo" type="text" class="mt-1 block w-full" wire:model='stockMinimo' placeholder="Stock Minimo"/>
                    <x-input-error for="stockMinimo" class="mt-2" />
                </div>
                <div>
                    <x-label for="Stock" value="Stock " />
                    <x-input id="Stock" type="text" class="mt-1 block w-full" wire:model='stock' placeholder="Stock"/>
                    <x-input-error for="Stock" class="mt-2" />
                </div>
            </div>
        </x-slot>
        {{-------------------------------------fin stock---------------------------------}}
         <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingArticuloAdd', false)" wire:loading.attr="disabled">
                {{ __('Cancelar') }}
            </x-secondary-button>

            <x-primary-button class="ms-3" wire:click="saveArticulo()" wire:loading.attr="disabled">
                {{ __('Guardar') }}
            </x-primary-button>
            

        </x-slot>
    </x-dialog-modal>
      <!--Fin Add  Confirmation Modal **************************************************************-->


          <!-- aDD User Confirmation Modal **********************************************************-->
    <x-dialog-modal wire:model.live="confirmingArticuloEdit" maxWidth="2xl">
        <x-slot name="title">
            {{ __('Editar Articulo') }}
        </x-slot>
        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-label for="articulo" value="{{ __('Articulo') }}" />
                <x-input id="articulo" type="text" class="mt-1 block w-full" wire:model='articulo' placeholder="Articulo"/>
                <x-input-error for="articulo" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4 mt-2 rounded">
                <x-label for="categoria" value="{{ __('Categoria') }}" />
                <select id="categoria"  class="block mt-1 w-full"  wire:model='categoria_id' class="rounded"/>
                <option value="">Seleccionar...</option>
                @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id}}"  >
                            {{ $categoria->id}}-{{ $categoria->categoria}}
                        </option>
                    @endforeach
                </select>
                <x-input-error for="categoria" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2 rounded grid grid-flow-col justify-stretch">
                <div>
                    <x-label for="presentacion" value="{{ __('Presentacion ') }}" />
                    <x-input id="presentacion" type="text" class="mt-1 block w-full" wire:model='presentacion' placeholder="Presentacion"  />
                    <x-input-error for="presentacion" class="mt-2" />

                </div>
                <div >
                    <x-label for="unidad" value="       (Ejemplo: 500-gm)" />
                    <select  id="inidad"  class="block mt-1 w-full" name="unidad" wire:model='unidad_id' class="rounded"/>
                         <option value="">Seleccionar...</option>
                         @foreach ($unidades as $unidad)
                            <option value="{{ $unidad->id}}"  >
                                    {{ $unidad->unidad}}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error for="unidad" class="mt-2" />
                </div>
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2 grid grid-flow-col justify-stretch" >
                <div class="">
                    <x-label for="descuento" value="'Descuento (Ejemplo: 10%') " />
                    <x-input id="descuento" type="text" class="mt-1 block w-full" wire:model='descuento' placeholder="Descuento"/>
                    <x-input-error for="descuento" class="mt-2" />
                </div>
                <div>
                    <x-label for="'unidadVenta" value="Unidad (Ejemplo: Unidad/Pack) " />
                    <x-input id="'unidadVenta" type="text" class="mt-1 block w-full" wire:model='unidadVenta' placeholder="Unidad"/>
                    <x-input-error for="'unidadVenta" class="mt-2" />
                </div>
            </div>


            <div class="col-span-6 sm:col-span-4 mt-2 grid grid-flow-col justify-stretch " >
                <div>
                    <x-label for="detalles" value="Detalles" />
                    <x-input id="detalles" type="text" class="mt-1 block w-full" wire:model='detalles'   />
                    <x-input-error for="detalles" class="mt-2" />
                </div>

            </div>
        </x-slot>
         <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingArticuloEdit', false)" wire:loading.attr="disabled">
                {{ __('Cancelar') }}
            </x-secondary-button>

            <x-primary-button class="ms-3" wire:click="updateArticulo()" wire:loading.attr="disabled">
                {{ __('Guardar') }}
            </x-primary-button>
           
        </x-slot>
    </x-dialog-modal>
      <!--Fin Add  Confirmation Modal **************************************************************-->

       {{-- ----modal confirmar venta---- --}}
    <x-dialog-modal wire:model.live="activarArt" maxWidth="2xl">
        <x-slot name="title">
            {{ __('Cambio de estado del Articulo') }}
        </x-slot>

        <x-slot name="content">
            {{ __('¿Esta seguro de Desea Activar este Articulo? Este Estara disponible Nuevamente') }}
        </x-slot>

        <x-slot name="footer">
            <x-danger-button wire:click="$toggle('activarArt', false)" wire:loading.attr="disabled">
                {{ __('Cancelar') }}
            </x-danguer-button>

            <x-secondary-button class="ms-3" wire:click="ConfirmarActivar()" wire:loading.attr="disabled">
                {{ __('Activar') }}
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>

     {{-- ---- Fin modal confirmar venta---- --}}
    <x-dialog-modal wire:model.live="categoriaAdd" maxWidth="2xl">
        <x-slot name="title">
            {{ __('Cargar Categoria') }}
        </x-slot>
        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-label for="categoria" value="{{ __('Categoria') }}" />
                <x-input id="categoria" type="text" class="mt-1 block w-full" wire:model="categoria" name='categoria' />
                <x-input-error for="categoria" class="mt-2" />
            </div>

        </x-slot>
        <x-slot name="footer">
            <x-danger-button wire:click="$toggle('categoriaAdd', false)" wire:loading.attr="disabled">
                {{ __('Cancelar') }}
            </x-danger-button>

            <x-secondary-button class="ms-3" wire:click="saveCategoria()" wire:loading.attr="disabled">
                {{ __('Guardar') }}
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>



</div>
