<div class="p-2  w-full sm:px-5 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
        <div class="mt-4 text-2xl flex justify-between shadow-inner">
        <div>Cliente
            <h6>{{ $msj }}</h6>
        </div>
        <div class="mr-2">

            <x-button wire:click='confirmarClienteAdd' class="bg-blue-800 hover:bg-blue-500">
                Crear Nuevo Cliente
            </x-button>
        </div>
        </div>

       <div class="mt-3">
        <div class="flex justify-between">
            <div>
                <input wire:model.live='q' type="search" placeholder="Buscar" class="shadow appearance-none border rounded w-full py-2 px-3

                text-gray-706 leading-tight focus:outline-none focus: shadow-outline placeholder-blue-400" name="">
            </div>
            <div class="mr-2">
                <input class="mr-2 leading-tight" type="checkbox" wire:model.live ='active'/ value="1" checked>Clientes Activos
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
                            <Button wire:click="sortby('apellido')">Apellido</Button>
                            <x-sort-icon sortFiel='apellido': sort-by='$sortBy' : sort-asc='$sortAsc'>

                        </div>
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex items-center">
                            <Button wire:click="sortby('nombre')">Nombre</Button>
                            <x-sort-icon sortFiel='nombre': sort-by='$sortBy' : sort-asc='$sortAsc'/>
                        </div>
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex items-center">
                            <Button wire:click="sortby('Dni')">Dni</Button>
                            <x-sort-icon sortFiel='nombre': sort-by='$sortBy' : sort-asc='$sortAsc'/>
                        </div>
                    </td>
                    
                    <td class="px-4 py-2">
                        <div class="flex items-center">
                            <Button wire:click="sortby('telefono')">Telefono</Button>
                            <x-sort-icon sortFiel='telefono': sort-by='$sortBy' : sort-asc='$sortAsc/'>
                        </div>
                    </td>
                    <td class=" w-36">
                       Accion
                    </td>
                </tr>
            </thead>
            <tbody>
                @forelse ($clientes as $cliente)
                <tr>
                    <td class="rounder border px-4 py-2">{{ $cliente->id }}</td>
                    <td class="rounder border px-4 py-2">{{ $cliente->apellido }}</td>
                    <td class="rounder border px-4 py-2">{{ $cliente->nombre }}</td>
                    <td class="rounder border px-4 py-2">{{ $cliente->dni }}</td>
                    <td class="rounder border px-4 py-2">{{ $cliente->telefono }}</td>
                    <td class="rounder border px-2 py-2">
                        <form action="">
                        <x-secondary-button wire:click="confirmarClienteEdit({{ $cliente->id }})" id="c{{ $cliente->id }}" wire:loading.attr="disabled" class="bg-green-700 hover:bg-green-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                             </svg>
                        </x-secondary-button>
                        <x-danger-button wire:click="confirmarClienteDeletion({{ $cliente->id }})" wire:loading.attr="disabled">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                              </svg>
                        </x-danger-button></form>
                    </td>
                </tr>
                @empty
                <h2>No hay registro</h2>
                @endforelse


            </tbody>
        </table>
       </div>
       <div class="mt-2">{{ $clientes->links() }}</div>

       <!-- Delete User Confirmation Modal -->
        <x-dialog-modal wire:model.live="confirmingClienteDeletion">
            <x-slot name="title">
                {{ __('Eliminar Cliente') }}
            </x-slot>

            <x-slot name="content">
                {{ __('¿Esta seguro de Desea Eliminar Un Cliente?') }}
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingClienteDeletion', false)" wire:loading.attr="disabled">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-danger-button class="ms-3" wire:click="deleteCliente({{ $confirmingClienteDeletion }})" wire:loading.attr="disabled">
                    {{ __('Eliminar') }}
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>
        <!--Fin Delete  Confirmation Modal -->

         <!-- aDD User Confirmation Modal -->
         <x-dialog-modal wire:model.live="confirmingClienteAdd">
            <x-slot name="title">
                {{ __('Cargar Cliente') }}
            </x-slot>

            <x-slot name="content">
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="apellido" value="{{ __('Apellido') }}" />
                    <x-input id="apellido" type="text" class="mt-1 block w-full" wire:model="apellido" name='apellido' />
                    <x-input-error for="apellido" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4 mt-2">
                    <x-label for="nombre" value="{{ __('Nombre') }}" />
                    <x-input id="nombre" type="text" class="mt-1 block w-full" wire:model="nombre" name='nombre' />
                    <x-input-error for="nombre" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4 mt-2">
                    <x-label for="dni" value="{{ __('DNI') }}" />
                    <x-input id="dni" type="text" class="mt-1 block w-full" wire:model="dni" name='dni' />
                    <x-input-error for="dni" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4 mt-2">
                    <x-label for="telefono" value="{{ __('Telefono') }}" />
                    <x-input id="telefono" type="text" class="mt-1 block w-full" wire:model="telefono"  />
                    <x-input-error for="telefono" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingClienteAdd', false)" wire:loading.attr="disabled">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-danger-button class="ms-3" wire:click="saveCliente()" wire:loading.attr="disabled">
                    {{ __('Guardar') }}
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>
          <!--Fin Add  Confirmation Modal -->

          <x-dialog-modal wire:model.live="confirmingClienteEdit">
            <x-slot name="title">
                {{ __('Editar Cliente') }}
            </x-slot>

            <x-slot name="content">
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="apellido" value="{{ __('Apellido') }}" />
                    <x-input id="apellido" type="text" class="mt-1 block w-full" wire:model="apellido" name='apellido' />
                    <x-input-error for="apellido" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4 mt-2">
                    <x-label for="nombre" value="{{ __('Nombre') }}" />
                    <x-input id="nombre" type="text" class="mt-1 block w-full" wire:model="nombre" name='nombre' />
                    <x-input-error for="nombre" class="mt-2" />

                </div>
                <div class="col-span-6 sm:col-span-4 mt-2">
                    <x-label for="dni" value="{{ __('DNI') }}" />
                    <x-input id="dni" type="text" class="mt-1 block w-full" wire:model="dni" name='dni' />
                    <x-input-error for="dni" class="mt-2" />

                </div>
                <div class="col-span-6 sm:col-span-4 mt-2">
                    <x-label for="telefono" value="{{ __('Telefono') }}" />
                    <x-input id="telefono" type="text" class="mt-1 block w-full" wire:model="telefono"  />
                    <x-input-error for="telefono" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingClienteEdit', false)" wire:loading.attr="disabled">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-danger-button class="ms-3" wire:click="editCliente()" wire:loading.attr="disabled">
                    {{ __('Editar') }}
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>





</div>
