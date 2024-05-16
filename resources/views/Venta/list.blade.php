<x-app-layout>
     <x-slot name="header" class="flex justify-center">
        <div class="flex">
            <div class="mr-1"><button class=" rounded-md bg-gray-400 hover:bg-gray-200 py-2 px-2">Informe de Ventas</button></div>
            <div class="mr-1"><button class=" rounded-md bg-gray-400 hover:bg-gray-200 py-2 px-2">informe de Operaciones</button></div>
            <div class="mr-1"><button class=" rounded-md bg-gray-400 hover:bg-gray-200 py-2 px-2">informe de Stock</button></div>
            <div class="mr-1"><button class=" rounded-md bg-gray-400 hover:bg-gray-200 py-2 px-2">informe de Articulos</button></div>
         </div>
     </x-slot>

     <div class="py-12">
         <div class="w-90 mx-auto sm:px-6 lg:px-8">
               <livewire:list-venta/>
         </div>
     </div>
 </x-app-layout>
