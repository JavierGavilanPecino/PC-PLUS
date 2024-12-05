<?php
require_once "tienda.php";
$shop = new tienda;
$nombreUsuario = $shop->getNombreCliente($_SESSION['id_cliente']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cabecera</title>
    
    <!-- Enlaza el archivo CSS externo -->
    <link rel="stylesheet" href="header.css">
</head>
<body>

    <!-- El código del header -->
    <header>
        <div class="logo">
            <img src="pcplus-icono.png" alt="Logo PCPlus" class="logo-img">
        </div>
        <nav>
            <a href="index.php">Inicio</a>
            <div class="selector">
                <a href="categoria.php" class="menu-item">Categorías</a>
                <a href="carrito.php">Carrito</a>
                <a href="pedidos.php">Mis Pedidos</a>
        </nav>
        <!-- Mediante el css de selector y submenu, mientras el puntero esté encima mostrará el submenu -->
        <div class="selector">
            Bienvenido, <?php echo ($nombreUsuario); ?>
            <div class="submenu">
                <a href="logout.php">Cerrar sesión</a>
            </div>
        </div>
    </header>

</body>
</html>
