<x-app-layout>
    <x-slot name="header" class="flex justify-center pt-20">
       Imprimir Comprobante
    </x-slot>



    <div class="h-50% flex items-center justify-center mt-10">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg h-auto w-96 flex flex-col items-center justify-center border p-10">
            <a href="{{ route('comprobante',['operacion'=>$operacion]) }}" target="_blank" class="mb-4 px-4 py-2 bg-blue-500 text-white rounded">Imprimir Comprobante</a>

            <a href="{{ route($volver) }}"  class="px-4 py-2 bg-green-500 text-white rounded">Realizar Otra Operacion</a>
        </div>
    </div>

</x-app-layout>
