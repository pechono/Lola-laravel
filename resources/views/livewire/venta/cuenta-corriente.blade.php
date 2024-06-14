<div class="p-2 sm:px-5 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
    <div class="mt-4 text-2xl flex justify-between shadow-inner">
    <div>Pedidos Realizados</div>

    </div>

   <div class="mt-3">
    <div class="flex justify-between">
        <div>
            <input wire:model.live='q' type="search" placeholder="Buscar" class="shadow appearance-none border rounded w-full py-2 px-3

            text-gray-706 leading-tight focus:outline-none focus: shadow-outline placeholder-blue-400" name="">
        </div>


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
                    <div class="flex items-center">Deuda</div>
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
                <td class="rounder border px-4 py-2">{{ $cliente->total_entregas }}</td>
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
   </div>
   {{-- <div class="mt-2">{{ $clientes->links() }}</div> --}}

   <!-- Delete User Confirmation Modal -->
    <x-dialog-modal wire:model.live="verCuentaCorriente" class="w-3/5">
        <x-slot name="title">
            <h1>Ver Pedido</h1>
        </x-slot>

        <x-slot name="content" class="w-full">
            <div class='w-full'>
            <table class=" table auto w-full border rounded-sm">
                <thead>
                 @if ($verCuentaCorriente)
                    <tr >
                        <td class=' text-xl bg-blue-100 mt-4 border' colspan="2">Cuenta Corriente</td>
                    </tr>
                    <tr >
                        <td class=' text-lg  mt-4 border'> Cliente: </td>
                        <td class=' text-lg mt-4 border'>{{ $clienteDeuda->apellido }}, {{ $clienteDeuda->nombre }}</td>
                    </tr>
                    <tr >
                        <td class=' text-lg mt-4 border'> Deuda:  </td>
                        <td class=' text-lg mt-4 border''>{{ $clienteDeuda->total_entregas }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="h-12"></td>
                    </tr>
                    <tr>
                        <td  class=' text-lg  mt-4 border'>
                            </div><div class="col-span-6 sm:col-span-4 mt-2">
                                <x-label for="entrega" value="Entrega" />
                                <x-input id="entrega" type="text" class="mt-1 block w-full" wire:model="entrega"  />
                                <x-input-error for="entrega" class="mt-2" />
                            </div>
                        </td>
                        <td  class=' text-lg  mt-4 border'>
                            <x-label for="entrega" value="" />
                            <x-secondary-button wire:click="entregarD({{ $clienteDeuda->id }})" wire:loading.attr="disabled" class=" text-white bg-green-700 hover:bg-green-500">
                                Entregar
                            </x-secondary-button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="h-12"></td>
                    </tr>
                    <tr  >
                        <td class=' text-lg bg-blue-100 mt-6 border'>Entrega</td>
                        <td class=' text-lg bg-blue-100 mt-6 border'>Fecha</td>
                    </tr>
                    @endif
                </thead>
                <tbody>
                    @foreach ( $cuentaCorriente as $cuenta )
                    <tr>
                        <td class=' text-lg border mt-4  '>{{ $cuenta->entrega}}  </td>
                        <td class=' text-lg border mt-4  '>{{ $cuenta->created_at }} </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </x-slot>


        <x-slot name="footer">

            <x-secondary-button wire:click="$toggle('verCuentaCorriente', false)" wire:loading.attr="disabled">
                Cancelar
            </x-secondary-button>
        </x-slot>

</x-dialog-modal>
    <!--Fin Delete  Confirmation Modal -->
</div>
