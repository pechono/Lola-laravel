<div class="flex ">
        <div class=" h-auto  md:w-[70%]  m-5 ">

                <div class=" bg-white p-4 rounded-lg border">
                    <div class=" bg-white p-4 rounded-lg shadow-lg w-auto border">
                    {{-- articulos --}}
                        <div class="mt-4 text-2xl flex justify-between shadow-inner">
                            <div>Articulo</div>
                        </div>
                        <div>
                            <!-- Campo de búsqueda -->
                            <div class="mt-3">
                                <input wire:model.live="q" type="search" placeholder="Buscar" class="shadow appearance-none border rounded w-full py-2 px-3
                                    text-gray-700 leading-tight focus:outline-none focus:shadow-outline placeholder-blue-400">
                            </div>
                            @if (!$q)
                                <p class="text-gray-500 mt-2">Ingrese algún texto para buscar un artículo.</p>
                            @endif
                        </div>
                        <div class="mt-3 w-full rounded-lg border shadow-lg p-4">
                        @if ($q)

                            <table class="table-auto w-full">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2">Id</th>
                                        <th class="px-4 py-2">Codigo</th>
                                        <th class="px-4 py-2">Artículo</th>
                                        <th class="px-4 py-2">Unidad Cantidad</th>
                                        <th class="px-4 py-2">Precio Final</th>
                                        <th class="px-4 py-2">Stock</th>
                                        <th class=" py-2">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($articulos as $articulo)                
                                    
                                        @if (!$this->stockInsufisinte($articulo->id))
                                            <tr wire:key="{{ $articulo->id }}"
                                                class="cursor-pointer {{ $this->estaEnCarrito($articulo->id) ? 'hover:text-white hover:bg-red-400' : 'hover:text-white hover:bg-green-300' }}"
                                                wire:dblclick="{{ $estaEnCarrito ? 'deletCar('.$articulo->id.')' : 'addCar('.$articulo->id.')' }}"
                                                wire:loading.attr="disabled">
                                                <td class="rounder border px-4 py-2 {{ $this->Ofeta($articulo->id) ? 'text-green-500 font-bold':'' }}">{{ $articulo->id }}</td>
                                                <td class="rounder border px-4 py-2 {{ $this->Ofeta($articulo->id) ? 'text-green-500 font-bold':'' }}">{{ $articulo->codigo }}</td>

                                                <td class="rounder border px-4 py-2 {{ $this->Ofeta($articulo->id) ? 'text-green-500 font-bold':'' }}">{{ $articulo->articulo }}-{{ $articulo->presentacion }}-{{ $articulo->unidad }}</td>
                                                <td class="rounder border px-4 py-2 {{ $this->Ofeta($articulo->id) ? 'text-green-500 font-bold':'' }}">{{ $articulo->unidadVenta }}</td>
                                                <td class="rounder border px-4 py-2 {{ $this->Ofeta($articulo->id) ? 'text-green-500 font-bold':'' }}">{{ $articulo->precioF }}</td>
                                                <td class="rounder border px-4 py-2 {{ $this->Ofeta($articulo->id) ? 'text-green-500 font-bold':'' }}">
                                                    @if ($articulo->suelto == 1)
                                                        <div class="w-8 h-8 p-2 grid justify-items-center content-center bg-green-400 rounded-full">{{ $articulo->stock }}</div>
                                                    @else
                                                        {{ $articulo->stock }}
                                                    @endif
                                                </td>
                                                <td class="rounder border flex p-1 flex-wrap">
                                                    @if ($this->estaEnCarrito($articulo->id))

                                                        <button wire:click="deletCar({{ $articulo->id }})" wire:loading.attr="disabled" class="flex-1 bg-red-500 hover:bg-red-700 text-white font-bold p-2 rounded-lg ">
                                                            Elim
                                                        </button>
                                                        <button wire:click="modCar({{ $articulo->id }})" wire:loading.attr="disabled" class="ml-1 flex-1 bg-blue-500 hover:bg-blue-700 text-white font-bold p-2 rounded-lg "">
                                                            Mod
                                                        </button> 
                                                       
                                                    @else
                                                        <button wire:click="addCar({{ $articulo->id }})" wire:loading.attr="disabled" class="flex-1 bg-green-500 hover:bg-green-700 text-white font-bold p-2 rounded-lg ">
                                                            Agregar
                                                        </button>

                                                    @endif
                                                </td>
                                            </tr>      
                                        @endif
                                      
                                    @endforeach
                                </tbody>
                            </table>

                        @endif
                        </div>
                    {{-- fin articulos --}}
                </div>
                </div>
                <div class=" bg-white p-4 rounded-lg shadow-lg w-auto mt-10">
                        {{-- seleccionados --}}
                        <div class="mt-3 w-full rounded-lg border shadow-lg p-4">
                            <table class="">
                                <thead>
                                    <tr>
                                        <td class="px-4 py-2"><div class="flex items-center" >Id</div></td>
                                        <td class="px-4 py-2"><div class="flex items-center">Codigo</div></td>
                                        <td class="px-4 py-2"><div class="flex items-center">Articulo</div></td>
                                        <td class="px-4 py-2"><div class="flex items-center">Precio Final</div></td>
                                        <td class="px-4 py-2"><div class="flex items-center">S Min.</div></td>
                                        <td class="px-4 py-2"><div class="flex items-center">Stock</div></td>
                                        <td class="px-4 py-2"><div class="flex items-center">Cant.</div></td>
                                        <td class="px-4 py-2"><div class="flex items-center">Descuento.</div></td>
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
                                            <tr class="{{ $this->Ofeta($item->articulo_id) ? 'text-green-500 font-bold':'' }}">
                                                <td class="rounder border px-4 py-2">{{ $item->articulo_id }}</td>
                                                 <td class="rounder border px-4 py-2">{{ $item->codigo }}</td>

                                                <td class="rounder border px-4 py-2">{{ $item->articulo }} {{ $item->presentacion }} - {{ $item->unidad  }}</td>
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
                                                <td class="rounder border  py-1 flex p-1 flex-wrap">
                                                        <button wire:click="deletCar({{$item->articulo_id}})" wire:loading.attr="disabled" class="flex-1 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-2 rounded-lg ">
                                                            Elim
                                                        </button>
                                                        <button wire:click="modCar({{$item->articulo_id}})" wire:loading.attr="disabled" class="ml-1 flex-1 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded-lg "">
                                                            Mod
                                                        </button> 
                                                       
                                                   
                                                </td>
                                            </tr>
                                        @endforeach

                                </tbody>
                            </table>
                        </div>
                        {{-- fin seleccionados --}}
                </div>
        </div>

        <div class="w-30 bg-white  rounded-lg shadow-md   md:w-[25%]  m-5 h-3/4">
                 {{-- operacion --}}
                <div class=" w-auto rounded-lg shadow-md m-5 p-4">
                    <div class="col-span-6 sm:col-span-4  rounded-lg border shadow-lg ">
                        <div class="text-lg mt-4 px-5">Seleccionar Cliente</div>
                        <select id="cliente_id" class="block w-full mt-4 text-1xl rounded-md" name="cliente_id" wire:model='cliente_id'>
                            <option value="">Seleccionar...</option>
                            @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}">
                                {{ $cliente->apellido }} , {{ $cliente->nombre }}
                            </option>
                            @endforeach
                        </select>
                        <button wire:click='confirmarClienteAdd' class="text-white bg-green-500 hover:bg-green-300 rounded-md w-full py-2 px-5 mt-1.5" style="margin-top: 3px;">
                            Agregar Cliente
                        </button>
                        <x-input-error for="cliente_id" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4 mt-4 rounded-lg border shadow-lg ">
                        <div class="text-lg mt-4 px-5">Tipo de Venta</div>
                        <select id="tipo_id"  class="block  w-full mt-4 text-1xl" wire:model='tipo_id'  wire:click='tipoVenta()' class="rounded-md "/>
                            <option value="">Seleccionar...</option>
                            @foreach ($tipoVentas as $tipo)
                                <option value="{{ $tipo->id}}"  >
                                    {{ $tipo->id}}-{{ $tipo->tipoVenta}}
                                </option>
                            @endforeach
                        </select>

                        <x-input-error for="tipo_id" class="mt-2" />
                    </div>

                    <div class="flex bg-gray-100 pr-4 mb-10 mt-10 h-20 items-center border-gray-300 rounded-lg border  shadow-lg">
                        <div class="text-3xl flex items-end justify-end flex-grow mr-10">
                            Total:
                        </div>
                        <div class="text-4xl rounded-md shadow-sm flex items-center justify-end">
                            {{ $total }}
                        </div>
                    </div>
                </div>
                @if ($BloquearBoton)

                <div class=' rounded-lg border shadow-lg bg-green-400 m-4 p-2 flex justify-between'>
                    <x-danger-button wire:click="cancelarOperacion()" wire:loading.attr="disabled">
                        {{ __('Cancelar') }}
                    </x-danguer-button>
                        @if ($cliente_id || $tipo_id)
                        <x-secondary-button class="ms-3" wire:click="PreguntaConfirmarVenta()" wire:loading.attr="disabled">
                            {{ __('Confirmar') }}
                        </x-secondary-button>
                        @endif
                </div>
                @endif
                {{-- fin operacion --}}
            </div>

        {{-- modal --}}
        @if ($agregarCant)
        <x-dialog-modal wire:model.live="agregarCant" maxWidth="2xl">
            <x-slot name="title">
                {{ __('Selecionar Articulo') }}
            </x-slot>
            <x-slot name="content">
                <div class="rounded-t-lg" >
                    <table class="w-full rounded text-lg">
                        <thead>

                        </thead>
                        <tbody>
                        <tr  >
                                <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg font-semibold">Id</td>
                                <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg font-semibold">Articulo</td>

                            </tr>
                            <tr>
                                <td class="px-4 py-2 border">{{ $articulosMuestra->id }} </td>
                                <td class="px-4 py-2 border">{{ $articulosMuestra->articulo }} - {{ $articulosMuestra->presentacion }}-{{ $articulosMuestra->unidad }}</td>
                            <tr  >
                                <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg font-semibold">Stock Actual</td>
                                <td class="px-4 py-2 border border-slate-300 bg-sky-400/50 text-lg font-semibold">Precio Final</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 border">{{ $articulosMuestra->stock }}</td>
                                <td class="px-4 py-2 border">{{ $articulosMuestra->precioF }}</td>
                            </tr>
                            </tr>
                        </tbody>

                        <tfoot >
                            <tr >
                                <td colspan="1" class=" px-4 py-2 border border-slate-300 bg-sky-400/50  text-2xl font-semibold">
                                Ingresar Cantidad
                                </td>

                                <td colspan="1"  class="px-4 py-2 border border-slate-300 bg-sky-400/50  font-semibold text-right">
                                    <input 
                                    id="cantidadArt" 
                                    wire:model="cantidadArt" 
                                    @if ($agregarCant === 1)
                                        wire:keydown.enter="save({{ $articulosMuestra->id }}, {{ $articulosMuestra->stock }})"
                                    @elseif ($agregarCant === 2)
                                        wire:keydown.enter="updateSave({{ $articulosMuestra->id }}, {{ $articulosMuestra->stock }})"
                                    @endif
                                    type="text" 
                                    placeholder="0" 
                                    class="text-center text-4xl shadow appearance-none border rounded w-40 h-20 py-2 px-3"
                                />
                                <x-input-error for="cantidadArt" class="mt-2" />

                                </td>

                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div>{{ $majStock }}</div>
            </x-slot>

            <x-slot name="footer">
                <x-danger-button wire:click="$toggle('agregarCant', false)" wire:loading.attr="disabled">
                    {{ __('Cancelar') }}
                </x-danger-button>
                @if ($agregarCant==1 )
                    <x-secondary-button class="ms-3" wire:click="save({{ $articulosMuestra->id }}, {{ $articulosMuestra->stock }})" wire:loading.attr="disabled">
                    {{ __('Agregar Cantidad') }}
                    </x-secondary-button>
                @else<x-secondary-button class="ms-3" wire:click="updateSave({{ $articulosMuestra->id }}, {{ $articulosMuestra->stock }})" wire:loading.attr="disabled">
                    {{ __('Modificar Cantidad') }}
                    </x-secondary-button>
                    
                @endif
                
            </x-slot>
        </x-dialog-modal>
        @endif

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

        {{-- ----modal confirmar venta---- --}}
        <x-dialog-modal wire:model.live="confirmarOpVenta" maxWidth="2xl">
            <x-slot name="title">
                {{ __('Eliminar articulo') }}
            </x-slot>

            <x-slot name="content">
                {{ __('¿Esta seguro de Desea Realizar esta Operacion de Venta') }}
            </x-slot>

            <x-slot name="footer">
                <x-danger-button wire:click="$toggle('confirmarOpVenta', false)" wire:loading.attr="disabled">
                    {{ __('Cancelar') }}
                </x-danguer-button>

                <x-secondary-button class="ms-3" wire:click="ConfirmarVenta()" wire:loading.attr="disabled">
                    {{ __('Realizar Venta') }}
                </x-secondary-button>
            </x-slot>
        </x-dialog-modal>
        {{-- ---- Fin modal confirmar venta---- --}}
        <!-- aDD User Confirmation Modal -->
        <x-dialog-modal wire:model.live="confirmingClienteAdd" maxWidth="2xl">
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

<<<<<<< HEAD
                </div><div class="col-span-6 sm:col-span-4 mt-2">
=======
                </div>
                
                <div class="col-span-6 sm:col-span-4 mt-2">
                    <div>
                        <x-label for="dni" value="DNI " />
                        <x-input id="dni" type="text" class="mt-1 block w-full" wire:model='Ingresar DNI' placeholder="Descuento"/>
                        <x-input-error for="dni" class="mt-2" />
                    </div>
                </div>
                <div class="col-span-6 sm:col-span-4 mt-2">
>>>>>>> Servicios
                    <x-label for="telefono" value="{{ __('Telefono') }}" />
                    <x-input id="telefono" type="text" class="mt-1 block w-full" wire:model="telefono"  />
                    <x-input-error for="telefono" class="mt-2" />
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-danger-button wire:click="$toggle('confirmingClienteAdd', false)" wire:loading.attr="disabled">
                    {{ __('Cancelar') }}
                </x-danger-button>

                <x-secondary-button class="ms-3" wire:click="saveCliente()" wire:loading.attr="disabled">
                    {{ __('Guardar') }}
                </x-secondary-button>
            </x-slot>
        </x-dialog-modal>

</div>

