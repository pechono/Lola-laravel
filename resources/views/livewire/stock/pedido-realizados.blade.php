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
                       <button wire:click="sortby('id')">Pedido</button>
                     <x-sort-icon sortFiel='id': sortBy=$sortBy, sortAsc=$sortAsc/>
                    </div>
                </td>
                <td class="px-4 py-2">
                    <div class="flex items-center">
                        <Button wire:click="sortby('apellido')">Proveedor</Button>
                        <x-sort-icon sortFiel='apellido': sort-by='$sortBy' : sort-asc='$sortAsc'>

                    </div>
                </td>
                <td class="px-4 py-2">
                    <div class="flex items-center">
                        <Button wire:click="sortby('nombre')">Fecha</Button>
                        <x-sort-icon sortFiel='nombre': sort-by='$sortBy' : sort-asc='$sortAsc'/>
                    </div>
                </td>
                    <td class="px-4 py-2">
                    <div class="flex items-center">Accion</div>
                </td>
            </tr>
        </thead>
        <tbody>
            @forelse ($pedidos as $op)
            <tr>
                <td class="rounder border px-4 py-2">{{ $op->pedido }}</td>
                <td class="rounder border px-4 py-2">{{ $op->nombre }}{{ $op->localidad }}</td>
                <td class="rounder border px-4 py-2">{{ $op->Fecha }}</td>
                <td class="rounder border px-4 py-2">
                    <x-secondary-button wire:click='verPed({{ $op->pedido }})'>
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
    <x-dialog-modal wire:model.live="verPedido" class="w-3/5">
        <x-slot name="title">
            <h1>Ver Pedido</h1>
        </x-slot>

        <x-slot name="content" class="w-full">
            <div class='w-full'>
            <table class=" table auto w-full border rounded-sm">
                <thead>
                 @if ($verPedido)
                    <tr >
                        <td class=' text-xl bg-blue-100 mt-4 border' colspan="2"> Pedido a Proveedor N: {{ $pedido }}</td>
                    </tr>
                    <tr >
                        <td class=' text-lg  mt-4 border'> Empresa: </td>
                        <td class=' text-lg mt-4 '>{{ $proveedor }}</td>
                    </tr>
                    <tr >
                        <td class=' text-lg mt-4 border'> Localidad: </td>
                        <td class=' text-lg mt-4 '>{{ $localidad }}</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="h-12"></td>
                    </tr>
                    <tr  >
                        <td class=' text-lg bg-blue-100 mt-6 border'>Articulo</td>
                        <td class=' text-lg bg-blue-100 mt-6 border'>Cantidad</td>
                    </tr>
                    @endif
                </thead>
                <tbody>
                    @foreach ( $artPedido as $op )
                    <tr>
                        <td class=' text-lg border mt-4  '>{{ $op->articulo}}  {{ $op->presentacion }} {{ $op->unidad }}</td>
                        <td class=' text-lg border mt-4  '>{{ $op->cantidad }} </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </x-slot>


        <x-slot name="footer">
            @if ($pedido)
                <a href="{{ route('pedidoImprimir',['id'=>$pedido]) }}" target="_blank" class=" px-4 py-2 bg-blue-500 text-white rounded">
                    Imprimir Comprobante
                </a>
            @endif
            <x-secondary-button wire:click="$toggle('verPedido', false)" wire:loading.attr="disabled">
                Cancelar
            </x-secondary-button>
        </x-slot>

</x-dialog-modal>
    <!--Fin Delete  Confirmation Modal -->
</div>
