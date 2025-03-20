<div class="w-auto p-2 sm:px-5 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
    <div class="mt-4 text-2xl flex justify-between shadow-inner">
        <div>Ofertas</div>
        <div class="mr-2">

            <x-button wire:click='confirmarArticuloAdd' class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Crear Nuevo Oferta
            </x-button>
        </div>
    </div>

    <div class="mt-3 w-full ">
        <div class="flex justify-between">
            <div class="flex w-auto">
                <input wire:model.live='q' type="search" placeholder="Buscar" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-706 leading-tight focus:outline-none focus:shadow-outline placeholder-blue-400" name="">
            </div>

            <div class="mr-2">
                <input class="mr-2 leading-tight" type="checkbox" wire:model.live ='active'/ value="1" checked>Articulos Activos
                <a href="{{ route('stockImprimir') }}" target="_blank" class="bg-green-600 hover:bg-green-300 text-white rounded-md px-3 py-2 ml-2 text-center w-48 ">Imprimir Stock Actual</a>
            </div>

        </div>
        <table class="table-auto w-auto">
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
                            <Button wire:click="sortby('categoria_id')">Categoria</Button>
                            <x-sort-icon sortFiel='nombre': sort-by='$sortBy' : sort-asc='$sortAsc'/>
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
                            <Button wire:click="sortby('caducidad')">Cadc.</Button>
                            <x-sort-icon sortFiel='telefono': sort-by='$sortBy' : sort-asc='$sortAsc/'>
                        </div>
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex items-center">
                            <Button wire:click="sortby('detalles')">Detalles</Button>
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

                {{-- @foreach ($articulos as $articulo)
                <tr>
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
                        @if ($articulo->suelto==1)
                            <div class="w-8 h-8 p-2 grid justify-items-center content-center bg-green-400 rounded-full">{{ $articulo->stock }}</div>

                        @else
                            {{ $articulo->stock }}

                        @endif

                    </td>
                    @if ($articulo->activo!=1)

                    <td class="rounder border px-4 py-2">
                        <x-secondary-button  wire:click="ActivarArticuloEdit({{ $articulo->id }})" wire:loading.attr="disabled" class="bg-green-700 hover:bg-green-500">
                            Activar
                        </x-secondary-button>
                    </td>

                    @else
                    <td class="rounder border flex">
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
                    </td>
                    @endif
                </tr>
                @endforeach --}}
            </tbody>
        </table>
   </div>
    {{-- Be like water. --}}
</div>
