<div class="w-full p-2 sm:px-5 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
    <div class="mt-4 text-2xl flex justify-between shadow-inner">
        <div>Generar Pedido a Proveedores</div>
        <div class="mr-2">

            {{-- <x-button wire:click='confirmarArticuloAdd' class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Crear Nuevo articulo
            </x-button> --}}
        </div>
    </div>

    <div class="mt-3 w-full ">
        <div class="flex justify-between">
            <div>
                <input wire:model.live='q' type="search" placeholder="Buscar" class="shadow appearance-none border rounded w-full py-2 px-3

                text-gray-706 leading-tight focus:outline-none focus: shadow-outline placeholder-blue-400" name="">
            </div>
            <div class="mr-2">
                <input class="mr-2 leading-tight" type="checkbox" wire:model.live ='active'/ value="1" checked>Articulos Activos
                @if ($hasRecords>0)
                    <button wire:click='borrarCar()' class=" rounded bg-sky-600 hover:bg-sky-400 text-white hover:text h-8 p-2 ml-4"> Borrar Pedido</button>
                    <a href="{{ route('stock.confirmarPedido') }}"  class=" rounded bg-sky-600 hover:bg-sky-400 text-white h-8 p-2 ml-4">Realizar Pedido</a>
                @endif

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
                            <Button wire:click="sortby('articulo')">Articulo</Button>
                            <x-sort-icon sortFiel='apellido': sort-by='$sortBy' : sort-asc='$sortAsc'>

                        </div>
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex items-center">
                            <Button wire:click="sortby('categoria_id')">Categoria</Button>
                            <x-sort-icon sortFiel='nombre': sort-by='$sortBy' : sort-asc='$sortAsc'/>
                        </div>
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex items-center">
                            <Button >Presentacion</Button>
                            <x-sort-icon sortFiel='telefono': sort-by='$sortBy' : sort-asc='$sortAsc/'>
                        </div>
                    </td>

                    <td class="px-4 py-2">
                        <div class="flex items-center">
                            <Button wire:click="sortby('unidadVenta')">Unidad Cantidad</Button>
                            <x-sort-icon sortFiel='telefono': sort-by='$sortBy' : sort-asc='$sortAsc/'>
                        </div>
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex items-center">
                            <Button wire:click="sortby('precioI')">Precio Inicial</Button>
                            <x-sort-icon sortFiel='telefono': sort-by='$sortBy' : sort-asc='$sortAsc/'>
                        </div>
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex items-center">
                            <Button wire:click="sortby('precioF')">Precio Final</Button>
                            <x-sort-icon sortFiel='telefono': sort-by='$sortBy' : sort-asc='$sortAsc/'>
                        </div>
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex items-center">
                            <Button wire:click="sortby('caducidad')">Cadc.</Button>
                            <x-sort-icon sortFiel='telefono': sort-by='$sortBy' : sort-asc='$sortAsc/'>
                        </div>
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex items-center">
                            <Button wire:click="sortby('detalles')">Detalles</Button>
                            <x-sort-icon sortFiel='telefono': sort-by='$sortBy' : sort-asc='$sortAsc/'>
                        </div>
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex items-center">
                            <Button wire:click="sortby('stockMinimo')">Stock Minimo</Button>
                            <x-sort-icon sortFiel='telefono': sort-by='$sortBy' : sort-asc='$sortAsc/'>
                        </div>
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex items-center">
                            <Button wire:click="sortby('stock')">Stock
                                <div class="w-15 h-8 p-2 grid justify-items-center content-center bg-green-400 rounded-full">suelto</div>

                            </Button>
                            <x-sort-icon sortFiel='telefono': sort-by='$sortBy' : sort-asc='$sortAsc/'>
                        </div>
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex items-center">
                            <Button wire:click="sortby('nombre')">Proveedor</Button>
                            <x-sort-icon sortFiel='nombre': sort-by='$sortBy' : sort-asc='$sortAsc/'>
                        </div>
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex items-center">
                           Solicitar
                        </div>
                    </td>
                    <td class="px-4 py-2" colspan="3">
                        <div class="flex items-center" >Accion</div>

                    </td>


                </tr>
            </thead>
            <tbody>

                @foreach ($articulos as $articulo)
                <tr>
                    <td class="rounder border px-4 py-2">{{ $articulo->id }}</td>
                    <td class="rounder border px-4 py-2">{{ $articulo->articulo }}</td>
                    <td class="rounder border px-4 py-2">{{ $articulo->categoria }}</td>
                    <td class="rounder border px-4 py-2">{{ $articulo->presentacion }}-{{ $articulo->unidad }}</td>

                    <td class="rounder border px-4 py-2">{{ $articulo->unidadVenta }}</td>
                    <td class="rounder border px-4 py-2">{{ $articulo->precioI }}</td>
                    <td class="rounder border px-4 py-2">{{ $articulo->precioF }}</td>
                    <td class="rounder border px-4 py-2">{{ $articulo->caducidad }}</td>
                    <td class="rounder border px-4 py-2">{{ $articulo->detalles }}</td>
                    <td class="rounder border px-4 py-2">{{ $articulo->stockMinimo }}</td>
                    <td class="rounder border px-4 py-2">
                        @if ($articulo->suelto==1)
                            <div class="w-8 h-8 p-2 grid justify-items-center content-center bg-green-400 rounded-full">{{ $articulo->stock }}</div>
                        @else
                            {{ $articulo->stock }}
                        @endif
                    </td>
                    <td class="rounder border px-4 py-2">{{ $articulo->nombre }}</td>
                    @php
                       $sta=false;
                    @endphp
                   {{--  @foreach ($inTheCar as $car)
                        @if ($car->articulo_id==$articulo->id)
                            @php
                                $sta=true;
                            @endphp
                            <td class="rounder border px-4 py-2">{{ $car->cantidad }}</td>

                        @endif
                    @endforeach

                    @if (!$sta)
                        <td class="rounder border px-4 py-2">-</td>
                        <td class="rounder border px-4 py-2 content-center" colspan="3">
                            <x-secondary-button  wire:click="addCar({{ $articulo->id }})" wire:loading.attr="disabled" class="bg-green-700 hover:bg-green-500 text-white ">
                                Solicitar
                            </x-secondary-button>
                        </td>
                    @else
                        <td class="rounder border-t border-b px-4 py-2 ">
                            <x-button  wire:click="ModCar({{ $articulo->id }})" wire:loading.attr="disabled" class="bg-blue-700 hover:bg-glue-500">
                                Modificar
                            </x-button>
                        <td>
                        <td class="rounder border-t border-b border-r px-4 py-2 ">
                            <x-danger-button  wire:click="elimCar({{ $articulo->id }})" wire:loading.attr="disabled" class="bg-green-700 hover:bg-green-500">
                                Quitar
                            </x-danger-button>
                        </td>


                    @endif --}}
                @php
                    // Busca si el artículo está en el carrito
                    $car = $inTheCar->firstWhere('articulo_id', $articulo->id);
                @endphp

                <td class="rounder border px-4 py-2">
                    {{ $car ? $car->cantidad : '-' }}
                </td>

                @if ($car)
                    <td class="rounder border-t border-b px-4 py-2">
                        <x-button wire:click="ModCar({{ $articulo->id }})" wire:loading.attr="disabled" class="bg-blue-700 hover:bg-blue-500">
                            Modificar
                        </x-button>
                    </td>
                    <td class="rounder border-t border-b border-r px-4 py-2">
                        <x-danger-button wire:click="elimCar({{ $articulo->id }})" wire:loading.attr="disabled" class="bg-green-700 hover:bg-green-500">
                            Quitar
                        </x-danger-button>
                    </td>
                @else
                    <td class="rounder border px-4 py-2 content-center" colspan="3">
                        <x-secondary-button wire:click="addCar({{ $articulo->id }})" wire:loading.attr="disabled" class="bg-green-700 hover:bg-green-500 text-white">
                            Solicitar
                        </x-secondary-button>
                    </td>
                @endif


                </tr>
                @endforeach
            </tbody>
        </table>
   </div>

    <div class="mt-2">
    {{--   {{ $articulos->links() }} --}}
    </div>


       {{-- ----modal confirmar venta---- --}}
    <x-dialog-modal wire:model.live="eliminar" maxWidth="2xl">
            <x-slot name="title">
                {{ __('Eliminar articulo') }}
            </x-slot>

            <x-slot name="content">
                <div class="rounded-t-lg" >
                    <table class="table-auto rounded">
                        <thead>
                            <th>
                                <td colspan="4" class="text-lg font-semibold">Venta</td>
                            </th>
                        </thead>
                        <tbody>
                        <tr  >
                                <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg font-semibold">Id</td>
                                <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg font-semibold">Articulo</td>
                                <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg font-semibold">Descripcion</td>

                            </tr>
                            <tr>
                                <td class="px-4 py-2 border">{{ $id }} </td>
                                <td class="px-4 py-2 border">{{ $art }}</td>
                                <td class="px-4 py-2 border">{{ $categoria }} - {{ $presentacion }}-{{ $unidad }}</td>

                            </tr>
                            <tr  >

                                <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg font-semibold">Stock Minimo</td>
                                <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg font-semibold">Stock Actual</td>
                                <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg font-semibold">Proveedor</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 border">{{ $stockMinimo }}</td>
                                <td class="px-4 py-2 border">{{ $stock }}</td>
                                <td class="px-4 py-2 border">{{ $proveedor }}</td>
                            </tr>
                        </tbody>

                        <tfoot >
                            <tr >
                                <td colspan="2" class=" px-4 py-2 border border-slate-300 bg-sky-400/50  text-4xl font-semibold">
                               Eliminar
                                </td>
                                <td colspan="2"  class=" px-4 py-2 border border-slate-300 bg-sky-400/50   font-semibold">
                                    <input disabled id="pedido" wire:model='pedido' type="text" placeholder="0" class="text-center text-4xl shadow appearance-none border rounded w-full h-20 py-2 px-3">
                                    <x-input-error for="pedido" class="mt-2" />
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-danger-button wire:click="$toggle('eliminar', false)" wire:loading.attr="disabled">
                    {{ __('Cancelar') }}
                </x-danguer-button>

                <x-danger-button class="ms-3" wire:click="eliminarElementCar({{ $id }})" wire:loading.attr="disabled">
                    {{ __('Quitar del Pedido') }}
                </x-danger-button>
            </x-slot>
    </x-dialog-modal>
     {{-- ---- Fin modal confirmar venta---- --}}


     {{-- modal------------------------------------------------------------------------------- --}}
     <x-dialog-modal wire:model.live="agregarCar" maxWidth="2xl">
        <x-slot name="title">
            {{ __('Solicitar a Proveedores') }}
        </x-slot>
        <x-slot name="content">
            <div class="rounded-t-lg" >
                <table class="table-auto rounded">
                    <thead>
                        <th>
                            <td colspan="4" class="text-lg font-semibold">Venta</td>
                        </th>
                    </thead>
                    <tbody>
                    <tr  >
                            <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg font-semibold">Id</td>
                            <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg font-semibold">Articulo</td>
                            <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg font-semibold">Descripcion</td>

                        </tr>
                        <tr>
                            <td class="px-4 py-2 border">{{ $id }} </td>
                            <td class="px-4 py-2 border">{{ $art }}</td>
                            <td class="px-4 py-2 border">{{ $categoria }} - {{ $presentacion }}-{{ $unidad }}</td>

                        </tr>
                        <tr  >

                            <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg font-semibold">Stock Minimo</td>
                            <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg font-semibold">Stock Actual</td>
                            <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg font-semibold">Proveedor</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 border">{{ $stockMinimo }}</td>
                            <td class="px-4 py-2 border">{{ $stock }}</td>
                            <td class="px-4 py-2 border">{{ $proveedor }}</td>
                        </tr>
                    </tbody>

                    <tfoot >
                        <tr >
                            <td colspan="2" class=" px-4 py-2 border border-slate-300 bg-sky-400/50  text-4xl font-semibold">
                           {{ $msj }}
                            </td>
                            <td colspan="2"  class=" px-4 py-2 border border-slate-300 bg-sky-400/50   font-semibold">
                                <input id="pedido" wire:model='pedido' type="text" placeholder="0" class="text-center text-4xl shadow appearance-none border rounded w-full h-20 py-2 px-3">
                                <x-input-error for="pedido" class="mt-2" />
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-danger-button wire:click="$toggle('agregarCar', false)" wire:loading.attr="disabled">
                {{ __('Cancelar') }}
            </x-danger-button>
            @if ($var==1)
            <x-secondary-button class="ms-3" wire:click="crearPedido({{ $id }})" wire:loading.attr="disabled">
                {{ __('Agregar') }}
            </x-secondary-button>
            @else
            <x-secondary-button class="ms-3" wire:click="modPedido({{ $id }})" wire:loading.attr="disabled">
                {{ __('Modificar') }}
            </x-secondary-button>
            @endif

        </x-slot>
    </x-dialog-modal>
    {{-- modal---------------------------------------fin---------------------------------------- --}}

    <x-dialog-modal wire:model.live="borrar">
        <x-slot name="title">
            {{ __('Eliminar articulo') }}
        </x-slot>

        <x-slot name="content">
            {{ __('¿Esta seguro de Desea cancelar el Pedido?') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('borrar', false)" wire:loading.attr="disabled">
                {{ __('Cancelar') }}
            </x-secondary-button>

            <x-danger-button class="ms-3" wire:click="confirmarElimin()" wire:loading.attr="disabled">
                {{ __('Eliminar') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>



</div>>
