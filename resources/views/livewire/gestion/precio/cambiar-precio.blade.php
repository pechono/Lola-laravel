<div class="p-2  w-full sm:px-5 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
    <div class="flex justify-between">
         <div class="text-xl">Precio Por Articulo</div>
    </div>
        <div>Selecionar Articulo Para Cambiar Precio</div>
    <div class="mt-3">
        
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
                            <Button >Presentacion</Button>
                            <x-sort-icon sortFiel='telefono': sort-by='$sortBy' : sort-asc='$sortAsc/'>
                        </div>
                    </td>
                    
                    <td class="px-4 py-2">
                        <div class="flex items-center">
                            <Button wire:click="sortby('precioI')">Precio Inicial</Button>
                            <x-sort-icon sortFiel='telefono': sort-by='$sortBy' : sort-asc='$sortAsc/'>
                        </div>
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex items-center">
                            <Button wire:click="sortby('precioF')">Precio Final</Button>
                            <x-sort-icon sortFiel='telefono': sort-by='$sortBy' : sort-asc='$sortAsc/'>
                        </div>
                    </td>
                    
                    <td class="px-4 py-2">
                        <div class="flex items-center">
                            <Button wire:click="sortby('stockMinimo')">Stock Min.</Button>
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
                        <div class="flex items-center">Accion</div>

                    </td>
                </tr>
            </thead>
            <tbody>

                @foreach ($articulos as $articulo)
                <tr>
                    <td class="rounder border px-4 py-2">{{ $articulo->id }}</td>
                    <td class="rounder border px-4 py-2">{{ $articulo->articulo }}</td>
                    <td class="rounder border px-4 py-2">{{ $articulo->presentacion }}-{{ $articulo->unidad }}</td>

                    <td class="rounder border px-4 py-2">{{ $articulo->precioI }}</td>
                    <td class="rounder border px-4 py-2">{{ $articulo->precioF }}</td>
                    
                    <td class="rounder border px-4 py-2">{{ $articulo->stockMinimo }}</td>
                    <td class="rounder border px-4 py-2">
                        @if ($articulo->suelto==1)
                            <div class="w-8 h-8 p-2 grid justify-items-center content-center bg-green-400 rounded-full">{{ $articulo->stock }}</div>

                        @else
                            {{ $articulo->stock }}
                        @endif

                    </td>
                        <td class="rounder border px-4 py-2">
                            <x-secondary-button  wire:click="cambiarPrecio({{ $articulo->id }})" wire:loading.attr="disabled" class="bg-green-700 hover:bg-green-500">
                                Activar
                            </x-secondary-button>
                        </td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if ($modalPrecio){{-- ---2.1---- Articulos->Grupo --}}
    <x-dialog-modal wire:model.live="modalPrecio" maxWidth="2xl">
    <x-slot name="title">
        <div class="flex justify-between m-5">
            <div class="text-xl">Cambiar Precio</div>
        </div>

    </x-slot>
    <x-slot name="content">
        <div class="col-span-6 sm:col-span-4 text-xl my-10">
           
            <table class="table-auto w-full rounded-md mt-10">
                <tr>
                   
                    <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg ">Articulo</td>
                    <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg ">Presentacion</td>
                </tr>
                <tr>
                    <td class="rounder border px-4 py-2" >{{ $art->id }} - {{ $art->articulo }}</td>
                    <td class="rounder border px-4 py-2" >{{ $art->presentacion }} - {{ $art->unidad }}</td>

                </tr>
                <tr>
                    <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg ">Precio Inicial</td>
                    <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg ">Precio Final</td>
                </tr>
                <tr>
                    <td class="rounder border px-4 py-2" >{{ $art->precioI }}</td>
                    <td class="rounder border px-4 py-2" >{{ $art->precioF }}</td>

                </tr>

            </table>
            <div class="col-span-6 sm:col-span-4 mt-2 grid grid-flow-col justify-stretch " >
                <div class="mr-2">
                    <x-label for="precioI" value="Precio Inicial"  class=" text-xl "/>
                    <x-input id="precioI" type="numeric" class="mt-1 block w-full p-1" wire:model='precioI' placeholder="0"/>
                    <x-input-error for="precioI" class="mt-2" />
                </div>
                <div class="mr-2">
                    <x-label for="precioF" value="Precio Final" class=" text-xl" />
                    <x-input id="precioF" type="numeric" class="mt-1 block w-full p-1" wire:model='precioF' placeholder="0"/>
                    <x-input-error for="precioF" class="mt-2" />
                </div>
                <div class="mr-2">
                    <x-label for="porecentaje" value="Porecentaje" class=" text-xl" />
                    <x-input id="porecentaje" type="numeric" class="mt-1 block w-full p-1" wire:model='porcentaje' placeholder="0"/>
                    <x-input-error for="porcentaje" class="mt-2" />
                </div>
                <div class="mr-2 justify-stretch">
                    <x-label for="porecentaje" value="calcular Porcentaje" />
                    <button wire:click='calcular()' class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded " >Calcular Precio</button>
                </div>
            </div>
        </div>
        <div class="flex justify-end items-center  bg-sky-400/50 p-1">
            <button wire:click='nuevoPrecio({{ $art->id }})' class="bg-green-500 hover:bg-green-700 text-white  py-2 px-4 rounded text-lg" >Cambiar Precio</button>
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button class="ms-3" wire:click="cerrar()" wire:loading.attr="disabled">
            {{ __('Cerrar') }}
        </x-secondary-button>
    </x-slot>
    </x-dialog-modal>
@endif
</div>
