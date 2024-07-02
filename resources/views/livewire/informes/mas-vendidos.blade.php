<!-- resources/views/livewire/mas-vendidos.blade.php -->

<div class=" bg-white p-4 rounded-lg border">
    <div class=" bg-white p-4 rounded-lg shadow-lg w-auto border">
        <div class="mt-4 text-3xl flex justify-between shadow-inner">
            <div>Los Mas Vendido</div>
        </div>
        <div class="mt-10 text-xl flex justify-between ">
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Artículo</th>
                        <th class="px-4 py-2">Total Vendido</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($articulosMasVendidos as $articulo)
                        <tr>
                            <td class="border px-4 py-2">{{ $articulo->articulo }}</td>
                            <td class="border px-4 py-2">{{ $articulo->total_vendido }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


