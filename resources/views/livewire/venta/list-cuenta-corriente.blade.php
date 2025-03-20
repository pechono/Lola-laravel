<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
        <div class="w-full p-2 sm:px-5 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
            <div class="mt-4 text-2xl flex justify-between shadow-inner">
                <div>Pagos - Cuenta Corriente</div>

            </div>
            <table class="table-auto w-full">
                <thead>

                    <tr>
                        <td class="px-4 py-2">
                            <div class="flex items-center">Id</div>
                        </td>
                        <td class="px-4 py-2">
                            <div class="flex items-center">Apellido</div>
                        </td>
                        <td class="px-4 py-2">
                            <div class="flex items-center">Nombre</div>
                        </td>
                        <td class="px-4 py-2">
                            <div class="flex items-center">Telefono</div>
                        </td>
                        <td class="px-4 py-2">
                            <div class="flex items-center">Accion</div>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($clientes as $cliente)
                    <tr>
                        <td class="rounded border px-4 py-2">{{ $cliente->id }}</td>
                        <td class="rounded border px-4 py-2">{{ $cliente->apellido }}</td>
                        <td class="rounded border px-4 py-2">{{ $cliente->nombre }}</td>
                        <td class="rounded border px-4 py-2">{{ $cliente->telefono }}</td>
                        <td class="rounded border px-4 py-2">
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
        </div>
    </div>

    <x-dialog-modal wire:model.live="verCuentaCorriente" maxWidth="2xl">
        <x-slot name="title">
            <div class="mt-4 text-2xl flex justify-between shadow-inner">
                <div>Cuenta Corriente</div>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="rounded-t-lg">
                @if ($verCuentaCorriente)
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <td class="text-lg rounded border border-white px-4 py-2 bg-slate-300" colspan="2">Cuenta Corriente</td>
                            <td class="text-lg rounded border border-white px-4 py-2 bg-slate-300" colspan="1">Deuda</td>
                            <td class="text-lg rounded border px-4 py-2">{{ $op->total }}</td>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-lg rounded border border-r border-b border-white px-4 py-2 bg-slate-300">Cliente</td>
                        <td class="text-lg rounded border px-4 py-2">{{ $op->apellido }},{{ $op->nombre }}</td>
                        <td class="text-lg rounded border border-r border-b border-white px-4 py-2 bg-slate-300">Entrega</td>
                        <td class="text-lg rounded border px-4 py-2">
                            <!-- Puedes mostrar el total de entrega aquí -->
                            {{ $entregaSum->sum('entrega') }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-lg rounded border px-4 py-2" colspan="3">
                            <p>* El valor de la deuda está en función de los artículos y si estos varían desde el momento de su entrega.</p>
                            <p>* Las entregas de dinero se acumularán hasta completar el monto que cancele la deuda.</p>
                        </td>
                        <td class="text-lg rounded border px-4 py-2" colspan="1">{{ $op->total - $entregaSum->sum('entrega') }}
                            @if (($op->total - $entregaSum->sum('entrega'))==0)
                                <x-secondary-button wire:click='modalCuentaCorriente({{ $IdCliente }})'>
                                    Ver
                                </x-secondary-button>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-lg rounded border px-4 py-2" colspan="2">
                            <x-input id="entrega" type="text" class="mt-1 block w-full" wire:model='entrega' placeholder="0"/>
                            <x-input-error for="entrega" class="mt-2" />
                        </td>
                        <td class="text-lg rounded border px-4 py-2" colspan="2">
                            <button wire:click='pagar()' class="px-2 py-2 bg-green-600 hover:bg-green-300 text-white"> Entregar</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-lg rounded border border-r border-b border-white px-4 py-2 bg-slate-300" colspan="2">Fecha</td>
                        <td class="text-lg rounded border border-r border-b border-white px-4 py-2 bg-slate-300" colspan="2">Entrega</td>
                    </tr>
                    @forelse ($entregaSum as $entrega)
                    <tr>
                        <td class="text-lg rounded border px-4 py-2"colspan="2">{{ $entrega->created_at }}</td>
                        <td class="text-lg rounded border px-4 py-2"colspan="2">{{ $entrega->entrega }}</td>
                    </tr>
                    @empty
                    <td class="text-lg rounded border px-4 py-2"> <h2>No hay Entregas</h2></td>
                    @endforelse
                    </tbody>
                </table>
                @endif
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-danger-button wire:click="$toggle('verCuentaCorriente', false)" wire:loading.attr="disabled">
                {{ __('Cancelar') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model.live="confirmarPago">
        <x-slot name="title">
            Confirmar Pago
        </x-slot>
        <x-slot name="content">
            ¿Estás seguro de que deseas realizar esta entrega?
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmarPago', false)" wire:loading.attr="disabled">
                {{ __('Cancelar') }}
            </x-secondary-button>
            <x-danger-button class="ml-2" wire:click="entregaCuentaCorriente()" wire:loading.attr="disabled">
                {{ __('Confirmar') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
    {{-- ------ --}}
    <x-dialog-modal wire:model.live="verOperacion" >
        <x-slot name="title">
            <h1>Cuenta Corriente</h1>
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
</div>

