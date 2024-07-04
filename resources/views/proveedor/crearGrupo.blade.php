<x-app-layout>
    <div class="pt-20">
        <div class="w-2/3 mx-auto sm:px-6 lg:px-8">
            {{-- --------MENU--------- --}}
            @include('components.menu-proveedor')
            {{-- ----------------- --}}
        </div>
    </div>

     <div class="pt-2">
         <div class="w-2/3 mx-auto sm:px-6 lg:px-8">
             <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
               <livewire:proveedor.crearGrupo/>
             </div>
         </div>
     </div>
 </x-app-layout>
