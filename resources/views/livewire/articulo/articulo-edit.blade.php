<div>
    <x-dialog-modal wire:model.live="confirmingArticuloEdit" maxWidth="2xl">
        <x-slot name="title">
            {{ __('Editar Articulo') }}
        </x-slot>
        <x-slot name="content">
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
</div>
