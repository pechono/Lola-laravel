<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>Bicicleteria Balsamo</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  
     <style>
        .carousel-container {
            overflow: hidden; /* Oculta el contenido desbordado */
            position: relative; /* Para posicionar los botones correctamente */
        }
        .carousel-inner {
            display: flex;
            gap:0.1rem; /* Espacio entre las tarjetas */
            transition: transform 0.3s ease-in-out;
            will-change: transform; /* Mejora de rendimiento */
        }
        .carousel-item {
            flex: 0 0 calc(100% / 5 - 0.5rem); /* Mostrar 3 tarjetas */
        }
       
       

    </style>
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Header -->
   <header class="bg-white shadow-md">
    <div class="container mx-auto flex justify-between items-center py-4 px-6">
       <div class="flex flex-col transition-colors group">

            <div class="text-4xl font-bold text-indigo-800 group-hover:text-red-600 transition-colors duration-300">Bicicleteria</div>
            <div class="text-lg font-bold text-red-600 group-hover:text-indigo-800 transition-colors duration-300 text-right">Balsamo</div>

        </div>
        
        <nav class="hidden md:flex space-x-4">
            <a href="#" class="text-gray-700 hover:text-indigo-600 transition duration-700">Inicio</a>
            <a href="#features" class="text-gray-700 hover:text-indigo-600 transition duration-700" >Características</a>
            <a href="#testimonials" class="text-gray-700 hover:text-indigo-600 transition duration-700">Testimonios</a>
            <a href="#contact" class="text-gray-700 hover:text-indigo-600 transition duration-700">Contacto</a>
        </nav>
        <div class="hidden md:flex space-x-4">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="rounded-md px-3 py-2 text-black bg-gray-200 hover:bg-gray-300 transition duration-300">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="rounded-md px-3 py-2 text-black bg-gray-200 hover:bg-gray-300 transition duration-300">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="rounded-md px-3 py-2 text-black bg-gray-200 hover:bg-gray-300 transition duration-300">Register</a>
                    @endif
                @endauth
            @endif
        </div>
        <!-- Botón de menú para pantallas pequeñas -->
        <div class="md:hidden">
            <button id="menu-button" class="text-gray-700 hover:text-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
    </div>
    <!-- Menú desplegable para pantallas pequeñas -->
    <div id="mobile-menu" class="hidden md:hidden">
        <nav class="flex flex-col space-y-2 py-2 px-6 bg-white border-t border-gray-200">
            <a href="#" class="text-gray-700 hover:text-indigo-600 transition duration-300">Inicio</a>
            <a href="#features" class="text-gray-700 hover:text-indigo-600 transition duration-700">Características</a>
            <a href="#testimonials" class="text-gray-700 hover:text-indigo-600 transition duration-300">Testimonios</a>
            <a href="#contact" class="text-gray-700 hover:text-indigo-600 transition duration-300">Contacto</a>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="rounded-md px-3 py-2 text-black bg-gray-200 hover:bg-gray-300 transition duration-300">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="rounded-md px-3 py-2 text-black bg-gray-200 hover:bg-gray-300 transition duration-300">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="rounded-md px-3 py-2 text-black bg-gray-200 hover:bg-gray-300 transition duration-300">Register</a>
                    @endif
                @endauth
            @endif
        </nav>
    </div>
</header>

<script>
    // Script para el botón de menú
    const menuButton = document.getElementById('menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    menuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
</script>

    <!-- Hero Section -->
    <section class="bg-indigo-600 text-white py-20 text-center">
        <h1 class="text-4xl md:text-5xl font-bold">Soluciones para tu negocio</h1>
        <p class="mt-4 text-lg md:text-xl">Transforma tu negocio con nuestra herramienta única.</p>
        <a href="#contact" class="mt-6 inline-block bg-white text-indigo-600 font-bold py-3 px-6 rounded-full hover:bg-gray-200">Contáctanos</a>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-16 bg-gray-100">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold">Características</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold">Facilidad de uso</h3>
                    <p class="mt-4 text-gray-600">Nuestra interfaz está diseñada para ser intuitiva y fácil de usar.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold">Soporte 24/7</h3>
                    <p class="mt-4 text-gray-600">Estamos disponibles para ayudarte en cualquier momento.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold">Seguridad de datos</h3>
                    <p class="mt-4 text-gray-600">Tus datos están protegidos con las mejores tecnologías.</p>
                </div>
            </div>
        </div>
    </section>
    
    <section id="features" class="py-16 bg-gray-100">
        @livewire('imagenes.mostrar-imagenes')
    </section>
  
    <!-- Testimonials Section -->
    <section id="testimonials" class="py-16 bg-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold">Lo que dicen nuestros clientes</h2>
            <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="p-6 rounded-lg shadow-lg bg-gray-100">
                    <p class="text-gray-700">"¡Increíble! Mi negocio ha crecido gracias a esta herramienta."</p>
                    <span class="block mt-4 font-bold text-indigo-600">Juan Pérez</span>
                </div>
                <div class="p-6 rounded-lg shadow-lg bg-gray-100">
                    <p class="text-gray-700">"El soporte al cliente es insuperable, siempre están dispuestos a ayudar."</p>
                    <span class="block mt-4 font-bold text-indigo-600">Ana Martínez</span>
                </div>
                <div class="p-6 rounded-lg shadow-lg bg-gray-100">
                    <p class="text-gray-700">"Mis datos están más seguros que nunca, 100% recomendable."</p>
                    <span class="block mt-4 font-bold text-indigo-600">Luis Rodríguez</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-16 bg-indigo-600 text-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold">Suscríbete</h2>
            <p class="mt-4">Déjanos tu correo para recibir las últimas novedades.</p>
            <form class="mt-8 flex justify-center">
                <input type="email" placeholder="Tu correo electrónico" class="w-full max-w-md py-3 px-4 rounded-l-lg text-gray-700">
                <button type="submit" class="bg-white text-indigo-600 font-bold py-3 px-6 rounded-r-lg hover:bg-gray-200">Enviar</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-6">
        <div class="container mx-auto px-6 text-center">
            <p>&copy; 2024 MiEmpresa. Todos los derechos reservados.</p>
            <nav class="mt-4">
                <a href="#" class="text-gray-400 hover:text-white mx-2">Privacidad</a>
                <a href="#" class="text-gray-400 hover:text-white mx-2">Términos</a>
                <a href="#" class="text-gray-400 hover:text-white mx-2">Contacto</a>
            </nav>
        </div>
    </footer>

</body>
</html>

