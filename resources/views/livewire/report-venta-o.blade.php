<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.invoice-box {
    width: 100%;
    margin: auto;
    padding: 20px;
    border: 1px solid #eee;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
    font-size: 16px;
    line-height: 24px;
    color: #555;
}

header {
    margin-top: 20px;
    text-align: center;
    margin-bottom: 20px;
    background: #007bff;
    color: white;


}


header h1 {
    margin-top: 10px;
}

.company-info {
    margin-top: 15px;
}

.company-name {
    font-size: 30px;
    font-weight: bold;

    margin-bottom: 5px;
}

.company-details  {
    margin: 2px 0;
    display: flex;
    justify-content:space-around;
}

.invoice-info {
    display: flex;           /* Activa Flexbox en el contenedor */
   
    align-items: center;     /* Alinea los divs verticalmente al centro */
    border: 1px solid #000;  /* Opcional: Añade un borde al contenedor principal */
    padding: 20px;   
}



.invoice-table {
    width: 100%;
    border-collapse: collapse;
}

.invoice-table thead {
    background: #007bff;
    color: white;
}

.invoice-table th, .invoice-table td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: left;
}

.invoice-table tfoot td {
    font-weight: bold;
}

.invoice-table tfoot tr td:last-child {
    text-align: right;
}

footer {
    text-align: center;
    margin-top: 20px;
    padding-top: 10px;
    border-top: 1px solid #eee;
}
.inner-div {
    display: inline-block; 
    padding: 10px;           
    margin-right: 2%;  
    font-size: 16px;   
}

    </style>
</head>
    <body>
            <div class="invoice-box">
            
                <header >
                    <h1>Factura X</h1>
                    <div class="company-info">
                        <div class="company-name">{{ $emp->empresa }}</div>
                        <div class="company-details">
                            <div>Direccion: {{ $emp->direccion }}</div>
                            <div>Teléfono: {{ $emp->telefono }}</div>
                            <div>Email: {{ $emp->mail }}</div>

                        </div>
                    </div>
                </header>
                <main>
                    <div class="invoice-info">
                        <div class="inner-div">
                            <p><strong>Factura N°:</strong>{{ $datos->id }}</p>
                            <p><strong>Fecha:</strong>{{$datos->Fecha}}</p>
                        </div>
                        <div class="inner-div">
                            <p><strong>Cliente:</strong> {{ $datos->apellido }},{{ $datos->nombre}} </p>
                            <p><strong>Teléfono:</strong> {{ $datos->telefono }}</p>

                        </div>
                    </div>
                    <table class="invoice-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Descripción</th>
                                <th>Cantidad</th>
                                <th>Precio Unitario</th>
                                <th>Descuento</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $ventaOp as $op )
                            <tr>
                                <td>{{ $op->articulo_id }}</td>
                                <td>{{ $op->articulo}}  {{ $op->presentacion }} {{ $op->unidad }}</td>
                                <td>{{ $op->cantidad }}</td>
                                <td>{{ $op->precioF }}</td>
                                <td>{{ $op->descuento }}</td>
                                <td>{{ ($op->precioF* $op->cantidad)- ($op->precioF*$op->cantidad*$op->descuento/100)  }}</td>

                            </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" style="text-align:right;">Subtotal</td>
                                <td>{{ $datos->venta }}</td>
                            </tr>

                            <tr>
                                <td colspan="5" style="text-align:right;"><strong>Total</strong></td>
                                <td><strong>${{ $datos->venta }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </main>
                <footer>
                    <p>&copy; 2024 Nombre de la Empresa. Todos los derechos reservados.</p>
                </footer>
            </div>
    </body>
</html>
