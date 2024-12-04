<?php
session_start();
if (!isset($_SESSION['id_cliente'])) {
    // No hay sesión iniciada, redirige a login.php
    header("Location: login.php");
    exit(); // Asegura que el script se detenga después de la redirección
}
require_once "tienda.php";
include "header.php";
$shop = new tienda;
    
if (isset($_GET['buscador'])) {
    $terminoBusqueda = $_GET['buscador'];
    // Llamada al método de búsqueda
    $_SESSION['terminoBusqueda'] = $terminoBusqueda;
    $productos = $shop->buscarProductoPorNombre($terminoBusqueda);
}


//comprueba que el usuario accedió a buscar.php desde el formulario en categoria.php o le dio al botón de añadir al carrito
if(isset($_REQUEST["addCarrito"]))
{    
    //Método que, al darle la categoría, te devuelve un array con los productos
    $productos = $shop->buscarProductoPorNombre($_SESSION['terminoBusqueda']);

    //cesta vacía la cual contendrá los productos que el usuario habrá introducido desde el formulario
    $cesta = array();
    
    //bucle que recorre cada uno de los productos, por cada producto hay un $_POST de cantidad y la id del producto,
    //si la cantidad no está vacía, se guarda en un array donde [0] es la id del producto y [1] la cantidad del mismo
    for ($i = 0; $i<sizeof($productos); $i++){
        if (!empty ($_REQUEST["cantidad$i"])){
            $p = array($_REQUEST["producto$i"], $_REQUEST["cantidad$i"]);
            //guardamos el array en cesta dejando un array bidimensional
            array_push($cesta, $p);
        }
    }
    
    //si no está vacía la cesta, se deduce que el usuario introdujo datos
    if (!empty($cesta)){
        
        //Método que valida cada uno de los productos para que no sea negativo
        //y tampoco supere el stock actual. Devuelve un string con los errores resultantes
        $error = $shop->comprobarStock($cesta);

        //Si no hubo ningún error,se guarda en la variable de sesión cesta y te manda a carrito.php
        if(empty($error))
        {
            $_SESSION['cesta'] = $cesta;
            header("Location: carrito.php");
        }
    }
}
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
            <br>
            <button type="submit" style="width: 200px; text-align: center;">Buscar</button>
        </form>
    </div>

<?php
    // Verifica si se ha enviado el término de búsqueda
    if (isset($_GET['buscador'])) {
        $terminoBusqueda = $_GET['buscador'];
        // Llamada al método de búsqueda
        $productos = $shop->buscarProductoPorNombre($terminoBusqueda);

        if (count($productos) > 0) {
            echo "<h2>Resultados para: '$terminoBusqueda'</h2>";
            echo '<form action="buscar.php" method="post">
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
                            <input type='hidden' name='categoria$i' value='" . $producto["CodCat"] . "'>
                            <input type='hidden' name='addCarrito' value='1'>
                            <input type='number' name='cantidad$i' placeholder='Cantidad' min='1' max='" . $producto["Stock"] . "' style='width: 200px;'>
                        </td>
                    </tr>";
            }

            echo '</table>';
            echo '<input type="submit" value="Añadir al carrito" style="width: 200px">';
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
