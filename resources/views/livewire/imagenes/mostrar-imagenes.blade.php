<div class="container mx-auto px-6 text-center">
    <h2 class="text-3xl font-bold">Nuestras Marcas</h2>
    <div class="relative mt-12">
        <div class="carousel-container overflow-hidden"> <!-- Contenedor del carrusel -->
            <div class="carousel-inner flex transition-transform duration-300">
                @foreach ($imagenes as $imagen)
                    <div class="carousel-item   p-2 rounded-lg shadow-md mx-1">
                        <img src="{{ asset('images/marcas/' . basename($imagen)) }}" alt="Imagen" class="w-full h-auto">
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Botones de navegación -->
        <button id="prevBtn" class="absolute left-0 top-1/2 transform -translate-y-1/2 text-indigo-600 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-10 h-10 transition-transform duration-200 hover:scale-125">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
            </svg>
        </button>
        <button id="nextBtn" class="absolute right-0 top-1/2 transform -translate-y-1/2 text-indigo-600 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-10 h-10 transition-transform duration-200 hover:scale-125">
                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
            </svg>
        </button>
        
    </div>        
    <script>
        const carousel = document.querySelector('.carousel-inner');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        
        let currentIndex = 0;
        const itemWidth = carousel.querySelector('.carousel-item').clientWidth;
    
        // Función para actualizar la posición del carrusel
        const updateCarousel = () => {
            carousel.style.transform = `translateX(-${currentIndex * itemWidth}px)`;
        };
    
        // Evento de clic en el botón "Siguiente"
        nextBtn.addEventListener('click', () => {
            if (currentIndex < carousel.children.length - 1) {
                currentIndex++;
                updateCarousel();
            }
        });
    
        // Evento de clic en el botón "Anterior"
        prevBtn.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                updateCarousel();
            }
        });
    
        // Ajustar el ancho de los ítems en caso de redimensionar la ventana
        window.addEventListener('resize', () => {
            itemWidth = carousel.querySelector('.carousel-item').clientWidth;
            updateCarousel();
        });
    </script>
</div>