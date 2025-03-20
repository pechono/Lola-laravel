<div class="w-full p-2 sm:px-5 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
    <div class="mt-4 text-2xl flex justify-between shadow-inner">
        <div>Generar Pedido a Proveedores</div>
        <div class="mr-2">

            {{-- <x-button wire:click='confirmarArticuloAdd' class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Crear Nuevo articulo
            </x-button> --}}
        </div>
    </div>

    <div class="mt-3w-full ">
        <div class="flex justify-between">
            <div class="col-span-6 sm:col-span-4 mt-2 rounded">
                <x-label for="proveedor" value="{{ __('Proveedor') }}" />
                <select id="proveedor_id"  class="block mt-1 w-full"  wire:model='proveedor_id' class="rounded"/>
                <option value="">Seleccionar...</option>
                @foreach ($proveedores as $proveedor)
                        <option value="{{ $proveedor->id}}"  >
                            {{ $proveedor->id}}-{{ $proveedor->nombre}}-{{ $proveedor->rubro}}-{{ $proveedor->localidad}}
                        </option>
                    @endforeach
                </select>
                <x-input-error for="proveedor_id" class="mt-2" />

            </div>
                <button wire:click='guardarPedido()' class="mb-4 h-9 px-4 py-2 bg-blue-500 text-white rounded">Imprimir</button>

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
                           Solicitar
                        </div>
                    </td>
                </tr>
            </thead>
            <tbody>

                @foreach ($inTheCar as $car)
                <tr>
                    <td class="rounder border px-4 py-2">{{ $car->id }}</td>
                    <td class="rounder border px-4 py-2">{{ $car->articulo }}</td>
                    <td class="rounder border px-4 py-2">{{ $car->categoria }}</td>
                    <td class="rounder border px-4 py-2">{{ $car->presentacion }}-{{ $car->unidad }}</td>
                    <td class="rounder border px-4 py-2">{{ $car->cantidad }}</td>


                </tr>
                @endforeach
            </tbody>
        </table>
   </div>

     <x-dialog-modal wire:model.live="modal" maxWidth="2xl">
        <x-slot name="title">
            {{ __('Eliminar articulo') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Se agenerado un pedido a Proveedor') }}
        </x-slot>

        <x-slot name="footer">
            <button wire:click='cerrar()' class=" h-10 bg-green-600 hover:bg-green-300 py-2 px-4 rounded mr-2 text-white" > Cerrar</button>
            @if ($operacion)
            <a href="{{ route('pedidoImprimir', ['id'=>$operacion]) }}" target="_blank" rel="noopener noreferrer" class="mb-4 h-10 px-4 py-2 bg-blue-500 text-white rounded">
                imprimir
            </a>
            @endif

    </x-slot>
    </x-dialog-modal>
</div>>
