<div class="w-auto mx-auto sm:px-6 lg:px-8">
    <div class="justify-center">
        <table class="table-auto w-full rounded-md">
            @php  $previousOfferId = null; @endphp

            @forelse ($ofertaList as $item)
                @if ($loop->first || $item->id != $previousOfferId)
                    @if (!$loop->first)
                        <tr><td colspan="7" class="py-4"></td></tr>
                    @endif
                    <tr>
                        <td colspan="3" class="px-4 py-2 border border-white bg-sky-400/50 text-lg">
                            Oferta Número: {{ $item->id }}
                        </td>
                        <td colspan="5" class="border border-white p-0 h-12">
                            <div class="flex justify-end w-full h-12 "> <!-- Cambia h-24 según el tamaño necesario -->
                                @if($this->ofertaPublicada($item->id))
                                    <div class="flex items-center justify-between w-full h-full bg-green-500 text-white p-4 ">
                                        <div> <span>¡Oferta Publicada!</span></div>
                                            <div><button
                                            wire:click='terminarOferta({{ $item->id }})'
                                            class="p-2 bg-sky-600 hover:bg-sky-300 rounded-md text-white">
                                            Terminar Oferta
                                        </button></div>
                                    </div>

                                @else
                                    <div class="flex items-center justify-between w-full h-full bg-red-500 text-white p-4 ">
                                        <div><span>La oferta no está publicada.</span></div>

                                        <div><button
                                            wire:click='publicarModal({{ $item->id }})'
                                            class="p-2 bg-sky-600 hover:bg-sky-300 rounded-md text-white">
                                            Publicar Oferta
                                        </button></div>
                                    </div>
                                @endif
                            </div>

                        </td>


                    </tr>
                    <tr>
                        <td colspan="3" class="px-4 py-2 border border-white bg-sky-400/50 text-lg">
                            Nombre de Oferta: {{ $item->oferta }}
                        </td>
                        <td colspan="2" class="px-4 py-2 border border-white bg-sky-400/50 text-lg">
                            Precio: {{ $item->precio }}
                        </td>
                        <td colspan="3" class="px-4 py-2 border border-white bg-sky-400/50 text-lg">
                            Detalles: {{ $item->detalles }}
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg w-4"></td>
                        <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg">Id</td>
                        <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg">Artículos</td>
                        <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg">Precio Inicial</td>
                        <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg">Precio Final</td>
                        <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg">Precio Oferta</td>
                        <td class="w-40 py-2 border border-white bg-sky-400/50 text-lg">
                            <div class="flex justify-center w-auto">
                                <button wire:click='disponibilidad({{ $item->id }})' class="p-2 text-white bg-green-600 hover:bg-green-300 rounded-md">
                                    Disponibilidad
                                </button>
                            </div>
                        </td>
                    </tr>
                @endif
                <tr>
                    <td class="px-4 py-2 border border-white">-</td>
                    <td class="rounded border px-4 py-2 text-center">{{ $item->articulo_id }}</td>
                    <td class="rounded border px-4 py-2">{{ $item->articulo }} - {{ $item->presentacion }}{{ $item->unidad }}</td>
                    <td class="rounded border px-4 py-2 text-center">{{ $item->precioI }}</td>
                    <td class="rounded border px-4 py-2 text-center">{{ $item->precioF }}</td>
                    <td class="rounded border px-4 py-2 text-center">{{ $item->precioO }}</td>
                    <td class="rounded border px-4 py-2 text-center w-auto">{{ $item->cantidad }}</td>
                </tr>
                @php $previousOfferId = $item->id; @endphp
            @empty
                <tr>
                    <td colspan="7" class="text-center">No hay artículos ofertados disponibles.</td>
                </tr>
            @endforelse
        </table>
    </div>
{{-- modal desplegar oferta desplegar--}}
    @if ($terminarOf)
            <x-dialog-modal wire:model.live="terminarOf" >
                <x-slot name="title">
                    <div class="flex justify-between m-5">
                        <div class="text-xl">
                            Terminar Oferta
                        </div>
                    </div>
                </x-slot>
                <x-slot name="content">
                    <div class="justify-center">
                        <table class="table-auto w-full rounded-md text-xl">
                            <tr>
                                <td colspan="" class="px-4 py-2 border border-white bg-sky-400/50 text-lg">Oferta {{ $fg }} </td>
                                <td colspan="" class="px-4 py-2 border border-white bg-sky-400/50 text-lg">Articulo </td>

                                <td colspan="5" class="px-4 py-2 border border-white bg-sky-400/50 text-lg">Nombre Oferta:  </td>

                            </tr>
                            <tr>
                                <td colspan="" class="px-4 py-2 border border-white  text-lg">{{ $terminarOfQuery->idOfertas }} </td>
                                <td colspan="" class="px-4 py-2 border border-white  text-lg">{{ $terminarOfQuery->id }} </td>

                                <td colspan="4" class="px-4 py-2 border border-white  text-lg">{{ $terminarOfQuery->articulo }}-{{ $terminarOfQuery->presentacion }} </td>

                            </tr>
                            <tr>
                                <td colspan="" class="px-4 py-2 border border-white bg-sky-400/50 text-lg">Costo Inicial:: </td>
                                <td colspan="" class="px-4 py-2 border border-white bg-sky-400/50 text-lg">Costo Final:  </td>
                                <td colspan="" class="px-4 py-2 border border-white bg-sky-400/50 text-lg">Costo Oferta:  </td>
                                <td colspan="" class="px-4 py-2 border border-white bg-sky-400/50 text-lg">Uniddes Vendided: </td>
                                <td colspan="" class="px-4 py-2 border border-white bg-sky-400/50 text-lg">Uniddes Restante:  </td>
                                <td colspan="" class="px-4 py-2 border border-white bg-sky-400/50 text-lg">Venta en oferta:  </td>
                            </tr>
                            <tr>
                                <td colspan="" class="px-4 py-2 border border-white  text-lg">{{ $results->precioI }} </td>
                                <td colspan="" class="px-4 py-2 border border-white  text-lg">{{ $results->precioF }} </td>
                                <td colspan="" class="px-4 py-2 border border-white  text-lg">{{ $results->precioO }} </td>
                                <td colspan="" class="px-4 py-2 border border-white  text-lg">{{ $terminarOfQuery->ventas_cantidad }} </td>
                                <td colspan="" class="px-4 py-2 border border-white  text-lg">{{ $terminarOfQuery->stock }} </td>
                                <td colspan="" class="px-4 py-2 border border-white  text-lg">{{ $results->precioI_sum*$terminarOfQuery->ventas_cantidad}}

                                </td>
                            </tr>

                        </table>
                    </div>

                </x-slot>
                <x-slot name="footer">
                <button wire:click="terminarP({{ $terminarOfQuery->id }})" wire:loading.attr="disabled" class="p-2 text-white bg-red-600 hover:bg-red-300 rounded-md">
                        Cerrar
                    </button>


                </x-slot>
            </x-dialog-modal>
    @endif

    @if ($desplegar){{-- modal desplegar oferta --}}
        <x-dialog-modal wire:model.live="desplegar" >
            <x-slot name="title">
                <div class="flex justify-between m-5">
                    <div class="text-xl">Publicar Oferta</div>
                </div>
            </x-slot>
            <x-slot name="content">
                <div class="justify-center">
                    <table class="table-auto w-full rounded-md text-xl">
                        @php $previousOfferId = null; @endphp

                        @forelse ($ofertaMod as $item)
                            @if ($loop->first || $item->id != $previousOfferId)
                                @if (!$loop->first)
                                    <tr><td colspan="7" class="py-4"></td></tr>
                                @endif
                                <tr>
                                    <td colspan="3" class="px-4 py-2 border border-white bg-sky-400/50 text-lg">
                                        Oferta Número: {{ $item->id }}
                                    </td>
                                    <td colspan="5" class="px-4 py-2 border border-white">

                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="px-4 py-2 border border-white bg-sky-400/50 text-lg">
                                        Nombre de Oferta: {{ $item->oferta }}
                                    </td>
                                    <td colspan="2" class="px-4 py-2 border border-white bg-sky-400/50 text-lg">
                                        Precio: {{ $item->precio }}
                                    </td>
                                    <td colspan="3" class="px-4 py-2 border border-white bg-sky-400/50 text-lg">
                                        Detalles: {{ $item->detalles }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg w-4"></td>
                                    <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg">Id</td>
                                    <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg">Artículos</td>
                                    <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg">Precio Inicial</td>
                                    <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg">Precio Final</td>
                                    <td class="px-4 py-2 border border-white bg-sky-400/50 text-lg">Precio Oferta</td>
                                    <td class="w-40 py-2 border border-white bg-sky-400/50 text-lg">
                                        <div class="flex justify-center w-auto">
                                                Disponibilidad
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td class="px-4 py-2 border border-white">-</td>
                                <td class="rounded border px-4 py-2 text-center">{{ $item->articulo_id }}</td>
                                <td class="rounded border px-4 py-2">{{ $item->articulo }} - {{ $item->presentacion }}{{ $item->unidad }}</td>
                                <td class="rounded border px-4 py-2 text-center">{{ $item->precioI }}</td>
                                <td class="rounded border px-4 py-2 text-center">{{ $item->precioF }}</td>
                                <td class="rounded border px-4 py-2 text-center">{{ $item->precioO }}</td>
                                <td class="rounded border px-4 py-2 text-center w-auto">{{ $item->cantidad }}</td>
                            </tr>
                            @php $previousOfferId = $item->id; @endphp
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No hay artículos ofertados disponibles.</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </x-slot>
            <x-slot name="footer">
                <button wire:click="cerrarDesplegar()" wire:loading.attr="disabled" class="p-2 text-white bg-red-600 hover:bg-red-300 rounded-md">
                    Cerrar
                </button>
                <button wire:click='publicarOferta({{ $item->id }})' class="ml-4 p-2 text-white bg-green-600 hover:bg-green-300 rounded-md">
                    Publicar Oferta
                </button>

            </x-slot>
        </x-dialog-modal>
    @endif

    @if ($actualizarDisp){{-- modal actualizar cantidad de oferta --}}
        <x-dialog-modal wire:model.live="actualizarDisp" maxWidth="2xl">
            <x-slot name="title">
                <div class="flex justify-between m-5">
                    <div class="text-xl">Actualizar Oferta</div>
                </div>
            </x-slot>
            <x-slot name="content">
                <div class="col-span-6 sm:col-span-4 text-xl my-10">
                    <div class="text-xl">Cambiar la Cantidad de Artículos en la Oferta</div>
                    <div>
                        <span>Cantidad Planeada: {{ $articulosActuales }}</span>
                        <br>
                        <span>Cantidad Disponible:
                            <input type="number" wire:model='articuloConMenorStock' class=" justify-items-center items-center w-28 text-xl">
                        </span>
                    </div>
                    <div class="col-span-6 sm:col-span-4 mt-4">
                        <div class="flex justify-center items-center">
                            <button wire:click='actualizarOferta({{ $actualizarDisp }})' class="ml-5 bg-blue-600 hover:bg-blue-300 text-white py-2 px-2 rounded-md">
                                Actualizar Oferta
                            </button>
                        </div>
                    </div>
                </div>
                <div>
                    <h2>{{ $mensajeUpdate }}</h2>
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button wire:click="cerrar()" wire:loading.attr="disabled">
                    Cerrar
                </x-secondary-button>
            </x-slot>
        </x-dialog-modal>
    @endif
</div>

