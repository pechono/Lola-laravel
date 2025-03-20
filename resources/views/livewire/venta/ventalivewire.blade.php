<div>
    <div class="flex justify-between">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg w-auto">
            <div class="   p-2 sm:px-5 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                <div class="mt-4 text-2xl flex justify-between shadow-inner">
                    <div>Articulo </div>
                </div>
                    <table class="table-auto ">
                        <thead>
                            <tr>
                                <td class="px-4 py-2"><div class="flex items-center" >Id</div></td>
                                <td class="px-4 py-2"><div class="flex items-center">Articulo</div></td>
                                <td class="px-4 py-2"><div class="flex items-center">Presentacion</div> </td>
                                <td class="px-4 py-2"><div class="flex items-center">Unidad Cantidad</div></td>
                                <td class="px-4 py-2"><div class="flex items-center">Precio Final</div></td>
                                <td class="px-4 py-2"><div class="flex items-center"> Stock Minimo</div></td>
                                <td class="px-4 py-2"><div class="flex items-center">Stock</div></td>
                                <td class="px-4 py-2"><div class="flex items-center">Cantidad</div></td>
                                <td class="px-4 py-2"><div class="flex items-center">Descuento</div></td>
                                <td class="px-4 py-2"><div class="flex items-center">Sub Total</div></td>
                                <td class="px-4 py-2"><div class="flex items-center">Accion</div></td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $subtotal=0;
                                $total=0;
                            @endphp
                                @foreach ($inTheCar as $item)
                                    <tr>
                                        <td class="rounder border px-4 py-2">{{ $item->articulo_id }}</td>
                                        <td class="rounder border px-4 py-2">{{ $item->articulo }}</td>
                                        <td class="rounder border px-4 py-2">{{ $item->presentacion }}-{{ $item->unidad  }}</td>
                                        <td class="rounder border px-4 py-2">{{ $item->unidadVenta }}</td>
                                        <td class="rounder border px-4 py-2">{{ $item->precioF  }}</td>
                                        <td class="rounder border px-4 py-2">{{ $item->stockMinimo }}</td>
                                        <td class="rounder border px-4 py-2">{{ $item->stock }}</td>
                                        <td class="rounder border px-4 py-2">{{ $item->cantidad }}</td>
                                        <td class="rounder border px-4 py-2">
                                            <div class="flex items-center ">
                                                <div class="w-6">{{ $item->descuento }}</div>
                                                <div class="w-5">
                                                    <button class=' h-18 w-16 text-white text-l rounded-md bg-green-600 hover:bg-green-300' wire:click="descuentoArt({{ $item->articulo_id }})" wire:loading.attr="disabled" >
                                                    Desc.
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                        @php
                                        $subtotal=($item->cantidad * $item->precioF)-($item->cantidad * $item->precioF)*$item->descuento/100;
                                        $total+=$subtotal;
                                        @endphp
                                        <td class="rounder border px-4 py-2">{{ $subtotal}}</td>
                                        <td class="rounder border px-4 py-2">
                                            <x-danger-button wire:click="deletCar({{ $item->articulo_id }})" wire:loading.attr="disabled" >
                                                Eliminar
                                            </x-danger-button>
                                        </td>
                                    </tr>
                                @endforeach

                        </tbody>
                    </table>

            </div>
        </div>
       {{-- --------------------------------- --}}
       <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg ">
                <div class="mt-4 text-2xl flex justify-between shadow-inner">
                    <div class="m-10">
                        Operacion
                    </div>
                </div>
                <div class=" ">

                    <table class="table-auto">
                        <thead>
                            <tr>
                                <td class="px-4 py-2 w-auto" colspan="2">
                                   Total
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="rounder border px-4 py-2 shadow-inner m-10 text-xl">{{ $total }}</td>
                                <td class="rounder border px-4 py-2 shadow-inner m-10">
                                    @if (!$countCar==0)
                                        <x-nav-link href="{{ route('operacion.index') }}" :active="request()->routeIs('operacion.index')" class="inline-flex items-center px-4 py-2 bg-sky-400 dark:bg-gray-300 hover:bg-sky-600  border border-gray-300 dark:border-gray-500 rounded-md  font-semibold text-xs hover:text-white dark:text-gray-300 uppercase tracking-widest shadow-sm  dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                                          Prepara Venta
                                         </x-nav-link>
                                    @else
                                     {{$countCar}} Elementos selecionados
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
        </div>

      </div>
    {{-- articulos lista -------------------------------------------------------------------- --}}
    {{-- articulos lista -------------------------------------------------------------------- --}}
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg mt-10">

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg ">
            <div class="w-full p-2 sm:px-5 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                <div class="mt-4 text-2xl flex justify-between shadow-inner">
                    <div>Articulo</div>

                </div>

                <div class="mt-3w-full ">
                    <div class="flex justify-between">
                         <div class="flex">
                            <input wire:model.live='q' type="search" placeholder="Buscar" class="shadow appearance-none border rounded w-full py-2 px-3
                            text-gray-706 leading-tight focus:outline-none focus: shadow-outline placeholder-blue-400" name="">

                        </div>
                        <div class="mr-2">
                            <input class="mr-2 leading-tight" type="checkbox" wire:model.live ='active'/ value="1" checked>Articulos Activos
                        </div>

                    </div>
                    <table class="table-auto w-full">
                        <thead>
                            <tr wire:click=''>
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
                                        <Button wire:click="sortby('descuento')">Desc.</Button>
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
                                        <Button wire:click="sortby('stock')">Stock</Button>
                                        <x-sort-icon sortFiel='telefono': sort-by='$sortBy' : sort-asc='$sortAsc/'>
                                    </div>
                                </td>
                                <td class="px-4 py-2">
                                    <div class="flex items-center">Accion</div>

                                </td>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach ($articulos as $articulo)
                                    @php
                                        $sta=false;
                                    @endphp
                                    @forelse ($inTheCar as $car)
                                        @if ($car->articulo_id==$articulo->id)
                                            @php
                                                $sta=true;
                                            @endphp
                                        @endif
                                    @empty

                                    @endforelse
                            @if ($sta)

                                <tr wire:dblclick="deletCar({{ $articulo->id }})" wire:loading.attr="disabled" class="cursor-pointer hover:text-white hover:bg-red-600">
                            @else

                                <tr  wire:dblclick="addCar({{ $articulo->id }})" wire:loading.attr="disabled" class="cursor-pointer hover:text-white hover:bg-green-300">

                            @endif

                                    <td class="rounder border px-4 py-2">{{ $articulo->id }}</td>
                                    <td class="rounder border px-4 py-2">{{ $articulo->articulo }}</td>
                                    <td class="rounder border px-4 py-2">{{ $articulo->categoria }}</td>
                                    <td class="rounder border px-4 py-2">{{ $articulo->presentacion }}-{{ $articulo->unidad }}</td>
                                    <td class="rounder border px-4 py-2">{{ $articulo->descuento }}</td>
                                    <td class="rounder border px-4 py-2">{{ $articulo->unidadVenta }}</td>
                                    <td class="rounder border px-4 py-2">{{ $articulo->precioI }}</td>
                                    <td class="rounder border px-4 py-2">{{ $articulo->precioF }}</td>
                                    <td class="rounder border px-4 py-2">{{ $articulo->caducidad }}</td>
                                    <td class="rounder border px-4 py-2">{{ $articulo->detalles }}</td>
                                    <td class="rounder border px-4 py-2">{{ $articulo->stockMinimo }}</td>
                                    <td class="rounder border px-4 py-2">@if ($articulo->suelto==1)
                                                                            <div class="w-8 h-8 p-2 grid justify-items-center content-center bg-green-400 rounded-full">{{ $articulo->stock }}</div>
                                                                        @else
                                                                            {{ $articulo->stock }}

                                                                        @endif</td>
                                    <td class="rounder border px-4 py-2">

                                        @if ($sta)
                                            <x-danger-button wire:click="deletCar({{ $articulo->id }})" wire:loading.attr="disabled" >
                                                Eliminar
                                            </x-danger-button>
                                        @else
                                            <x-secondary-button wire:click="addCar({{ $articulo->id }})" wire:loading.attr="disabled" class="bg-green-700 hover:bg-green-500">
                                                Agregar
                                            </x-secondary-button>
                                        @endif
                                    </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
            </div>
                <div class="mt-2">
                {{ $articulos->links() }}

                </div>

            </div>
    </div>
    {{-- articulos lista -------fin---------------------------------------------------------- --}}
    {{-- articulos lista -------fin---------------------------------------------------------- --}}




    {{-- modal------------------------------------------------------------------------------- --}}
    {{-- modal------------------------------------------------------------------------------- --}}
    <x-dialog-modal wire:model.live="confirmingVenta" maxWidth="2xl">
        <x-slot name="title">
            {{ __('Selecionar Articulo') }}
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
                            <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg font-semibold">"Descripcion</td>
                            <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg font-semibold">Precio Inicial</td>
                            <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg font-semibold">Precio Final</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 border">{{ $id }} </td>
                            <td class="px-4 py-2 border">{{ $art }}</td>
                            <td class="px-4 py-2 border">{{ $categoria }} - {{ $presentacion }}-{{ $unidad }}</td>
                            <td class="px-4 py-2 border">{{ $precioI }}</td>
                            <td class="px-4 py-2 border">{{ $precioF }}</td>
                        </tr>
                        <tr  >
                            <td class="px-4 py-2 border border-slate-300 bg-sky-400/50  text-lg font-semibold">Caducidad</td>
                            <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg font-semibold">Descuento</td>
                            <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg font-semibold">Detalles</td>
                            <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg font-semibold">Stock Minimo</td>
                            <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg font-semibold">Stock Actual</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 border">{{ $caducidad}} </td>
                            <td class="px-4 py-2 border">{{ $descuento }}</td>
                            <td class="px-4 py-2 border">{{ $detalles}}</td>
                            <td class="px-4 py-2 border">{{ $stockMinimo }}</td>
                            <td class="px-4 py-2 border">{{ $stock }}</td>
                        </tr>
                    </tbody>

                    <tfoot >
                        <tr >
                            <td colspan="3" class=" px-4 py-2 border border-slate-300 bg-sky-400/50  text-4xl font-semibold">
                            Ingresar Cantidad
                            </td>

                            <td colspan="2"  class=" px-4 py-2 border border-slate-300 bg-sky-400/50   font-semibold">
                                <input id='cantidadArt' wire:model='cantidadArt' type="text" placeholder="0" class="text-center text-4xl shadow appearance-none border rounded w-full h-20 py-2 px-3">
                                <x-input-error for="cantidadArt" class="mt-2" />

                            </td>

                        </tr>
                    </tfoot>
                </table>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-danger-button wire:click="$toggle('confirmingVenta', false)" wire:loading.attr="disabled">
                {{ __('Cancelar') }}
            </x-danger-button>

            <x-secondary-button class="ms-3" wire:click="save({{ $id }})" wire:loading.attr="disabled">
                {{ __('Agregar Cantidad') }}
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>
    {{-- modal---------------------------------------fin---------------------------------------- --}}
    {{-- modal---------------------------------------fin---------------------------------------- --}}

    {{-- modal------------------------------------------------------------------------------- --}}
    {{-- modal------------------------------------------------------------------------------- --}}
    <x-dialog-modal wire:model.live="cDescuento" maxWidth="2xl">
        <x-slot name="title">
            {{ __('Seleecionar Articulo') }}
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
                            <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg font-semibold">"Descripcion</td>
                            <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg font-semibold">Precio Inicial</td>
                            <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg font-semibold">Precio Final</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 border">{{ $id }} </td>
                            <td class="px-4 py-2 border">{{ $art }}</td>
                            <td class="px-4 py-2 border">{{ $categoria }} - {{ $presentacion }}-{{ $unidad }}</td>
                            <td class="px-4 py-2 border">{{ $precioI }}</td>
                            <td class="px-4 py-2 border">{{ $precioF }}</td>
                        </tr>
                        <tr  >
                            <td class="px-4 py-2 border border-slate-300 bg-sky-400/50  text-lg font-semibold">Caducidad</td>
                            <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg font-semibold">Descuento</td>
                            <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg font-semibold">Detalles</td>
                            <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg font-semibold">Stock Minimo</td>
                            <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg font-semibold">Stock Actual</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 border">{{ $caducidad}} </td>
                            <td class="px-4 py-2 border">{{ $descuento }}</td>
                            <td class="px-4 py-2 border">{{ $detalles}}</td>
                            <td class="px-4 py-2 border">{{ $stockMinimo }}</td>
                            <td class="px-4 py-2 border">{{ $stock }}</td>
                        </tr>
                    </tbody>

                    <tfoot >
                        <tr >
                            <td colspan="3" class=" px-4 py-2 border border-slate-300 bg-sky-400/50  text-4xl font-semibold">
                            Aplicar Descuento
                            </td>
                            <td colspan="2"  class=" px-4 py-2 border border-slate-300 bg-sky-400/50   font-semibold">
                                <input id="descArt" wire:model='descArt' type="text" placeholder="0" class="text-center text-4xl shadow appearance-none border rounded w-full h-20 py-2 px-3">
                                <x-input-error for="descArt" class="mt-2" />
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-danger-button wire:click="$toggle('cDescuento', false)" wire:loading.attr="disabled">
                {{ __('Cancelar') }}
            </x-danger-button>

           <x-secondary-button class="ms-3" wire:click="saveDescuento({{ $id }})" wire:loading.attr="disabled">
                {{ __('Aceptar Descuento') }}
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>
    {{-- modal---------------------------------------fin---------------------------------------- --}}
    {{-- modal---------------------------------------fin---------------------------------------- --}}


</div>
