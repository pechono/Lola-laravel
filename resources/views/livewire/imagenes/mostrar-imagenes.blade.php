<div>
    <style>
        .image-gallery {
            display: flex;
            width: 90%;
            height: 430px;
        }
    
        .image-gallery img {
            width: 0;
            flex-grow: 1;
            object-fit: cover;
            opacity: 0.8;
            transition: 0.5s ease;
        }
    
        .image-gallery img:hover {
            /* cursor: crosshair; */
            width: 300px;
            opacity: 1;
            filter: contrast(1.2);
        }
    </style>
    
    <div class="image-gallery mx-auto">
        @foreach ($imagenes as $imagen)
            <img src="{{ asset('storage/images/marcas/' . basename($imagen)) }}" alt="Imagen">
        @endforeach
    </div>
        
</div>