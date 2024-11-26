<div class="w-auto p-2 sm:px-5 dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700 flex justify-center">
   
    <div class="w-11/12 bg-white p-4 rounded-lg shadow-lg border ">
        <div class="mt-4 text-2xl flex  shadow-inner ">
            <div>Informe Mayorista</div>
        </div>
        <div class="flex  ">
            <div>  
                <x-label for="descuento" value="Buscar" />
                <input wire:model.live='q' type="search" placeholder="Buscar" class="shadow appearance-none border rounded w-full py-2 px-3
                text-gray-706 leading-tight focus:outline-none focus: shadow-outline placeholder-blue-400" name="">
            </div>
            <div class="ml-2">
                <x-label for="Porsentaje" value="Porsentaje (Ejemplo: 10%) " />
                <x-input id="porsentaje" type="number" class="block w-full" wire:model.live='porsentaje' placeholder="Porsentaje"/>
                <x-input-error for="porsentaje" class="mt-2" />
            </div>
            <div class="ml-2">     
                <x-label for="Cliente" value="Cliente " />
                <x-input id="Cliente" type="text" class="block w-full" wire:model='cliente' placeholder="Para"/>
                <x-input-error for="Cliente" class="mt-2" />
            </div> 
            <div class="">  
                <x-button wire:click='imprimir()' target="_blank" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded mt-5">
                  Crear Lista Mayorista
                </x-button>
            </div>
            @if ($boton)
                <div class="ml-auto">  
                    <a href="{{ route('mayorista', ['enviarM' => $ultimoNroPedido]) }}" target="_blank" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded mt-5">
                    Crear Lista Mayorista
                    </a>
                </div>
            @endif
            
        </div>
        <table class="table-full w-full">
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
                            <Button wire:click="sortby('precioF')">Precio Final</Button>
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
                        <div class="flex items-center">Stock</div>
                    </td>
                    <td class="px-4 py-2">
                    <div class="flex items-center">Precio Inicial</div>
                    </td
                    ><td class="px-4 py-2 w-auto">
                        <div class="flex items-center ">
                            <div class="w-auto h-8 p-2 grid justify-items-center content-end bg-green-400 rounded-full">%</div>
                       </div>
                    </td>
                    <td class="px-4 py-2 w-auto">
                        <div class="flex items-center">
                            <div class="w-auto h-8 p-2 grid justify-items-center content-center bg-green-400 rounded-full">Precio Mayorista</div>
                       </div>
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex items-center">Accion</div>

                    </td>
                </tr>
            </thead>
            <tbody>
                @foreach ($articulos as $articulo)
                    @if (!$this->Ofeta($articulo->id) || $articulo->suelto == 1)
                        <tr >
                            <td class="rounder border px-4 py-2">{{ $articulo->id }}</td>
                            <td class="rounder border px-4 py-2">{{ $articulo->articulo }}</td>
                           
                            <td class="rounder border px-4 py-2">{{ $articulo->presentacion }}-{{ $articulo->unidad }}-{{ $articulo->unidadVenta }}</td> 
                       
                          
                            
                            <td class="rounder border px-4 py-2">{{ $articulo->precioF }}</td>
                         
                            <td class="rounder border px-4 py-2">{{ $articulo->detalles }}</td>
                            <td class="rounder border px-4 py-2">{{ $articulo->stock }}</td>
                            <td class="rounded border px-4 py-2 w-auto text-right">{{ $articulo->precioI }}</td>
                            <td class="rounder border px-4 py-2 w-auto"> +{{$porsentaje}}% </td>
                            <td class="rounder border px-4 py-2 w-auto">{{ $this->calcularPorcentaje($articulo->precioI) }}</td>
                            <td class="rounder border px-4 py-2">
                                @if ($this->enMayorista($articulo->id))
                                    <x-danger-button 
                                    wire:click="deleteMayorista({{ $articulo->id }})" 
                                    wire:loading.attr="disabled">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </x-danger-button>
                                @else
                                    <x-secondary-button 
                                    wire:click="addMayorista({{ $articulo->id }}, {{ $this->calcularPorcentaje($articulo->precioI) }}, '{{ $cliente }}')"
                                    wire:loading.attr="disabled" class="bg-green-700 hover:bg-green-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                          </svg> 
                                    </x-secondary-button>
                                   
                                @endif
                            </td>
                        </tr>
                    @endif
                    

                @endforeach

                </tbody>
        </table>
    </div>
    {{-- In work, do what you enjoy. --}}
</div>
