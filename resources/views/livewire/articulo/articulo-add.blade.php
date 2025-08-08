<div class="w-auto p-2 sm:px-5 bg-white">
   <div class="mt-4 text-2xl flex justify-between shadow-inner">
            <div>Articulo</div>
            <div class="mr-2">

                <x-button wire:click='confirmarArticuloAdd' class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Crear Nuevo articulo
                </x-button>
            </div>
    </div> {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}

    <!-- aDD User Confirmation Modal ***************************************************************-->
    <x-dialog-modal wire:model.live="confirmingArticuloAdd" maxWidth="2xl">
        <x-slot name="title">
            {{ __('Cargar Articulo') }}
        </x-slot>
        <x-slot name="content">
            {{-- <div class="col-span-6 sm:col-span-4 flex">
                <div class=" w-30%">
                    <x-label for="codigo" value="{{ __('Codigo') }}" />
                    <x-input id="codigo" type="text" class="mt-1 block w-full" wire:model='codigo' placeholder="Codigo"/>
                    <x-input-error for="codigo" class="mt-2" />
                </div>
                <div>
                    <x-label for="articulo" value="{{ __('Articulo') }}" />
                    <x-input id="articulo" type="text" class="mt-1 block w-full" wire:model='articulo' placeholder="Articulo"/>
                    <x-input-error for="articulo" class="mt-2" />
                </div>
                
            </div> --}}
            <div class="col-span-6 sm:col-span-4 flex gap-4">
                <!-- Campo Código (30%) -->
                <div class="w-[30%]">
                    <x-label for="codigo" value="{{ __('Codigo') }}" />
                    <x-input id="codigo" type="text" class="mt-1 block w-full" wire:model="codigo" placeholder="Codigo"/>
                    <x-input-error for="codigo" class="mt-2" />
                </div>
                
                <!-- Campo Artículo (70%) -->
                <div class="flex-grow"> <!-- O usar w-[70%] -->
                    <x-label for="articulo" value="{{ __('Articulo') }}" />
                    <x-input id="articulo" type="text" class="mt-1 block w-full" wire:model="articulo" placeholder="Articulo"/>
                    <x-input-error for="articulo" class="mt-2" />
                </div>
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
