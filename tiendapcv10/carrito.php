<?php
session_start();
if (!isset($_SESSION['id_cliente'])) {
    // No hay sesión iniciada, redirige a login.php
    header("Location: login.php");
    exit(); // Asegura que el script se detenga después de la redirección
}
require_once "tienda.php";
include "header.php";

//si no existe (se accedió por primera vez), se crea la variable
if(!isset($_SESSION["carrito"]))
{
    $_SESSION["carrito"] = array();
}

$shop = new tienda;


//si la variable no está vacía (se accedió mediante la agregación de productos al carrito), los introducirá
if(!empty($_SESSION["cesta"]))
{
    //método que, al pasarle un array de la cesta y el array del carrito, suma los productos de cesta al carrito
    $_SESSION["carrito"] = $shop->addCarrito($_SESSION["cesta"],$_SESSION["carrito"]);
    //vaciamos la cesta porque ya fue introducida en el carrito
    $_SESSION["cesta"] = array();
}

//si le dieron al botón cancelar, borrará el carrito al completo. Se hace con una función en vez de
//igualar la variable $_SESSION['carrito']=array() porque la agregación de productos al carrito provoca
//una modificación en el stock existente en la base de datos
if(isset($_REQUEST['cancelar']))
{
    $_SESSION['carrito']=$shop->borrarCarrito($_SESSION['carrito']);
}

//si se le dio al botón de eliminar un producto, que se shopaure el stock y desaparece de $_SESSION['carrito']
if(isset($_REQUEST['DelProducto']))
{
    $_SESSION['carrito']=$shop->delProductoCarrito($_SESSION['carrito'],$_REQUEST['DelProducto']);
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Carrito</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body align="center">
    <h1>Carrito</h1>
    <?php
    //Método que imprime la tabla con todos los productos del carrito

    $shop->ImprimirCarrito($_SESSION["carrito"]);
    ?>
    <script>
        function confirmarCancelacion() {
            return confirm("¿Estás seguro de que deseas borrar tu carrito?");
        }
    </script>
        <form method="post" action="carrito.php" onsubmit="return confirmarCancelacion()">
            <input type="hidden" name="cancelar" value="1">
            <button type="submit" style="width: 200px; background-color: grey; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='#555';" onmouseout="this.style.backgroundColor='grey';">Vaciar carrito</button>
            </form>

        <?php $total = $shop->calcularTotal($_SESSION['carrito']);?>

        <?php 
            if ($total == 0) { // Usa '==' para comparación, y asegúrate de cerrar el 'if' correctamente
                echo "<br>";
                echo "No hay productos en el carrito";
            } else { 
            ?>
                <form method="post" action="pago.php">
                    <input type="hidden" name="total_pagar" value="<?php echo $total; ?>"> <!-- Asegura seguridad -->
                    <br>
                    <button type="submit" style="width: 200px;">Hacer pedido</button>
                </form>
            <?php 
            } 
            include "footer.html";
        ?>
    </body>
</html>
