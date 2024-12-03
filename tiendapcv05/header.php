<?php
require_once "tienda.php";
$shop = new tienda;
$nombreUsuario = $shop->getNombreCliente($_SESSION['id_cliente']);
?>

<header style="display: flex; justify-content: space-between; align-items: center; padding: 10px 20px; background-color: #333; color: white;">
    <div style="font-size: 1.5em; font-weight: bold;">PcPlus</div>
    <div style="font-size: 1.2em;"><?php echo ($nombreUsuario); ?></div>
    <nav>
        <a href="categoria.php" style="margin: 0 10px; color: white; text-decoration: none;">Categorías</a>
        <a href="carrito.php" style="margin: 0 10px; color: white; text-decoration: none;">Carrito</a>
        <a href="pedidos.php" style="margin: 0 10px; color: white; text-decoration: none;">Mis Pedidos</a>
        <a href="logout.php" style="margin: 0 10px; color: white; text-decoration: none;">Cerrar Sesión</a>
    </nav>
</header>
