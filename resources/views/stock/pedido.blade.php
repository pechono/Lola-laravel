<x-app-layout>
    <div class="mt-8">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            {{-- --------MENU--------- --}}
            @include('components.menu-stock')
            {{-- ----------------- --}}
        </div>
    </div>

     <div class="mt-2">
         <div class="w-full mx-auto sm:px-6 lg:px-8">
             <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg ">
               <livewire:pedidolivewire/>
             </div>
         </div>
     </div>
 </x-app-layout>
