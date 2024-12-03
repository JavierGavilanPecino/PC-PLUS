<?php
session_start();

if (!isset($_SESSION['id_cliente'])) {
    // No hay sesión iniciada, redirige a login.php
    header("Location: login.php");
    exit(); // Asegura que el script se detenga después de la redirección
}

require_once "tienda.php";
$shop = new tienda;

//si se accedió desde el form de aceptar pedido y el pedido no está vacío, utiliza el método
//ConfirmarPedido el cual le das el array con el carrito y la id del cliente, este lo introducirá
//en la base de datos y $_SESSION['carrito'] = array();
if(isset($_REQUEST["aceptar_pedido"]) && !empty($_SESSION['carrito']))
{
    $_SESSION['carrito'] = $shop->ConfirmarPedido($_SESSION['carrito'],$_SESSION['id_cliente']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body align="center">
    
    <?php
        echo '<header> <a href="categoria.php">'. $shop->getNombreCliente($_SESSION['id_cliente']).'</a>';
        //Conecta a la base de datos y saca el correo del cliente, porque el nombre no está en la base de datos.
        echo '<a href="pedidos.php">Pedidos</a>';
        //Pedidos.
        echo '<a href="logout.php">Cerrar sesión</a>';

        echo '<a href="carrito.php">Carrito</a> </header> <h1>Pedidos</h1>';
        
        //método que imprime todos los pedidos del cliente
        $shop->ImprimirPedidos($_SESSION['id_cliente']);
    ?>
</body>
</html>