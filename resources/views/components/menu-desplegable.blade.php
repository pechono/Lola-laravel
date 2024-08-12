<!-- resources/views/components/menu-stock.blade.php -->
<div id="mySidebar" class="fixed inset-y-0 left-0 w-0 bg-gray-800 text-white overflow-x-hidden transition-all duration-500 z-50">
    <button class="absolute top-4 right-4 text-2xl" onclick="closeNav()">&times;</button>
    <nav class="pt-6 space-y-2">
        <div class="hoverDiv">
            <a href="javascript:void(0)" class=" py-2 px-2 hover:bg-gray-700 flex items-center" onclick="toggleSubMenu('homeSubMenu')">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 9.75L12 4l9 5.75v11.25h-6v-6h-6v6H3V9.75z" />
                </svg>
                <span class="movableDiv transition-transform duration-300 ease-in-out">Home</span>
            </a>
            <div id="homeSubMenu" class="pl-8 hidden text-lg">
                <a href="#" class="block py-1 px-4 hover:bg-gray-600">Sub Home 1</a>
                <a href="#" class="block py-1 px-4 hover:bg-gray-600">Sub Home 2</a>
            </div>
        </div>
        <div class="hoverDiv w-full text-green-400">
            <a href="javascript:void(0)" class=" py-2 px-2 hover:bg-gray-700 flex items-center" onclick="toggleSubMenu('ventaSubMenu')">
                <div class="flex justify-between items-center w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-16 w-16">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                      </svg>

                    <span class="movableDiv text-3xl rounded-lg transition-transform duration-300 ease-in-out text-white">Venta</span>
                </div>
            </a>
            <div id="ventaSubMenu" class="pl-8 hidden text-lg  text-white">
                <a href="{{ route('venta.ventaExpress') }}" class="hover:text-xl block py-1 px-4 hover:bg-gray-600">Venta Express</a>
                <a href="{{ route('venta.cuentaCorriente') }}" class="hover:text-xl block py-1 px-4 hover:bg-gray-600">Cuenta Corriente</a>
                <a href="{{ route('venta.ListCuentaCorriente') }}" class="hover:text-xl block py-1 px-4 hover:bg-gray-600">Pago Cuenta Corriente</a>
                <a href="{{ route('cierre.cierreCaja') }}" class="hover:text-xl block py-1 px-4 hover:bg-gray-600">Cierre Caja</a>
            </div>
        </div>
        <div class="hoverDiv w-full text-yellow-300">
            <a href="javascript:void(0)" class=" py-2 px-2 hover:bg-gray-700 flex items-center" onclick="toggleSubMenu('stockSubMenu')">
                <div class="flex justify-between items-center w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-16 w-16">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                      </svg>
                    <span class="movableDiv text-3xl rounded-lg transition-transform duration-300 ease-in-out text-white">Stock</span>
                </div>
            </a>
            <div id="stockSubMenu" class="pl-8 hidden text-lg  text-white">
                <a href="{{ route('stock.index') }}" class="hover:text-xl block py-1 px-4 hover:bg-gray-600">Stock</a>
                <a href="{{ route('articulo.index') }}" class="hover:text-xl block py-1 px-4 hover:bg-gray-600"></a>
                <a href="{{ route('stock.pedido') }}" class="hover:text-xl block py-1 px-4 hover:bg-gray-600">Pedido A Proveedor</a>
                <a href="{{ route('stock.pedidoRealizado') }}" class="hover:text-xl block py-1 px-4 hover:bg-gray-600">Pedidos Realizados</a>
                <a href="{{ route('stockImprimir') }}" target="_blank" class="hover:text-xl prose-indigoblock py-1 px-4 hover:bg-gray-600">Imprimir Stock Actual</a>
            </div>
        </div>
        <div class="hoverDiv w-full text-blue-700">
            <a href="javascript:void(0)" class=" py-2 px-2 hover:bg-gray-700 flex items-center" onclick="toggleSubMenu('informesSubMenu')">
                <div class="flex justify-between items-center w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-16 w-16">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                    </svg>
                    <span class="movableDiv text-3xl rounded-lg transition-transform duration-300 ease-in-out text-white">Estadísticas</span>
                </div>
            </a>
            <div id="informesSubMenu" class="pl-8 hidden text-lg  text-white ">

                    <a href="{{ route('informes.masVendidos') }}" class="hover:text-xl py-1 px-4 hover:bg-gray-600 rounded-lg flex justify-end">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 14.25v2.25m3-4.5v4.5m3-6.75v6.75m3-9v9M6 20.25h12A2.25 2.25 0 0 0 20.25 18V6A2.25 2.25 0 0 0 18 3.75H6A2.25 2.25 0 0 0 3.75 6v12A2.25 2.25 0 0 0 6 20.25Z" />
                        </svg>
                        <span class=" ml-5 movableDiv text-xl rounded-lg transition-transform duration-300 ease-in-out text-white">El Más Vendido</span>
                    </a>

            </div>
        </div>
        <div class="hoverDiv w-full text-orange-500">
            <a href="javascript:void(0)" class=" py-2 px-2 hover:bg-gray-700 flex items-center" onclick="toggleSubMenu('operacionSubMenu')">
                <div class="flex justify-between items-center w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                    </svg>
                    <span class="movableDiv  text-3xl transition-transform duration-300 ease-in-out text-white">Operaciones</span>
                </div>
            </a>
            <div id="operacionSubMenu" class="pl-2 hidden text-lg  text-white">
                <a href="{{ route('operacion.list') }}" class="hover:text-xl block py-1 px-4 hover:bg-gray-600">Operaciones</a>
                <a href="{{ route('venta.list') }}" class="hover:text-xl block py-1 px-4 hover:bg-gray-600">Ventas</a>
            </div>
        </div>
        <div class="hoverDiv w-full text-gray-500">

                <a href="javascript:void(0)" class=" py-2 px-2 hover:bg-gray-700 flex items-center" onclick="toggleSubMenu('gestionSubMenu')">
                    <div class="flex justify-between items-center w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                        </svg>
                        <span class="movableDiv  text-3xl  transition-transform duration-300 ease-in-out text-white">Gestión</span>
                    </div>
                </a>

            <div id="gestionSubMenu" class="pl-2 hidden text-lg  text-white">
                <a href="{{ route('articulo.index') }}" class="hover:text-xl  py-1 px-4 hover:bg-gray-600 flex">
                   <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 0 0 2.25-2.25V6a2.25 2.25 0 0 0-2.25-2.25H6A2.25 2.25 0 0 0 3.75 6v2.25A2.25 2.25 0 0 0 6 10.5Zm0 9.75h2.25A2.25 2.25 0 0 0 10.5 18v-2.25a2.25 2.25 0 0 0-2.25-2.25H6a2.25 2.25 0 0 0-2.25 2.25V18A2.25 2.25 0 0 0 6 20.25Zm9.75-9.75H18a2.25 2.25 0 0 0 2.25-2.25V6A2.25 2.25 0 0 0 18 3.75h-2.25A2.25 2.25 0 0 0 13.5 6v2.25a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                    <span class=" ml-5 movableDiv text-xl rounded-lg transition-transform duration-300 ease-in-out text-white">Articulo</span>

                </a>






                <a href="{{ route('gestion.precio.precioCambiar') }}" class=" hover:text-xl  py-1 px-4 hover:bg-gray-600 flex justify-end">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                      </svg>

                    <span class=" ml-5 movableDiv text-xl rounded-lg transition-transform duration-300 ease-in-out text-white">Cambio de Precio - Artículos</span>

                </a>
                <a href="{{ route('gestion.precio.precioGrupo') }}" class="hover:text-xl  py-1 px-4 hover:bg-gray-600 flex justify-end">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 0 1-1.125-1.125v-3.75ZM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-8.25ZM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-2.25Z" />
                    </svg>
                    <span class=" ml-5 movableDiv text-xl rounded-lg transition-transform duration-300 ease-in-out text-white">Cambio de Precio - Grupo</span>
                </a>
                <a href="{{ route('proveedor.proveedor') }}" class="hover:text-xl  py-1 px-4 hover:bg-gray-600 flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                    </svg>
                    <span class=" ml-5 movableDiv text-xl rounded-lg transition-transform duration-300 ease-in-out text-white">Proveedor</span>

                </a>

            </div>
        </div>

        <div class="hoverDiv w-full text-red-600 ">
            <a href="javascript:void(0)" class=" py-2 px-2 hover:bg-gray-700 flex items-center" onclick="toggleSubMenu('cierreSubMenu')">
                <div class="flex justify-between items-center w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-16 w-16 border-red-600  rounded-xl border-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                      </svg>

                    <span class="movableDiv text-3xl rounded-lg transition-transform duration-300 ease-in-out text-white">Cierre Caja</span>
                </div>
            </a>
            <div id="cierreSubMenu" class="pl-2 hidden text-lg  text-white ">
                <a href="{{ route('informes.masVendidos') }}" class="hover:text-xl block py-1 px-4 hover:bg-gray-600 rounded-lg ">

                    El Más Vendido
                </a>
            </div>
        </div>
    </nav>
</div>

<script>
    document.querySelectorAll('.hoverDiv').forEach(div => {
        const movableDiv = div.querySelector('.movableDiv');
        div.addEventListener('mouseenter', () => {
            movableDiv.classList.add('move-left');
        });
        div.addEventListener('mouseleave', () => {
            movableDiv.classList.remove('move-left');
        });
    });
</script>
<style>
    .move-left {
        transform: translateX(-70px);
    }
</style>
