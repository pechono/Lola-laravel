<div class="p-2 sm:px-20 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
    <div class="mt-4 text-2xl flex justify-between shadow-inner">
    <div>Operaciones  Realizadas</div>

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
                       <button wire:click="sortby('id')">Operacion</button>
                     <x-sort-icon sortFiel='id': sortBy=$sortBy, sortAsc=$sortAsc/>
                    </div>
                </td>
                <td class="px-4 py-2">
                    <div class="flex items-center">
                        <Button wire:click="sortby('apellido')">Venta</Button>
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
                    <div class="flex items-center">
                        <Button wire:click="sortby('telefono')">Tipo de Venta</Button>
                        <x-sort-icon sortFiel='telefono': sort-by='$sortBy' : sort-asc='$sortAsc/'>
                    </div>
                </td>
                <td class="px-4 py-2">
                    <div class="flex items-center">
                        <Button wire:click="sortby('telefono')">Cliente</Button>
                        <x-sort-icon sortFiel='telefono': sort-by='$sortBy' : sort-asc='$sortAsc/'>
                    </div>
                </td>
                <td class="px-4 py-2">
                    <div class="flex items-center">
                        <Button wire:click="sortby('telefono')">Usuario</Button>
                        <x-sort-icon sortFiel='telefono': sort-by='$sortBy' : sort-asc='$sortAsc/'>
                    </div>
                </td>
                <td class="px-4 py-2">
                    <div class="flex items-center">Accion</div>
                </td>
            </tr>
        </thead>
        <tbody>
            @forelse ($ops as $op)
            <tr>
                <td class="rounder border px-4 py-2">{{ $op->id }}</td>
                <td class="rounder border px-4 py-2">{{ $op->venta }}</td>
                <td class="rounder border px-4 py-2">{{ $op->Fecha }}</td>
                <td class="rounder border px-4 py-2">{{ $op->tipoVenta }}</td>
                <td class="rounder border px-4 py-2">{{ $op->apellido  }}, {{ $op->nombre }}</td>
                <td class="rounder border px-4 py-2">{{ $op->name  }}</td>
                <td class="rounder border px-4 py-2">
                    <x-secondary-button wire:click='verOp({{ $op->id }})'>
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
    <x-dialog-modal wire:model.live="verOperacion" class="w-80">
        <x-slot name="title">
            {{ __('Eliminar Cliente') }}
        </x-slot>

        <x-slot name="content" class="w-full">
            <div class='w-full'>
            <table class=" table auto w-full border rounded-sm">
                <thead>
                    <tr ><td class=' text-lg bg-blue-100 mt-4 border' colspan="6"> Venta Operacion: {{ $operacion }}</td></tr>
                    <tr ><td class=' text-lg bg-blue-100 mt-4 border' colspan="1"> Cleinte: </td><td colspan="5" class=' text-lg mt-4 '>{{ $cliente }}</td></tr>
                    <tr ><td class=' text-lg bg-blue-100 mt-4 border' colspan="1"> Tipo De Venta: </td><td colspan="5" class=' text-lg mt-4 '>{{ $tipo }}</td></tr>
                    <tr><td colspan="6 h-12"></td></tr>
                    <tr  >
                        <td class=' text-lg bg-blue-100 mt-6 border '>Articulo</td>
                        <td class=' text-lg bg-blue-100 mt-6 border'>Descripcion</td>
                        <td class=' text-lg bg-blue-100 mt-6 border'>Precio</td>
                        <td class=' text-lg bg-blue-100 mt-6 border'>Cantidad</td>
                        <td class=' text-lg bg-blue-100 mt-6 border'>Descuento</td>
                        <td class=' text-lg bg-blue-100 mt-6 border'>Sub Total</td>

                    </tr>
                </thead>
                <tbody>
                @foreach ($ventaOp as $vOp)
                    <tr >
                        <td class=' text-lg border mt-4  '>{{ $vOp->articulo }}</td>
                        <td class=' text-lg border mt-4  '>{{ $vOp->presentacion }}-{{ $vOp->unidad }}</td>
                        <td class=' text-lg border mt-4  '>{{ $vOp->precioF }}</td>
                        <td class=' text-lg border mt-4  '>{{ $vOp->cantidad }}</td>
                        <td class=' text-lg border mt-4  '>{{ $vOp->descuento }}</td>
                        <td class=' text-lg border mt-4  '>{{ ($vOp->precioF*$vOp->cantidad)-($vOp->precioF*$vOp->cantidad*$vOp->descuento/100) }}</td>
                    </tr>
                @endforeach
                </tbody>

            </table>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('verOperacion', false)" wire:loading.attr="disabled">
                'Cancelar'
            </x-secondary-button>

        </x-slot>
    </x-dialog-modal>
    <!--Fin Delete  Confirmation Modal -->


</div>
