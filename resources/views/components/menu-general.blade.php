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
       operacion
     </x-nav-link>
    {{-- ----------------- --}}
</div>
