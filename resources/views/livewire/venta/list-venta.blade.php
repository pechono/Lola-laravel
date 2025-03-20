
<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg ">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg ">
        <div class="w-full p-2 sm:px-5 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                 <div class="flex">Informe de Venta</div>
                 <div class="flex mt-5">


                    <div x-data="{ visibleDiv: null }">
                        <button wire:click='cancelarD()' @click="visibleDiv = (visibleDiv === 'div1') ? null : 'div1'" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Dia</button>
                        <button wire:click='cancelarDE()' @click="visibleDiv = (visibleDiv === 'div2') ? null : 'div2'" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Entre Dias</button>
                        <button wire:click='cancelarM()' @click="visibleDiv = (visibleDiv === 'div3') ? null : 'div3'" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Meses</button>
                        <button wire:click='cancelarA()' @click="visibleDiv = (visibleDiv === 'div4') ? null : 'div4'" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Año</button>
                        <button wire:click='cancelarA()' @click="visibleDiv = (visibleDiv === 'div4') ? null : 'div4'" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Año</button>

                        <div x-show="visibleDiv === 'div1'" class="miDiv class="flex flex-col">

                                <div><label for="diaE">Elegir Dia</label></div>
                                <div><input id="diaE" type="date" wire:model.live='Dia' class=" rounded-lg"></div>

                        </div>
                        <div x-show="visibleDiv === 'div2'" class="miDiv flex flex-row items-center justify-between ">
                            <div class="flex-1 mr-4">
                                <label for="diaE1" class="block text-gray-700">Elegir Día 1</label>
                                <input id="diaE1" type="date" wire:model.live='fechaI' class="w-full rounded-lg mt-1">
                            </div>
                            <div class="flex-1 mr-4">
                                <label for="diaE2" class="block text-gray-700">Elegir Día 2</label>
                                <input id="diaE2" type="date" wire:model.live='fechaF' class="w-full rounded-lg mt-1">
                            </div>

                        </div>

                        <div x-show="visibleDiv === 'div3'" class="miDiv flex-col space-y-4">
                            <div class="flex-1 mr-4">
                                <label for="mes">Seleccionar mes:</label>
                                <select wire:model.live="mes" id="mes" name="mes" class="rounded-lg">
                                    <option value="">Seleccionar</option>
                                    @foreach($meses as $numeroMes => $nombreMes)
                                        <option value="{{ $numeroMes }}">{{ $nombreMes }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div x-show="visibleDiv === 'div4'" class="miDiv flex-col space-y-4">
                            <div class="flex-1 mr-4">
                                <label for="mes">Seleccionar Año:</label>
                                <select wire:model.live="anio" id="mes" name="anio" class="rounded-lg">
                                    <option value="">Seleccionar</option>
                                    @foreach($aniosUnicos as $aniosUnico)
                                        <option value="{{ $aniosUnico }}">{{ $aniosUnico }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>


                    <script>
                        // JavaScript
                        function ocultarDivsAnteriores(visibleDiv) {
                            var divs = document.querySelectorAll('.miDiv');
                            divs.forEach(function(div) {
                                if (div.id !== visibleDiv) {
                                    div.style.display = 'none';
                                }
                            });
                        }
                    </script>

                  </div>

            <div class="mt-4 text-2xl flex justify-between shadow-inner">
                <div>{{ $msj }}</div>
            </div>
            <div class="mt-3w-full mt-4">
                <table class="table-auto w-full border-collapse border">
                    <tbody>
                        @php
                         $totalVenta=0;
                        @endphp
                        @foreach ($operacions as $operacion)
                            @php
                                $totalVenta+=$operacion->venta;
                            @endphp
                            @if ($loop->first || $operacion->id != $o)
                                <tr class="mt-4">
                                    <td class="rounder border-l  border-r border-b border-white px-4 py-2 bg-slate-300" colspan="2">
                                        <div class=" content-between">
                                            <div>Operacion: {{ $operacion->id }}</div>
                                            <div>Fecha: {{ $operacion->created_at }} </div>
                                        </div>
                                    </td>
                                    <td class="rounder border-l  border-r border-b border-white px-4 py-2 bg-slate-300" colspan="2">Usuario: {{ $operacion->name }}  </td>
                                    <td class="rounder border-l  border-r border-b border-white px-4 py-2 bg-slate-300" colspan="2">Usuario: Cliente: {{ $operacion->apellido }}, {{ $operacion->nombre }}</td>

                                    <td class="rounder border-l  border-r border-b  border-white px-4 py-2 bg-slate-300" colspan="1">{{ $operacion->tipoVenta }}</td>

                                    <td class="rounder border-l  border-r border-b  border-white px-4 py-2 bg-slate-300" colspan="3"><div>Total {{ $operacion->venta }}</div></td>
                                </tr>
                                    <td class="rounder border-l  border-r border-b border-white border-3 px-4 py-2 bg-slate-300">id</td>
                                    <td class="rounder border-l  border-r border-b border-white border-3 px-4 py-2 bg-slate-300">Articulo</td>
                                    <td class="rounder border-l  border-r border-b border-white px-4 py-2 bg-slate-300">Categoria</td>
                                    <td class="rounder border-l  border-r border-b border-white px-4 py-2 bg-slate-300">Presentacion</td>
                                    <td class="rounder border-l  border-r border-b border-white px-4 py-2 bg-slate-300">Unidad de Venta</td>
                                    <td class="rounder border-l  border-r border-b border-white px-4 py-2 bg-slate-300">Descuento</td>
                                    <td class="rounder border-l  border-r border-b border-white px-4 py-2 bg-slate-300">Cantidad</td>
                                    <td class="rounder border-l  border-r border-b border-white px-4 py-2 bg-slate-300">Precio</td>
                                    <td class="rounder border-l  border-r border-b border-white px-4 py-2 bg-slate-300">Sub Total</td>
                                </tr>
                            @endif
                            <tr>
                                <td class="rounder border px-4 py-2">{{ $operacion->articulo_id }}</td>
                                <td class="rounder border px-4 py-2">{{ $operacion->articulo }}</td>
                                <td class="rounder border px-4 py-2">{{ $operacion->categoria }}</td>
                                <td class="rounder border px-4 py-2">{{ $operacion->presentacion }}-{{ $operacion->unidad }}</td>
                                <td class="rounder border px-4 py-2">{{ $operacion->unidadVenta }}</td>
                                <td class="rounder border px-4 py-2">{{ $operacion->descuento }}</td>
                                <td class="rounder border px-4 py-2">{{ $operacion->cantidad }}</td>
                                <td class="rounder border px-4 py-2">{{ $operacion->precioF }}</td>
                                <td class="rounder border px-4 py-2">{{ ($operacion->precioF*$operacion->cantidad)-($operacion->precioF*$operacion->cantidad*$operacion->descuento)/100 }}</td>

                            </tr>
                            @if ($loop->first || $operacion->id != $o)
                            <tr>
                                <td class=" h-3"></td>
                            </tr>
                            @endif
                            @php
                                $o = $operacion->id;
                            @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="mt-4">
                            <td class="rounder border-l  border-r border-b  border-white px-4 py-2 bg-slate-300" colspan="3">Cliente: {{ $totalVenta}}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="mt-2">

                </div>
        </div>
    </div>
<script>
    function ocultarDiv() {
        var div = document.querySelector('.diaE');
        div.classList.add('hidden');
    }
</script>
</div>







