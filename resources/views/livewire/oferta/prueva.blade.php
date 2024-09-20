<div class="w-auto mx-auto sm:px-6 lg:px-8">
    <div class="justify-center">
        <table class="table-auto w-full rounded-md">
            @php $previousOfferId = null; @endphp

            @forelse ($ofertaList as $item)
                @if ($loop->first || $item->id != $previousOfferId)
                    @if (!$loop->first)
                        <tr><td colspan="7" class="py-4"></td></tr>
                    @endif
                    <tr>
                        <td colspan="3" class="px-4 py-2 border border-white bg-sky-400/50 text-lg">
                            Oferta Número: {{ $item->id }}
                        </td>
                        <td colspan="5" class="px-4 py-2 border border-white">
                            <div class="flex justify-end w-auto">
                                <button wire:click='publicarModal' class="p-2 text-white bg-sky-600 hover:bg-sky-300 rounded-md">
                                    Publicar Oferta
                                </button>
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
                    <td colspan="7" class="text-center">No hay artículos ofertados disponibles loco.</td>
                </tr>
            @endforelse
        </table>
    </div>

    @if ($actualizarDisp)
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
                        <span>Cantidad Planeada: </span>
                        <span>Cantidad Disponible: </span>
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <div class="flex justify-center items-center">
                            <button wire:click='actualizarOferta' class="ml-5 bg-blue-600 hover:bg-blue-300 text-white py-2 px-2 rounded-md">
                                Actualizar Oferta
                            </button>
                        </div>
                    </div>
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

