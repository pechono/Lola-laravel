<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
        {{ __('Dashboard') }} putie
    </x-nav-link>
    {{-- --------MENU--------- --}}
    <x-nav-link href="{{ route('venta.index') }}" :active="request()->routeIs('venta.index')">
        Venta
     </x-nav-link>
    <x-nav-link href="{{ route('articulo.index') }}" :active="request()->routeIs('articulo.index')">
        Articulo
     </x-nav-link>
    <x-nav-link href="{{ route('cliente.index') }}" :active="request()->routeIs('cliente.index')">
       cliente
    </x-nav-link>

    <x-nav-link href="{{ route('operacion.list') }}" :active="request()->routeIs('operacion.list')">
       Operacion
     </x-nav-link>
    {{-- ----------------- --}}
    <x-nav-link href="{{ route('venta.list') }}" :active="request()->routeIs('venta.list')">
        Ventas

      </x-nav-link>
     {{-- ----------------- --}}
     <x-nav-link href="{{ route('stock.index') }}" :active="request()->routeIs('stock.index')">
        Stock
      </x-nav-link>
      <div class="relative" x-data="{ isOpen: @entangle('isOpen') }">
        <button @click="isOpen = !isOpen" class="px-4 py-2 bg-blue-500 text-white rounded">
            Toggle Menu
        </button>

        <div x-show="isOpen" class="absolute mt-2 w-48 bg-white rounded-md shadow-lg z-20">
            <ul>
                <li class="px-4 py-2 hover:bg-gray-200"> <x-nav-link href="{{ route('stock.index') }}" :active="request()->routeIs('stock.index')">
                    Stock
                  </x-nav-link></li>
                <li class="px-4 py-2 hover:bg-gray-200"><x-nav-link href="{{ route('venta.list') }}" :active="request()->routeIs('venta.list')">
                    Ventas

                  </x-nav-link></li>
                <li class="px-4 py-2 hover:bg-gray-200"><a href="#">Option 3</a></li>
            </ul>
        </div>
    </div>
    <div class="relative" x-data="{ isOpen: @entangle('isOpen') }">
        <button @click="isOpen = !isOpen" class="px-4 py-2 bg-blue-600 text-white rounded-md shadow-md focus:outline-none focus:ring-2 focus:ring-blue-300">
            Menu
            <svg class="w-5 h-5 inline-block ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
        </button>

        <div x-show="isOpen" @click.away="isOpen = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-20" x-cloak>
            <ul>
                <li class="block px-4 py-2 text-gray-800 hover:bg-gray-200 cursor-pointer"><a href="#">Option 1</a></li>
                <li class="block px-4 py-2 text-gray-800 hover:bg-gray-200 cursor-pointer"><a href="#">Option 2</a></li>
                <li class="block px-4 py-2 text-gray-800 hover:bg-gray-200 cursor-pointer"><a href="#">Option 3</a></li>
            </ul>
        </div>
    </div>
    <!-- Include Alpine.js for interactivity -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs" defer></script>
</div>
