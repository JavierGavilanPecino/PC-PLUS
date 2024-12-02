<?php
session_start();

if (!isset($_SESSION['id_cliente'])) {
    // No hay sesión iniciada, redirige a login.php
    header("Location: login.php");
    exit(); // Asegura que el script se detenga después de la redirección
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información del Pedido</title>
    <link rel="stylesheet" href="style.css">
</head>
<body align="center">
    
    <?php
    
        require_once "tienda.php";
        $shop = new tienda;
        echo '<header> <a href="categoria.php">'. $shop->getNombreCliente($_SESSION['id_cliente']).'</a>';
        //Conecta a la base de datos y saca el correo del Cliente, porque el nombre no está en la base de datos.
        echo '<a href="pedidos.php">Pedidos</a>';
        //Pedidos.
        echo '<a href="logout.php">Cerrar sesión</a>';

        echo '<a href="carrito.php">Carrito</a> </header> <h1>Pedidos</h1>';
        //proveniente del formulario en pedidos.php, si se accedió a la página desde la misma,
        //imprimirá los datos del pedido.En caso contrario, se entiende que se accedió de forma "bruta" y pondrá que la
        //información no está disponible
        if(isset($_REQUEST['Codped']))
        {
            $shop->ImprimirDatosPedidos($_REQUEST['Codped']);
        }else
        {
            echo "<p>Información no disponible</p>";    
        }
    ?>
</body>
</html>