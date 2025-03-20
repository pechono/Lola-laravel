<div class=" flex flex-col  w-3/4 ">
    <div class=" bg-white p-4 rounded-lg border">
        <div class=" bg-white p-4 rounded-lg shadow-lg w-auto border">
            <div class="mt-4 text-2xl flex justify-between shadow-inner">
                <div>Cierre de Caja</div>
            </div>
            <div class="mt-10 text-xl flex justify-between ">
                <p>{{ $fecha_formateada }}</p>
            </div>
        </div>
    </div>

    <div class="flex mt-5 justify-between">
        <div class="flex-1 bg-white  p-4 rounded-lg border mr-2">
            <div class="bg-white p-4 rounded-lg shadow-lg w-full border">
                <div class="mt-4 text-2xl flex justify-between shadow-inner">
                    <div>Efectivo</div>
                </div>
                <div class="mt-10 text-xl flex justify-between">
                    <p>Total: ${{ $this->efectivo }}</p>
                </div>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-lg w-full border mt-5">
                <div class="mt-4 text-2xl flex justify-between shadow-inner">
                    <div>Debito</div>
                </div>
                <div class="mt-10 text-xl flex justify-between">
                    <p>Total: ${{ $this->debito }}</p>
                </div>
            </div>
        </div>

        <div class="flex-1 bg-white p-4 rounded-lg border mx-2">
            <div class="bg-white p-4 rounded-lg shadow-lg w-full border">
                <div class="mt-4 text-2xl flex justify-between shadow-inner">
                    <div>Tarjeta</div>
                </div>
                <div class="mt-10 text-xl flex justify-between">
                    <p> Total: ${{ $this->tarjeta }}</p>
                </div>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-lg w-full border mt-5">
                <div class="mt-4 text-2xl flex justify-between shadow-inner">
                    <div>Cuenta Corriente</div>
                </div>
                <div class="mt-10 text-xl flex justify-between">
                    <p>Total: ${{ $this->cuentaCorientes}}</p>
                </div>
            </div>
        </div>
        <div class="flex-1 bg-white p-4 rounded-lg border ml-2 ">
            <div class="bg-white p-4 rounded-lg shadow-lg w-full border">
                <div class="mt-4 text-2xl flex justify-between shadow-inner">
                    <div>Opeeraciones realizadad</div>
                </div>
                <div class="mt-10 text-xl flex justify-between">
                    <table class="table-auto w-full">
                             @foreach ($ventasPorTipo as $item)
                            <tr>
                                <th class="px-4 py-2 text-left">{{ $item->tipoVenta}}:</th>
                                <th class="px-4 py-2 text-left">{{ $item->total_ventas }}</th>

                            </tr>
                            @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="flex-1 bg-white p-4 rounded-lg border ml-2 ">
            <div class=" bg-white px-4 rounded-lg shadow-lg w-auto border">
                <div class="mt-4 text-2xl flex justify-between shadow-inner">
                    <div>Cierre de Caja con un Ingreso de</div>
                </div>
                <div class="mt-10 text-4xl flex justify-between ">
                    <p>${{ $this->efectivo+$this->debito+$this->tarjeta+$this->cuentaCorientes }}</p>
                </div>
            </div>
            <div class=" bg-white p-4 rounded-lg shadow-lg w-auto border mt-5">

                <div class="mt-2 text-2xl flex justify-center shadow-inner">
                    <button wire:click='cerrarModal()' class=" p-3 bg-green-600 hover:bg-green-300 text-white rounded-md">Cierre De Caja</button>
                </div>

            </div>
        </div>
    </div>
    <div class=" bg-white p-4 rounded-lg border mt-5">

    </div>
    {{-- --modal --}}
    <x-dialog-modal wire:model.live="confirmarCierre" maxWidth="2xl">
        <x-slot name="title">
            {{ __('Cierre de Caja') }}
        </x-slot>

        <x-slot name="content">
            {{ __('¿Esta seguro de Desea Realizar Cierre de Caja') }}
        </x-slot>

        <x-slot name="footer">
            <x-danger-button wire:click="$toggle('confirmarCierre', false)" wire:loading.attr="disabled">
                {{ __('Cancelar') }}
            </x-danguer-button>

            <x-secondary-button class="ms-3" wire:click="realizarCierre()" wire:loading.attr="disabled">
                {{ __('Realizar Venta') }}
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>
</div>

