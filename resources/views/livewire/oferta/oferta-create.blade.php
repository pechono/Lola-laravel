<div class="w-3/5 mx-auto sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
        <div class="w-3/5 p-2 sm:px-5 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
            <div class="mt-4 text-2xl flex justify-between shadow-inner">
                <div>Crear Oferta</div>

            </div>
            <div class="flex  justify-center ">
                {{-- form --}}
                <div class="mt-4 text-2xln justify-center">
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="oferta" value="{{'Nombre Oferta'}}" />
                        <x-input id="oferta" type="text" class="mt-1 block w-full" wire:model='oferta' placeholder="Nombre Oferta"/>
                        <x-input-error for="oferta" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="detalles" value="{{'Detalles'}}" />
                        <x-input id="detalles" type="text" class="mt-1 block w-full" wire:model='detalles' placeholder="Detalles Oferta"/>
                        <x-input-error for="detalles" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="precio" value="{{'Precio'}}" />
                        <x-input id="precio" type="text" class="mt-1 block w-full" wire:model='precio' placeholder="Precio Oferta"/>
                        <x-input-error for="precio" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="tiempo" value="{{'Tiempo'}}" />
                        <x-input id="tiempo" type="text" class="mt-1 block w-full" wire:model='tiempo' placeholder="tiempo Oferta"/>
                        <x-input-error for="tiempo" class="mt-2" />
                    </div>
                    @if ($mostrarLabel)
                    <div class="col-span-6 sm:col-span-4 mt-4 text-lg">
                        <x-label for="tiempo" value="Cantidad de Ofertas Disponibles: {{ $this->numeroDeOferta()}}" />
                    </div>
                    @endif


                </div>
                @if ($mostrarLabel)
                {{-- tabla --}}
                <div class=" justify-center">
                    <table class="table-auto w-full rounded-md mt-10">
                        <tr>

                            <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg ">Id</td>
                            <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg ">Articulos</td>
                            <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg ">Precio Inicial</td>
                            <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg ">Precio Final</td>
                            <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg ">Stock</td>

                        </tr>
                        @forelse ($artOfertados as $item)
                        <tr>
                            <td class="rounder border px-4 py-2" >{{ $item->id }} </td>
                            <td class="rounder border px-4 py-2" >{{ $item->articulo}}-{{ $item->presentacion }}{{ $item->unidad }}</td>
                            <td class="rounder border px-4 py-2" >{{ $item->precioI}}</td>
                            <td class="rounder border px-4 py-2" >{{ $item->precioF}}</td>
                            <td class="rounder border px-4 py-2" >{{ $item->stock}}</td>

                        </tr>
                        @empty

                        @endforelse



                    </table>
                </div>
                @endif
            </div>
            <div class=" flex justify-end mt-4">
                <button wire:click='mostrarArt' class="p-2 text-white bg-sky-600 hover:bg-sky-300 rounded-md">Agregar</button>
                @if ($mostrarLabel)
                    <button wire:click='mostrarArt' class="p-2 text-white bg-sky-600 hover:bg-sky-300 rounded-md">crear Oferta</button>
                @endif
            </div>



            <x-dialog-modal wire:model.live="modalArt" >
                <x-slot name="title">

                    <div class="flex justify-between">
                    <div>  {{ __('Cambio de estado del Articulo') }}</div>
                    <div>
                        <button wire:click="delete" wire:loading.attr="disabled" class=" bg-sky-600 hover:bg-sky-300 text-white rounded-md p-2">
                        Borrar Seleccion
                        <button>
                    </div>
                    </div>
                </x-slot>

                <x-slot name="content">
                    <table class="table-auto w-full">
                        <thead class="text-lg">
                            <tr>
                                <td class="px-4 py-2">
                                    <div class="flex items-center" >
                                    <button wire:click="sortby('id')">Id</button>
                                    <x-sort-icon sortFiel='id': sortBy=$sortBy, sortAsc=$sortAsc/>
                                    </div>
                                </td>
                                <td class="px-4 py-2">
                                    <div class="flex items-center">
                                        <Button wire:click="sortby('articulo')">Articulo</Button>
                                        <x-sort-icon sortFiel='apellido': sort-by='$sortBy' : sort-asc='$sortAsc'>

                                    </div>
                                </td>

                                <td class="px-4 py-2">
                                    <div class="flex items-center">
                                        <Button wire:click="sortby('descuento')">Desc.</Button>
                                        <x-sort-icon sortFiel='telefono': sort-by='$sortBy' : sort-asc='$sortAsc/'>
                                    </div>
                                </td>
                                <td class="px-4 py-2">
                                    <div class="flex items-center">
                                        <Button wire:click="sortby('unidadVenta')">Unidad Cant.</Button>
                                        <x-sort-icon sortFiel='telefono': sort-by='$sortBy' : sort-asc='$sortAsc/'>
                                    </div>
                                </td>

                                <td class="px-4 py-2">
                                    <div class="flex items-center">
                                        <Button wire:click="sortby('precioI')">Precio Final</Button>
                                        <x-sort-icon sortFiel='telefono': sort-by='$sortBy' : sort-asc='$sortAsc/'>
                                    </div>
                                </td>


                                <td class="px-4 py-2">
                                    <div class="flex items-center">
                                        <Button wire:click="sortby('stockMinimo')">S. Min.</Button>
                                        <x-sort-icon sortFiel='telefono': sort-by='$sortBy' : sort-asc='$sortAsc/'>
                                    </div>
                                </td>
                                <td class="px-4 py-2">
                                    <div class="flex items-center">
                                        <Button wire:click="sortby('stock')">Stock
                                            <div class="w-15 h-8 p-2 grid justify-items-center content-center bg-green-400 rounded-full">suelto</div>

                                        </Button>
                                        <x-sort-icon sortFiel='telefono': sort-by='$sortBy' : sort-asc='$sortAsc/'>
                                    </div>
                                </td>
                                <td class="px-4 py-2">
                                    <div class="flex items-center">
                                        <Button wire:click="sortby('stockMinimo')">venta.</Button>
                                        <x-sort-icon sortFiel='telefono': sort-by='$sortBy' : sort-asc='$sortAsc/'>
                                    </div>
                                </td>
                                <td class="px-4 py-2">
                                    <div class="flex items-center">Accion</div>

                                </td>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($articulos as $articulo)
                            <tr>
                                <td class="rounder border px-4 py-2 text-lg">{{ $articulo->id }}</td>
                                <td class="rounder border px-4 py-2 text-lg">{{ $articulo->articulo }}{{ $articulo->presentacion }}-{{ $articulo->unidad }}</td>
                                <td class="rounder border px-4 py-2 text-lg">{{ $articulo->descuento }}</td>
                                <td class="rounder border px-4 py-2 text-lg">{{ $articulo->precioI }}</td>
                                <td class="rounder border px-4 py-2 text-lg">{{ $articulo->precioF }}</td>
                                <td class="rounder border px-4 py-2 text-lg">
                                    {{-- {{ $articulo->stockMinimo }} --}}
                                    <div class="w-8 h-8 p-2 grid justify-items-center content-center rounded-full {{ ($articulo->stockMinimo >= $articulo->stock) ? 'bg-red-400' : '' }}">
                                        {{ $articulo->stockMinimo }}
                                    </div>
                                </td>
                                <td class="rounder border px-4 py-2 text-lg">
                                    <div class="w-8 h-8 p-2 grid justify-items-center content-center rounded-full {{ $articulo->suelto == 1 ? 'bg-green-400' : '' }}">
                                        {{ $articulo->stock }}
                                    </div>
                                </td>
                                <td class="rounder border px-4 py-2 text-lg">{{ $this->seVendio($articulo->id) }}</td>

                                <td class="rounder border px-4 py-2">
                                    @if ($this->botonOferta($articulo->id))
                                    <button wire:click="deleteOferta({{ $articulo->id }})" wire:loading.attr="disabled" class="text-white bg-sky-500 hover:bg-sky-300 p-2 rounded-md">
                                    elimina  Selecionar
                                    </button>
                                @else
                                    <button wire:click="addOferta({{ $articulo->id }})" wire:loading.attr="disabled" class="text-white bg-sky-500 hover:bg-sky-300 p-2 rounded-md">
                                    Selecionar
                                    </button>
                                @endif
                                </td>

                                {{-- @endif --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <table class="text-lg">
                        <tr>
                            <td>La Cantidad de Ofertas Disponibles es:</td>
                            <td>{{ $this->numeroDeOferta()}} </td>
                        </tr>
                    </table>

                </x-slot>

                <x-slot name="footer">
                    {{-- <x-danger-button wire:click="$toggle('modalArt', false)" wire:loading.attr="disabled">
                        {{ __('Cancelar') }}
                    </x-danguer-button> --}}

                    <x-secondary-button class="ms-3" wire:click="cerrarModal()" wire:loading.attr="disabled">
                        {{ __('Activar') }}
                    </x-secondary-button>
                </x-slot>
            </x-dialog-modal>
        </div>
    </div>
</div>