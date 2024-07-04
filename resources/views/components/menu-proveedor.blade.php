<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg px-5">
    {{-- <x-nav-link class="ml-4 h-8 px-2 bg-sky-400 hover:bg-sky-200 text-white hover:text-gray-400 rounded-lg"
        href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
        Dashboard
    </x-nav-link> --}}
    {{-- --------MENU--------- --}}
    <x-nav-link class="px-2 mb-2 h-8  bg-sky-400 hover:bg-sky-200 text-white hover:text-gray-400 rounded-lg"
    href="{{ route('proveedor.proveedor') }}" :active="request()->routeIs('proveedor.proveedor')">
        Proveedor
     </x-nav-link>
    <x-nav-link class="mt-2 mb-2 h-8 px-2 bg-sky-400 hover:bg-sky-200 text-white hover:text-gray-400 rounded-lg"
        href="{{ route('proveedor.crearGrupo') }}" :active="request()->routeIs('proveedor.crearGrupo')">
        Crear Grupo
     </x-nav-link>
    <x-nav-link class="mt-2 mb-2 h-8 px-2 bg-sky-400 hover:bg-sky-200 text-white hover:text-gray-400 rounded-lg"
        href="{{ route('proveedor.articuloGrupo') }}" :active="request()->routeIs('proveedor.articuloGrupo')">
       Grupos de Articulos
    </x-nav-link>
{{--
   <x-nav-link class="mt-2 mb-2 h-8 px-2 bg-sky-400 hover:bg-sky-200 text-white hover:text-gray-400 rounded-lg"
        href="{{ route('operacion.list') }}" :active="request()->routeIs('operacion.list')">
       Operacion
     </x-nav-link>

    <x-nav-link class="mt-2 mb-2 h-8 px-2 bg-sky-400 hover:bg-sky-200 text-white hover:text-gray-400 rounded-lg"
        href="{{ route('venta.list') }}" :active="request()->routeIs('venta.list')">
        Venta

      </x-nav-link>

     <x-nav-link class="mt-2 mb-2 h-8 px-2 bg-sky-400 hover:bg-sky-200 text-white hover:text-gray-400 rounded-lg"
        href="{{ route('stock.index') }}" :active="request()->routeIs('stock.index')">
        Stock

      </x-nav-link>  --}}
</div>
