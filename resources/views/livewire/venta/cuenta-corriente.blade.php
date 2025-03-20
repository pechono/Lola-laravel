<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg ">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg ">
        <div class="w-full p-2 sm:px-5 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
            <div class="mt-4 text-2xl flex justify-between shadow-inner">
                <div>Operaciones Por Cliente- Cuenta Corriente</div>

            </div>
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <td class="px-4 py-2">
                            <div class="flex items-center" >
                               <button wire:click="sortby('id')">id</button>
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
                                <Button wire:click="sortby('telefono')">telefono</Button>
                                <x-sort-icon sortFiel='telefono': sort-by='$sortBy' : sort-asc='$sortAsc'/>
                            </div>
                        </td>

                        <td class="px-4 py-2">
                            <div class="flex items-center">Accion</div>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($clientes as $cliente)
                    <tr>
                        <td class="rounder border px-4 py-2">{{ $cliente->id }}</td>
                        <td class="rounder border px-4 py-2">{{ $cliente->apellido }}</td>
                        <td class="rounder border px-4 py-2">{{ $cliente->nombre }}</td>
                        <td class="rounder border px-4 py-2">{{ $cliente->telefono }}</td>
                        <td class="rounder border px-4 py-2">
                            <x-secondary-button wire:click='modalCuenta({{ $cliente->id }})'>
                                Ver
                            </x-secondary-button>
                        </td>
                    </tr>
                    @empty
                    <h2>No hay registro</h2>
                    @endforelse
                </tbody>
            </table>
             <!-- Delete User Confirmation Modal -->

        </div>
    </div>
    <x-dialog-modal wire:model.live="verOperacion" >
        <x-slot name="title">
            <div class="mt-4 text-2xl flex justify-between shadow-inner">
                <div>Cuenta Corriente</div>

            </div>

        </x-slot>
        <x-slot name="content" class="w-full">
            <div class='w-full'>
                <div class="flex justify-between items-center">
                    <div></div>
                    <div>
                        <button wire:click='mostrar()' class="ml-auto text-white bg-blue-500 hover:bg-blue-700 rounded-md p-2">Colocar Precio</button>
                    </div>
                </div>
                <div class="mt-3w-full mt-4">
                    <table class="table-auto w-full border-collapse border">
                        <tbody>
                            @php
                                $totalVenta = 0;
                                $prevOperacionId = null;
                                $div = true;
                            @endphp

                            @foreach ($operacions as $operacion)
                                @php
                                    $totalVenta += $operacion->venta;
                                @endphp

                                @if ($loop->first || $operacion->id != $prevOperacionId)
                                    <tr class="mt-10">
                                        @if ($div)
                                            @php
                                                $div = false;
                                            @endphp
                                        @else
                                            <tr>
                                                <td class="h-8 border-0"></td>
                                            </tr>
                                        @endif

                                        <td class="text-lg rounded border-l border-r border-b border-white px-4 py-2 bg-slate-300" colspan="2">
                                            <div class="flex flex-col space-y-2">
                                                <div>Operacion: {{ $operacion->id }}</div>
                                                <div>Fecha: {{ $operacion->created_at }} </div>
                                            </div>
                                        </td>
                                        <td class="text-lg rounded border-l border-r border-b border-white px-4 py-2 bg-slate-300" colspan="2">
                                            Usuario: {{ $operacion->name }}
                                        </td>
                                        <td class="text-lg rounded border-l border-r border-b border-white px-4 py-2 bg-slate-300" colspan="2">
                                            Cliente: {{ $operacion->apellido }}, {{ $operacion->nombre }}
                                        </td>
                                        <td class="text-lg rounded border-l border-r border-b border-white px-4 py-2 bg-slate-300" colspan="3">
                                            <div>Total: {{ $operacion->venta }}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-lg rounded border-l border-r border-b border-white px-4 py-2 bg-slate-300">ID</td>
                                        <td class="text-lg rounded border-l border-r border-b border-white px-4 py-2 bg-slate-300">Articulo</td>
                                        <td class="text-lg rounded border-l border-r border-b border-white px-4 py-2 bg-slate-300">Unidad de Venta</td>
                                        <td class="text-lg rounded border-l border-r border-b border-white px-4 py-2 bg-slate-300">Cantidad</td>
                                        <td class="text-lg rounded border-l border-r border-b border-white px-4 py-2 bg-slate-300">Precio Actual</td>
                                        <td class="text-lg rounded border-l border-r border-b border-white px-4 py-2 bg-slate-300">Sub Total</td>
                                        <td class="text-lg rounded border-l border-r border-b border-white px-4 py-2 bg-slate-300">
                                            @if ($boton)

                                                @if(!$this->estaDentro($operacion->id))
                                                    <button wire:click="PonerPrecio({{ $operacion->id }})" class=" text-white bg-green-700 hover:bg-green-500 rounded-md px-2">Pagar</button>
                                                @else
                                                    <button wire:click="eliminar({{ $operacion->id }})"  class=" text-white bg-red-700 hover:bg-red-500 rounded-md px-2">Quitar</button>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td class="text-lg rounded border px-4 py-2">{{ $operacion->articulo_id }}</td>
                                    <td class="text-lg rounded border px-4 py-2">{{ $operacion->articulo }} {{ $operacion->presentacion }}-{{ $operacion->unidad }}</td>
                                    <td class="text-lg rounded border px-4 py-2">{{ $operacion->unidadVenta }}</td>
                                    <td class="text-lg rounded border px-4 py-2">{{ $operacion->cantidad }}</td>
                                    <td class="text-lg rounded border px-4 py-2">{{ $operacion->precioF }}</td>
                                    <td class="text-lg rounded border px-4 py-2">{{ $operacion->precioF * $operacion->cantidad }}</td>
                                </tr>
                                @php $prevOperacionId = $operacion->id; @endphp
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="mt-4 " colspan=''>
                                <td class=" text-right text-lg rounded border-l border-r border-b border-white px-4 py-2 bg-slate-300" colspan="7">Total {{ $total }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                {{-- fin operacion --}}
            </div>

        </x-slot>
        <x-slot name="footer">
            <div class="flex justify-between mt-2">
                <div class="flex space-x-2">
                    <button class="h-9 px-4 py-2 bg-red-600 hover:bg-red-300 text-white rounded flex items-center justify-center"
                        wire:click="$toggle('verOperacion', false)" wire:loading.attr="disabled">
                            Cancelar
                    </button>
                    <button class="h-9 px-4 py-2 bg-green-600 hover:bg-green-300 text-white rounded flex items-center justify-center"
                        wire:click="confirmarCuenta()" wire:loading.attr="disabled">
                            Realizar Pago
                    </button>
                </div>
            </div>
        </x-slot>
    </x-dialog-modal>
    {{-- ----modal confirmar Pago---- --}}
    <x-dialog-modal wire:model.live="confirmar" maxWidth="2xl">
        <x-slot name="title">
            {{ __('Eliminar articulo') }}
        </x-slot>

        <x-slot name="content">
            {{ __('¿Esta seguro de Desea Realizar la Operacion de Pago de Cuenta Corriente') }}
        </x-slot>

        <x-slot name="footer">
            <x-danger-button wire:click="cancelar()" wire:loading.attr="disabled">
                {{ __('Cancelar') }}
            </x-danguer-button>

            <x-secondary-button class="ms-3" wire:click="ConfirmarPago()" wire:loading.attr="disabled">
                {{ __('Realizar Pago') }}
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>
     {{-- ---- Fin modal confirmar Pago---- --}}
</div>
