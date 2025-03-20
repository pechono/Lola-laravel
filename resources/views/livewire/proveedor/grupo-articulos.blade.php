<div class="p-2  w-full sm:px-5 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
    <div class="mt-3">
        <div class="flex justify-between">
            <div class="text-xl">Grupos - Proveedor</div>

            <div class="mr-2">
                <a href="{{ route('proveedor.proveedor') }}" class="bg-blue-800 hover:bg-blue-500 p-2 text-white rounded-md">Crear Nuevo Proveedor</a>
            </div>
        </div>
        <div>Selecionar Proveedor Para Ver Grupo</div>
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <td class="px-4 py-2">Id</td>
                    <td class="px-4 py-2">Empresa </td>
                    <td class="px-4 py-2">Telefono</td>
                    <td class="px-4 py-2">Rubro</td>
                    <td class="px-4 py-2">Direccion</td>
                    <td class="px-4 py-2">Localidad</td>
                    <td class="px-4 py-2">Mail</td>
                    <td class=" w-36"> Accion</td>
                </tr>
            </thead>
            <tbody>
                @forelse ($proveedors as $proveedor)
                <tr>
                    <td class="rounder border px-4 py-2">{{ $proveedor->id }}</td>
                    <td class="rounder border px-4 py-2">{{ $proveedor->nombre }}</td>
                    <td class="rounder border px-4 py-2">{{ $proveedor->telefono }}</td>
                    <td class="rounder border px-4 py-2">{{ $proveedor->rubro }}</td>
                    <td class="rounder border px-4 py-2">{{ $proveedor->direccion }}</td>
                    <td class="rounder border px-4 py-2">{{ $proveedor->localidad }}</td>
                    <td class="rounder border px-4 py-2">{{ $proveedor->mail }}</td>
                    <td class="rounder border px-4 py-2">
                       <button wire:click='modalArticulosGrupo({{ $proveedor->id }})' class="bg-green-600 hover:bg-green-300 text-white rounded-md p-2">
                        Ver
                    </button>
                    </td>
                </tr>
                @empty
                <h2>No hay registro</h2>
                @endforelse
            </tbody>
        </table>
    </div>




