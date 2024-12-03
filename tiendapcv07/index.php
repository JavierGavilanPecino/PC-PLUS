<?php
session_start();
if (!isset($_SESSION['id_cliente'])) {
    // No hay sesión iniciada, redirige a login.php
    header("Location: login.php");
    exit(); // Asegura que el script se detenga después de la redirección
}
require_once "tienda.php";
include "header.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio</title>
    <link rel="stylesheet" href="style.css">

</head>
<body align="center">

    <!-- Buscador -->
    <div class="buscadorpc">
        <form action="buscar.php" method="GET">
            <input type="text" name="buscador" placeholder="Buscar productos..." style="width: 200px; padding: 5px;">
            <button type="submit">Buscar</button>
        </form>
    </div>


    <!-- Contenido principal -->
    <h1>Top Productos Más Vendidos</h1>
    <div id="productos">
        <div class="producto" data-nombre="Producto A">
            <h3>Producto A</h3>
            <p>Descripción del Producto A</p>
            <p>Pedidos: 120</p>
        </div>
        <div class="producto" data-nombre="Producto B">
            <h3>Producto B</h3>
            <p>Descripción del Producto B</p>
            <p>Pedidos: 85</p>
        </div>
        <div class="producto" data-nombre="Producto C">
            <h3>Producto C</h3>
            <p>Descripción del Producto C</p>
            <p>Pedidos: 72</p>
        </div>
    </div>

    <?php include "footer.html"; ?>

</body>
</html>

