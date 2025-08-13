   
<div class="w-full px-6 py-4 bg-white rounded-lg shadow-md">
        
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <td class="px-4 py-2"><div class="flex items-center" >id</div></td>
                     <td class="px-4 py-2"><div class="flex items-center">Codigo</div></td>
                    <td class="px-4 py-2"><div class="flex items-center">Articulo</div></td>
                    <td class="px-4 py-2"><div class="flex items-center">Presentacion</div></td>
                    <td class="px-4 py-2"><div class="flex items-center">Desc</div></td>
                    <td class="px-4 py-2"><div class="flex items-center">Unidad Cant</div></td>
                    <td class="px-4 py-2"><div class="flex items-center">Precio Inicial</div></td>
                    <td class="px-4 py-2"><div class="flex items-center">Precio Final</div></td>
                    <td class="px-4 py-2"><div class="flex items-center">Cadc</div></td>
                    <td class="px-4 py-2"><div class="flex items-center">Detalles</div></td>
                    <td class="px-4 py-2"><div class="flex items-center"> Stock Min. </div></td>
                    <td class="px-4 py-2"><div class="flex items-center"> Stock</div></td>
                    <td class="px-4 py-2"><div class="flex items-center"> Accion </div></td>
                </tr>
            </thead>
            <tbody>
                @foreach ($articulos as $articulo)
                    <tr >
                    {{-- <tr class="{{ $this->Ofeta($articulo->id) ? 'text-green-500 font-bold':'' }}"> --}}
                        
                        <td class="rounder border px-4 py-2">{{ $articulo->id }}</td>
                        <td class="rounder border px-4 py-2">{{ $articulo->codigo }}</td>
                        <td class="rounder border px-4 py-2">{{ $articulo->articulo }}</td>
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
                                <x-secondary-button wire:click="editar({{ $articulo->id }})" wire:loading.attr="disabled" class="bg-green-600 hover:bg-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">

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
            @if($mostrarModal)
                <div class="modal">
                    <livewire:articulo.articulo-edit 
                :articulo-id="$articuloId" 
                :confirming-articulo-edit="true" 
            />
                </div>
            @endif
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

</div>