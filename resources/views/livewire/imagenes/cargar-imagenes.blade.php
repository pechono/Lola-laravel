<div>
    <div class="relative mt-12">
        <div class="carousel-container overflow-hidden">
            <!-- Contenedor de la cuadrícula, con hasta 6 columnas y espacio entre elementos -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                @foreach ($imagenes as $imagen)
                    <div class="p-2 rounded-lg shadow-md flex flex-col items-center">
                        <img src="{{ asset('storage/images/marcas/' . basename($imagen)) }}" alt="Imagen" class="w-full h-auto">
                        <h2 class="p-2 border mt-2 text-center">
                            {{ $this->detallesResc($imagen) }}
                        </h2>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    


    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="save">
        <input type="file" wire:model="imagen">
        @error('imagen') <span class="text-red-500">{{ $message }}</span> @enderror

        <input type="text" wire:model="detalle" placeholder="Descripción de la imagen" class="mt-2">
        @error('detalle') <span class="text-red-500">{{ $message }}</span> @enderror

        <!-- Botón de envío con indicador de carga -->
        <div class="mt-4">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded" 
                wire:loading.attr="disabled" wire:target="imagen, save">
                Cargar Imagen
            </button>
            <span wire:loading wire:target="imagen, save" class="text-blue-500 ml-2">Cargando...</span>
        </div>
    </form>
</div>
