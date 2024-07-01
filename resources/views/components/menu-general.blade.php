<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
        {{ __('Dashboard') }}
    </x-nav-link>


      <div class="relative mt-3" x-data="{ isOpen: @entangle('isOpen') }">
        <button @click="isOpen = !isOpen" class="px-4 py-2 bg-blue-500 text-white rounded">
            Venta
        </button>

      <div x-show="isOpen" class="absolute mt-2 w-48 bg-white rounded-md shadow-lg z-20">
            <ul>
                <li class="px-4 py-2 hover:bg-gray-200"> <x-nav-link href="{{ route('venta.index') }}" :active="request()->routeIs('venta.index')">
                    Venta
                  </x-nav-link></li>
                <li class="px-4 py-2 hover:bg-gray-200"> <x-nav-link href="{{ route('venta.ventaExpress') }}" :active="request()->routeIs('venta.ventaExpress')">
                    Venta Express
                  </x-nav-link></li>
                <li class="px-4 py-2 hover:bg-gray-200"><x-nav-link href="{{ route('venta.list') }}" :active="request()->routeIs('venta.list')">
                    Ventas

                  </x-nav-link></li>
                <li class="px-4 py-2 hover:bg-gray-200"><x-nav-link href="{{ route('venta.cuentaCorriente') }}" :active="request()->routeIs('venta.cuentaCorriente')">
                    Cuenta Corriente

                  </x-nav-link></li>
                  <li class="px-4 py-2 hover:bg-gray-200"><x-nav-link href="{{ route('venta.ListCuentaCorriente') }}" :active="request()->routeIs('venta.ListCuentaCorriente')">
                    Pago En Cuenta Corriente

                  </x-nav-link></li>
                  <li>-</li>
                  <li class="px-4 py-2 hover:bg-gray-200"><x-nav-link href="{{ route('cierre.cierreCaja') }}" :active="request()->routeIs('cierre.cierreCaja')">
                    Cierre Caja

                  </x-nav-link></li>

            </ul>
        </div>
    </div>
   <div class="relative mt-3" x-data="{ isOpen: @entangle('isOpen') }">
        <button @click="isOpen = !isOpen" class="px-4 py-2 bg-blue-500 text-white rounded">
            Stock
        </button>

         <div x-show="isOpen" class="absolute mt-2 w-48 bg-white rounded-md shadow-lg z-20">
            <ul>
                <li class="px-4 py-2 hover:bg-gray-200"> <x-nav-link href="{{ route('stock.index') }}" :active="request()->routeIs('stock.index')">
                    Stock
                  </x-nav-link></li>
                <li class="px-4 py-2 hover:bg-gray-200"><x-nav-link href="{{ route('articulo.index') }}" :active="request()->routeIs('articulo.index')">
                    Articulos
                  </x-nav-link></li>
                <li class="px-4 py-2 hover:bg-gray-200"><x-nav-link href="{{ route('stock.pedido') }}" :active="request()->routeIs('stock.pedido')">
                    Pedido A Proveedor
                </x-nav-link></li>
                <li class="px-4 py-2 hover:bg-gray-200"><x-nav-link href="{{ route('stock.pedidoRealizado') }}" :active="request()->routeIs('stock.pedidoRealizado')">
                   Pedidos Realizados
                </x-nav-link></li>
                <li class="px-4 py-2 hover:bg-gray-200"><x-nav-link target='_blank' href="{{ route('stockImprimir') }}" :active="request()->routeIs('stockImprimir')" @click="isOpen = false">
                    Imprimir Stock Actual
                 </x-nav-link></li>
            </ul>
        </div>
    </div>
    <div class="relative mt-3" x-data="{ isOpen: @entangle('isOpen') }">
        <button @click="isOpen = !isOpen" class="px-4 py-2 bg-blue-500 text-white rounded">
            Operaciones
        </button>

        <div x-show="isOpen" class="absolute mt-2 w-48 bg-white rounded-md shadow-lg z-20">
            <ul>
                <li class="px-4 py-2 hover:bg-gray-200"><x-nav-link href="{{ route('operacion.list') }}" :active="request()->routeIs('operacion.list')">
                    Operacion
                  </x-nav-link></li>

            </ul>
        </div>
    </div>



</div>
