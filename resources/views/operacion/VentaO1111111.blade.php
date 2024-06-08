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
    width: 80%;
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
    display: flex;

    margin-bottom: 20px;
}

.invoice-info div {
    width: 48%;
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

    </style>
</head>
<body>
    
     <livewire:report-venta-o/>
 
</html>