@if ($VerArticulosGrupo) {{-- ---1--- proveedor->grupo --}}
     <x-dialog-modal wire:model.live="VerArticulosGrupo" maxWidth="2xl">
        <x-slot name="title">
            <div class="flex justify-between m-5">
                <div class="text-xl">Proveedor</div>
                <div class="mr-2">
                    <button wire:click='modalGrupo({{ $datosPro->id }})' class="bg-blue-800 hover:bg-blue-500 p-2 text-white rounded-md">Crear Grupo</button>
                </div>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4 text-xl my-5">
                <table class="table-auto w-full rounded-md">
                    <tr>
                        <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg">Empresa</td>
                        <td class="rounded border px-4 py-2">{{ $datosPro->nombre }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg">Rubro</td>
                        <td class="rounded border px-4 py-2">{{ $datosPro->rubro }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg">Localidad</td>
                        <td class="rounded border px-4 py-2">{{ $datosPro->localidad }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg">Telefono</td>
                        <td class="rounded border px-4 py-2">{{ $datosPro->telefono }}</td>
                    </tr>
                </table>
            </div>

            <div class="col-span-6 sm:col-span-4 text-xl my-5 w-full">
                <div class="text-xl">Grupos Del Proveedor</div>
                <table class="table-auto w-full rounded-md">
                    <thead>
                        <tr>
                            <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg">Id</td>
                            <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg">Grupo</td>
                            <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg">Porcentaje</td>
                            <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg">Accion</td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($gruposProv as $item)
                            <tr>
                                <td class="px-4 py-2 border border-sky-400/50 text-lg">{{ $item->id }}</td>
                                <td class="px-4 py-2 border border-sky-400/50 text-lg">{{ $item->NombreGrupo }}</td>
                                <td class="px-4 py-2 border border-sky-400/50 text-lg">{{ $item->porsentaje }}</td>
                                <td class="px-4 py-2 border border-sky-400/50 text-lg">
                                    <button wire:click='ArticulosGrupo({{ $item->id }})' class="bg-green-600 hover:bg-green-300 text-white rounded-md p-2">Ver Grupo</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-4 py-2 border border-sky-400/50 text-lg" colspan="4">No hay Grupos para este Proveedor</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button class="ms-3" wire:click="$toggle('VerArticulosGrupo', false)" wire:loading.attr="disabled">
                {{ __('Cerrar') }}
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>
@endif

@if ($articulosGrupoModal){{-- ---2---- Articulos->Grupo --}}
        <x-dialog-modal wire:model.live="articulosGrupoModal" maxWidth="2.5xl">
        <x-slot name="title">
            <div class="flex justify-between m-5">
                <div class="text-xl">Articulos Asociados a un Grupo</div>

                <div class="mr-2">
                    <button wire:click='modalArticulos({{ $datos->idGrupo }})' class="bg-blue-800 hover:bg-blue-500 p-2 text-white rounded-md">
                        Asociar Articulo
                    </button>
                </div>
            </div>

        </x-slot>
        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4 text-xl my-10">
                <div class="text-xl">Proveedor</div>

                <table class="table-auto w-full rounded-md">
                    <tr>
                        <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg ">Empresa</td>
                        <td class="rounder border px-4 py-2">{{  $datos->nombre }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg ">Rubro</td>
                        <td class="rounder border px-4 py-2">{{  $datos->rubro }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg ">Localidad</td>
                        <td class="rounder border px-4 py-2">{{  $datos->localidad }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg ">Telefono</td>
                        <td class="rounder border px-4 py-2">{{  $datos->telefono }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 border border-white bg-sky-400/50 text-xl ">Grupo</td>
                        <td class="px-4 py-2 border border-white bg-sky-400/50 text-xl ">{{  $datos->idGrupo }}-{{  $datos->NombreGrupo }}</td>
                    </tr>
                </table>
            </div>


            <div class="col-span-6 sm:col-span-4 text-xl my-5">
                <div class="text-xl">Articulos En Grupo</div>

                <table class="table-auto w-full rounded-md">
                    <tr>
                        <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg ">Id</td>
                        <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg ">Articulo</td>
                        <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg ">Presentacion</td>
                        <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg ">Categoria</td>
                        <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg ">Proveedor</td>
                        <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg ">Stock</td>

                        <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg ">Accion</td>


                    </tr>

                    @forelse ($ArtGrupo as $item)
                        <tr>
                            <td class="px-4 py-2 border border-sky-400/50 text-lg">{{ $item->id }}</td>
                            <td class="px-4 py-2 border border-sky-400/50 text-lg">{{ $item->articulo }}</td>
                            <td class="px-4 py-2 border border-sky-400/50 text-lg">{{ $item->presentacion }}-{{ $item->unidad }}</td>
                            <td class="px-4 py-2 border border-sky-400/50 text-lg">{{ $item->categoria }}</td>
                            <td class="px-4 py-2 border border-sky-400/50 text-lg">{{ $item->nombre }}</td>
                            <td class="px-4 py-2 border border-sky-400/50 text-lg">{{ $item->stock }}</td>


                            <td class="px-4 py-2 border border-sky-400/50 text-lg">
                                <button wire:click='QuitarArticulosGrupo({{ $item->id }})' class="bg-red-600 hover:bg-red-300 text-white rounded-md p-2">
                                    Quitar
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-4 py-2 border border-sky-400/50 text-lg " colspan="3">No hay Articulos Asociados</td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button class="ms-3" wire:click="cerrar2()" wire:loading.attr="disabled">
                {{ __('Cerrar') }}
            </x-secondary-button>
        </x-slot>
        </x-dialog-modal>
@endif

 @if ($modalArticulosVar){{-- --3--- Articulos a Grupo --}}
    <x-dialog-modal wire:model.live="modalArticulosVar"  maxWidth="2.5xl">
    <x-slot name="title">
        <div class="flex justify-between m-5">
            <div class="text-xl">Asociar Articulosa un Grupos</div>
        </div>

    </x-slot>
    <x-slot name="content">
        <div class="col-span-6 sm:col-span-4 text-xl my-10">
            <div class="text-xl">Proveedor</div>

            <table class="table-auto w-full rounded-md">
                <tr>
                    <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg ">Empresa</td>
                    <td class="rounder border px-4 py-2">{{  $datos->nombre }}</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg ">Rubro</td>
                    <td class="rounder border px-4 py-2">{{  $datos->rubro }}</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg ">Localidad</td>
                    <td class="rounder border px-4 py-2">{{  $datos->localidad }}</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg ">Telefono</td>
                    <td class="rounder border px-4 py-2">{{  $datos->telefono }}</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 border border-white bg-sky-400/50 text-xl ">Grupo</td>
                    <td class="px-4 py-2 border border-white bg-sky-400/50 text-xl ">{{ $datos->idGrupo }}-{{  $datos->NombreGrupo }}</td>
                </tr>
            </table>
        </div>


        <div class="col-span-6 sm:col-span-4 text-xl my-10">
            <div class="text-xl">Articulos Sin Agrupar</div>

            <table class="table-auto w-full rounded-md">
                <tr>
                    <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg ">Id</td>
                    <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg ">Articulo</td>
                    <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg ">Categoria</td>
                    <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg ">Proveedor</td>

                    <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg ">Accion</td>
                </tr>

                @forelse ($articulosSinGrupo as $item)
                    <tr>
                        <td class="px-4 py-2 border border-sky-400/50 text-lg ">{{ $item->id }}</td>
                        <td class="px-4 py-2 border border-sky-400/50 text-lg ">{{ $item->articulo }} {{ $item->presentacion }}-{{ $item->unidad }}</td>
                        <td class="px-4 py-2 border border-sky-400/50 text-lg ">{{ $item->categoria }}</td>
                        <td class="px-4 py-2 border border-sky-400/50 text-lg ">{{ $item->nombre }}</td>

                        <td class="px-4 py-2 border border-sky-400/50 text-lg ">
                            <button wire:click='articuloEnGrupo({{ $datos->idGrupo }},{{ $item->id }})' class="bg-green-600 hover:bg-green-300 text-white rounded-md p-2">
                                Agrupar
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-4 py-2 border border-sky-400/50 text-lg " colspan="5">No hay Articulos sin Asociar</td>
                    </tr>
                @endforelse
            </table>
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button class="ms-3" wire:click='cerrar3()' wire:loading.attr="disabled">
            {{ __('Cerrar') }}
        </x-secondary-button>
    </x-slot>
    </x-dialog-modal>
@endif

@if ($crearGrupoModal){{-- Cargar Proveedor --}}
    <x-dialog-modal wire:model.live="crearGrupoModal" maxWidth="2xl" >
        <x-slot name="title">
            {{ __('Cargar Proveedor') }}
        </x-slot>
        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4 text-xl my-10">
                <table class="table-auto w-full rounded-md">
                    <tr>
                        <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg ">Empresa</td><td class="rounder border px-4 py-2">{{  $datosPro->nombre }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg ">Rubro</td><td class="rounder border px-4 py-2">{{  $datosPro->rubro }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg ">Localidad</td><td class="rounder border px-4 py-2">{{  $datosPro->localidad }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg ">Telefono</td><td class="rounder border px-4 py-2">{{  $datosPro->telefono }}</td>
                    </tr>
                </table>
            </div>
            <div class="flex items-center space-x-4">
                <div class="flex-grow">
                    <x-label for="NombreGrupo" value="{{ __('Nombre del Grupo') }}" />
                    <x-input id="NombreGrupo" type="text" class="mt-1 block w-full" wire:model="NombreGrupo" />
                    <x-input-error for="NombreGrupo" class="mt-2" />
                </div>
                <div class="flex-grow">
                    <x-label for="porsentaje" value="{{ __('Porsentaje') }}" />
                    <x-input id="porsentaje" type="text" class="mt-1 block w-full" wire:model="porsentaje" name='porsentaje' />
                    <x-input-error for="porsentaje" class="mt-2" />
                </div>
                <div class="flex-shrink-0 mt-5">

                    <button wire:click='addGrupo()' class=" bg-blue-700 hover:bg-blue-300 text-white p-2 rounded-md" wire:loading.attr="disabled">Crear Grupo</button>
                </div>
            </div>

            <div class="col-span-6 sm:col-span-4 text-xl my-10">
                <div>Grupos Asociados al Proveedor</div>
                <table class="table-auto w-full rounded-md">
                    <tr>
                        <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg ">Id</td>
                        <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg ">Grupo</td>
                        <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg ">Porcentaje</td>
                    </tr>
                    {{-- @if ($this->grupos) --}}
                    @forelse ($grupos as $item)
                        <tr>
                            <td class="px-4 py-2 border border-sky-400/50 text-lg ">{{ $item->id }}</td>
                            <td class="px-4 py-2 border border-sky-400/50 text-lg ">{{ $item->NombreGrupo }}</td>
                            <td class="px-4 py-2 border border-sky-400/50 text-lg ">{{ $item->porsentaje }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-4 py-2 border border-sky-400/50 text-lg " colspan="3">No hay Grupos para este Proveedor</td>

                        </tr>
                    @endforelse

                    {{-- @endif --}}
                </table>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button class="ms-3" wire:click="$toggle('crearGrupoModal', false)" wire:loading.attr="disabled">
                {{ __('Cerrar') }}
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>
 @endif
</div>

