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
    <img src="pcplus-icono.png" width="256" height="256" style="padding-top: 80px;">
    <br>
    <!-- Bienvenida -->
    <h1>Bienvenido, 
        <?php 
        $shop = new tienda;
        $nombreUsuario = $shop->getNombreCliente($_SESSION['id_cliente']);
        echo $nombreUsuario;
        ?>
    </h1>
    <form action="buscar.php" method="GET">
            <input type="text" name="buscador" placeholder="Buscar productos..." style="width: 200px; padding: 5px;">
            <br>
            <button type="submit" text-align: center;">Buscar</button>
    </form>
    <!--<p>A continuación, busca tu producto o usa los botones de la cabecera para continuar</p>-->
    <?php include "footer.html"; ?>

</body>
</html>

