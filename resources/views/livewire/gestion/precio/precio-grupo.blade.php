<div class="p-2  w-full sm:px-5 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

    <div class="mt-3">
        <div class="flex justify-between">
            <div class="text-xl">Precio Por Grupo</div>
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

                </div>
            </x-slot>

            <x-slot name="content">
                <div class="col-span-6 sm:col-span-4 text-xl my-5">
                    <table class="table-auto w-full rounded-md">
                        <tr>
                            <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg">Empresa</td>
                            <td class="rounded border px-4 py-2">{{ $datosPro->nombre }}</td>

                        </tr>
                        <tr>
                            <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg">Rubro</td>
                            <td class="rounded border px-4 py-2">{{ $datosPro->rubro }}</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg">Localidad</td>
                            <td class="rounded border px-4 py-2">{{ $datosPro->localidad }}</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg">Telefono</td>
                            <td class="rounded border px-4 py-2">{{ $datosPro->telefono }}</td>
                        </tr>
                    </table>
                </div>

                <div class="col-span-6 sm:col-span-4 text-xl my-5 w-full">
                    <div class="text-xl">Grupos Del Proveedor</div>
                    <table class="table-auto w-full rounded-md">
                        <thead>
                            <tr>
                                <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg">Id</td>
                                <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg">Grupo</td>
                                <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg">Porcentaje</td>
                                <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg">Accion</td>
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
                </div>

            </x-slot>
            <x-slot name="content">
                <div class="col-span-6 sm:col-span-4 text-xl my-10">
                    <div class="text-xl">Proveedor</div>

                    <table class="table-auto w-full rounded-md">
                        <tr>
                            <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg ">Empresa</td>
                            <td class="rounder border px-4 py-2">{{  $datos->nombre }}</td>
                            <td class="rounded border px-4 py-2 justify-center items-center text-center" rowspan="4">
                                <div>Permitir cambio de precio</div>
                                @if (!$activarCambio)
                                    <button wire:click='activar' class="bg-blue-600 hover:bg-blue-300 text-white py-2 px-6 rounded-md">Permitir</button>
                                @else
                                    <button wire:click='noActivar'  class="bg-red-600 hover:bg-red-300 text-white py-2 px-6 rounded-md">No Permitir</button>

                                @endif
                            </td>
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
                            <td class="px-4 py-2 border border-white bg-sky-400/50 text-xl ">{{  $datos->idGrupo }} - {{  $datos->NombreGrupo }}</td>
                            <td class="px-4 py-2 border border-white bg-sky-400/50 text-xl " rowspan="2">
                                @if ($activarCambio)
                                <div class="justify-center items-center text-center">
                                    <button wire:click='cambiarPorcentaje({{  $datos->idGrupo }})' class=" mb-2 bg-blue-600 hover:bg-blue-300 text-white py-2 px-2 rounded-md">Cambiar Porcentaje</button>
                                    <button wire:click='cambiarPrecio({{  $datos->idGrupo }})' class="bg-green-600 hover:bg-green-300 text-white py-2 px-2 rounded-md">Cambiar Precio</button>

                                </div>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 border border-white bg-sky-400/50 text-xl ">Porcentaje a Aplicar</td>
                            <td class="px-4 py-2 border border-white bg-sky-400/50 text-xl ">{{  $datos->porsentaje }}</td>

                        </tr>
                    </table>
                </div>


                <div class="col-span-6 sm:col-span-4 text-xl my-5">
                    <div class="text-xl">Articulos En Grupo</div>

                    <table class="table-auto w-full rounded-md">
                        <tr>
                            <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg ">Id</td>
                            <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg ">Articulo</td>
                            <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg ">Presentacion</td>
                            <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg ">Categoria</td>
                            <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg ">Proveedor</td>
                            <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg ">Stock</td>



                        </tr>

                        @forelse ($ArtGrupo as $item)
                            <tr>
                                <td class="px-4 py-2 border border-sky-400/50 text-lg">{{ $item->id }}</td>
                                <td class="px-4 py-2 border border-sky-400/50 text-lg">{{ $item->articulo }}</td>
                                <td class="px-4 py-2 border border-sky-400/50 text-lg">{{ $item->presentacion }}-{{ $item->unidad }}</td>
                                <td class="px-4 py-2 border border-sky-400/50 text-lg">{{ $item->categoria }}</td>
                                <td class="px-4 py-2 border border-sky-400/50 text-lg">{{ $item->nombre }}</td>
                                <td class="px-4 py-2 border border-sky-400/50 text-lg">{{ $item->stock }}</td>



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
                <x-secondary-button class="ms-3" wire:click="$toggle('articulosGrupoModal', false)" wire:loading.attr="disabled">
                    {{ __('Cerrar') }}
                </x-secondary-button>
            </x-slot>
            </x-dialog-modal>
    @endif

    @if ($modalPorcentaje){{-- ---2.1---- Articulos->Grupo --}}
        <x-dialog-modal wire:model.live="modalPorcentaje" maxWidth="lg">
            <x-slot name="title">
                <div class="flex justify-between m-5">
                    <div class="text-xl">Cambiar Porcentaje de Grupo</div>
                </div>

            </x-slot>
            <x-slot name="content">
                <div class="col-span-6 sm:col-span-4 text-xl my-10">
                    <div class="text-xl">Porcentaje</div>
                    <div>
                        <div class="col-span-6 sm:col-span-4">
                            <div class="flex justify-center items-center">
                                <x-input id="porsentaje" type="text" class="mt-1 block w-24" wire:model='porsentaje' placeholder="Articulo"/>
                                <button wire:click='cambiar({{  $datos->idGrupo }})' class="ml-5 bg-blue-600 hover:bg-blue-300 text-white py-2 px-2 rounded-md">
                                    Cambiar Porcentaje
                                </button>
                            </div>
                            <x-input-error for="porsentaje" class="mt-2" />
                        </div>
                    </div>

                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button class="ms-3" wire:click="carraPorcentaje()" wire:loading.attr="disabled">
                    {{ __('Cerrar') }}
                </x-secondary-button>
            </x-slot>
        </x-dialog-modal>
    @endif

    @if ($CambiarPrecioModal){{-- ---2.2---- Articulos->Grupo --}}
        <x-dialog-modal wire:model.live="CambiarPrecioModal" maxWidth="3xl">
            <x-slot name="title">
                <div class="flex justify-between m-5">
                    <div class="text-xl">Articulos Asociados a un Grupo</div>
                </div>

            </x-slot>
            <x-slot name="content">

                <div class="col-span-6 sm:col-span-4 text-xl my-5">
                    <div class="text-xl">Articulos En Grupo</div>
                    <div class="col-span-6 sm:col-span-4 text-xl my-10">
                        <table class="table-auto w-full rounded-md mt-10">
                            <tr>
                                <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg ">Empresa</td>
                                <td class="rounder border px-4 py-2">{{  $datos->nombre }}</td>
                                <td class="rounded border px-4 py-2 justify-center items-center text-center" rowspan="4">
                                    <div>Cambiar Precio</div>
                                    @if (!$cambiarPrecioBoton)
                                        <button wire:click='si' class="bg-blue-600 hover:bg-blue-300 text-white py-2 px-6 rounded-md">Si</button>
                                    @else
                                        <button wire:click='no'  class="bg-red-600 hover:bg-red-300 text-white py-2 px-6 rounded-md">No</button>
                                    @endif
                                </td>
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
                                <td class="px-4 py-2 border border-white bg-sky-400/50 text-xl ">{{  $datos->idGrupo }} - {{  $datos->NombreGrupo }}</td>
                                <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg " rowspan="2">
                                    @if ($cambiarPrecioBoton)
                                    <div class="justify-center items-center text-center">
                                        <button wire:click='cambiarPrecioGrupo({{  $datos->idGrupo }})' class="bg-green-600 hover:bg-green-300 text-white py-2 px-2 rounded-md">Cambiar Precio</button>
                                    </div>
                                    @endif
                                </td>
                            </tr>fs
                            <tr>
                                <td class="px-4 py-2 border border-white bg-sky-400/50 text-xl ">Porcentaje a Aplicar</td>
                                <td class="px-4 py-2 border border-white bg-sky-400/50 text-xl ">{{  $datos->porsentaje }}</td>

                            </tr>
                        </table>
                    </div>
                    <table class="table-auto w-full rounded-xl">
                        <tr>
                            <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg" colspan="4"> Detalles</td>
                            <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg" colspan="2"> Precio Actual</td>
                            <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg" colspan="3">Se Aplica</td>
                            <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg" colspan="2"> Precio Actualizado</td>


                        </tr>
                        <tr>
                            <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg ">Id</td>
                            <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg ">Articulo</td>
                            <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg ">Presentacion</td>
                            <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg ">Ultimo Cambio de Fecha</td>

                            <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg ">precio Inicial</td>
                            <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg ">precio Final</td>
                            <td class="px-1 py-2 border border-white bg-sky-400/50 text-lg "></td>
                            <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg ">%</td>
                            <td class="px-1 py-2 border border-white bg-sky-400/50 text-lg "></td>
                            <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg ">precio Inicial</td>
                            <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg ">precio Final</td>
                        </tr>

                        @forelse ($ArtGrupo as $item)
                            <tr>
                                <td class="px-4 py-2 border border-sky-400/50 text-lg">{{ $item->id }}</td>
                                <td class="px-4 py-2 border border-sky-400/50 text-lg">{{ $item->articulo }}</td>
                                <td class="px-4 py-2 border border-sky-400/50 text-lg">{{ $item->presentacion }}-{{ $item->unidad }}</td>
                                <td class="px-4 py-2 border border-sky-400/50 text-lg">{{ $item->updated_at }}</td>

                                <td class="px-4 py-2 border border-sky-400/50 text-lg">{{ $item->precioI }}</td>
                                <td class="px-4 py-2 border border-sky-400/50 text-lg">{{ $item->precioF }}</td>
                                <td class="px-1 py-2 border border-sky-400/50 text-lg "></td>
                                <td class="px-4 py-2 border border-sky-400/50 text-lg">{{ $item->porsentaje }}</td>
                                <td class="px-1 py-2 border border-sky-400/50 text-lg "></td>
                                <td class="px-4 py-2 border border-sky-400/50 text-lg">{{ $item->precioI_calculado }}</td>
                                <td class="px-4 py-2 border border-sky-400/50 text-lg">{{ $item->precioF_calculado }}</td>



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
                <x-secondary-button class="ms-3" wire:click="cierreCambiarPrecioModal" wire:loading.attr="disabled">
                    {{ __('Cerrar') }}
                </x-secondary-button>
            </x-slot>
        </x-dialog-modal>
    @endif

    <x-dialog-modal wire:model.live="msjModal" maxWidth="2xl">
        <x-slot name="title">
            Operacion Realizada con Exito
        </x-slot>

        <x-slot name="content">
            {{ __('¿Se Cambio El Precio a Todos los elementos del Grupo') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('msjModal', false)" wire:loading.attr="disabled">
                {{ __('Cerrar') }}
            </x-secondary-button>


        </x-slot>
    </x-dialog-modal>
</div>



