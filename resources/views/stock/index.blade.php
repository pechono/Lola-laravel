
 <x-app-layout>
    <div class="pt-20">
        <div class=" w-11/12 mx-auto sm:px-6 lg:px-8">
            {{-- --------MENU--------- --}}
            @include('components.menu-stock')
            {{-- ----------------- --}}
        </div>
    </div>

    <div class="mt-2">
        <div class=" w-11/12 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
              <livewire:stock.stock-livewire/>
            </div>
        </div>
    </div>
</x-app-layout>
