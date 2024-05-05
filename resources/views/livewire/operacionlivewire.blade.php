<div class="w-full p-2 sm:px-20 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
    <div class="mt-4 text-4xl flex justify-between shadow-inner">
        <div>Operacion</div>

    </div>

    <div class="mt-3w-full ">
        <div class="col-span-6 sm:col-span-4 mt-4 rounded">
            <div class=' text-4xl bg-blue-100 mt-4 ' >Selecionar Cliente</div>
            <select  id="inidad"  class="block  w-full mt-4 text-1xl content-end " name="unidad" wire:model='cliente_id' class="rounded"/>
                    <option value="">Seleccionar...</option>
                    @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id}}"  >
                        {{ $cliente->nombre}} , {{ $cliente->nombre}}
                    </option>
                @endforeach
            </select>
            <button wire:click='confirmarClienteAdd' class="bg-green-500 hover:bg-green-300">Agregar Cliente</button>
            <x-input-error for="unidad" class="mt-2" />
        </div>


        <div class="col-span-6 sm:col-span-4 mt-4 rounded">
            <div class=' text-4xl bg-blue-100 mt-4'> Seleccionar Forma de Pago</div>
            <select id="tipo"  class="block  w-full mt-4 text-1xl" wire:model='tipo_id'  wire:click='tipoVenta()' class="rounded"/>
                <option value="">Seleccionar...</option>
                @foreach ($tipoVentas as $tipo)
                    <option value="{{ $tipo->id}}"  >
                        {{ $tipo->id}}-{{ $tipo->tipoVenta}}
                    </option>
                @endforeach
            </select>
            <x-input-error for="tipo" class="mt-2" />

        </div>
        <div class="col-span-6 sm:col-span-4 ">
            <div class=' text-4xl bg-blue-100 mt-4'> Detalles:</div>
            <div class=' text-4xl mt-4 flex justify-end border'>
                <input type="text" wire:model="detalles" class=" w-full h-50">
            </div>
        </div>
        <div class="col-span-6 sm:col-span-4 ">
            <div class=' text-4xl bg-blue-100 mt-4'> Total Operacion:</div>
            <div class=' text-4xl mt-4 flex justify-end border'>
                <input type="text" wire:model="cuentaCorriente" style='{{ $ac }}'/>{{ $total }}
            </div>
        </div>

         </div>
        <div name="footer">
            <x-secondary-button wire:click="$toggle('confirmingArticuloOperacion', false)" wire:loading.attr="disabled">
                {{ __('Cancelar') }}
            </x-secondary-button>

            <x-danger-button class="ms-3" wire:click="ConfirmarVenta()" wire:loading.attr="disabled">
                {{ __('Eliminar') }}
            </x-danger-button>
        </div>




<!-- aDD User Confirmation Modal -->
<x-dialog-modal wire:model.live="confirmingClienteAdd">
    <x-slot name="title">
        {{ __('Cargar Cliente') }}
    </x-slot>

    <x-slot name="content">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="apellido" value="{{ __('Apellido') }}" />
            <x-input id="apellido" type="text" class="mt-1 block w-full" wire:model="apellido" name='apellido' />
            <x-input-error for="apellido" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4 mt-2">
            <x-label for="nombre" value="{{ __('Nombre') }}" />
            <x-input id="nombre" type="text" class="mt-1 block w-full" wire:model="nombre" name='nombre' />
            <x-input-error for="nombre" class="mt-2" />

        </div><div class="col-span-6 sm:col-span-4 mt-2">
            <x-label for="telefono" value="{{ __('Telefono') }}" />
            <x-input id="telefono" type="text" class="mt-1 block w-full" wire:model="telefono"  />
            <x-input-error for="telefono" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$toggle('confirmingClienteAdd', false)" wire:loading.attr="disabled">
            {{ __('Cancelar') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="saveCliente()" wire:loading.attr="disabled">
            {{ __('Guardar') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
  <!--Fin Add  Confirmation Modal --></div>
