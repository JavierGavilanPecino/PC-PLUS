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
    <title>Buscar productos</title>
    <!-- Enlace al archivo CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body align="center">

<div class="buscadorpc">
        <form action="buscar.php" method="GET">
            <input type="text" name="buscador" placeholder="Buscar productos..." style="width: 200px; padding: 5px;">
            <button type="submit">Buscar</button>
        </form>
    </div>

<?php

    $shop = new tienda;

    // Verifica si se ha enviado el término de búsqueda
    if (isset($_GET['buscador'])) {
        $terminoBusqueda = $_GET['buscador'];
        // Llamada al método de búsqueda
        $productos = $shop->buscarProductoPorNombre($terminoBusqueda);

        if (count($productos) > 0) {
            echo "<h2>Resultados para: '$terminoBusqueda'</h2>";
            echo '<form action="producto.php" method="post">
                <table>
                    <tr>
                        <th>Nombre</th>
                        <th>Stock</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                    </tr>';

            // Bucle que escribe la tabla y crea los inputs con los productos encontrados con las variables de $_POST
            foreach ($productos as $i => $producto) {
                echo "<tr>
                        <td>" . $producto["NombreProd"] . "</td>
                        <td>" . $producto["Stock"] . "</td>
                        <td>" . $producto["Precio"] . " €</td>
                        <td>
                            <input type='hidden' name='producto$i' value='" . $producto["CodProd"] . "'>
                            <input type='hidden' name='addCarrito' value='1'>
                            <input type='number' name='cantidad$i' placeholder='Cantidad' min='1' max='" . $producto["Stock"] . "' style='width: 200px;'>
                        </td>
                    </tr>";
            }

            echo '</table>';
            echo '<br><input type="submit" value="Añadir al carrito">';
            echo '</form>';
        } else {
            echo "<p>No se encontraron productos con el nombre '$terminoBusqueda'.</p>";
        }
    } else {
        echo "<p>Por favor, vuelva a buscar el producto.</p>";
    }

    include "footer.html";
?>

</body>

</html>
