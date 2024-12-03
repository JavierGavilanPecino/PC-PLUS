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
<html>

<head>
    <link rel="stylesheet" href="style.css?v=1.0""> <!-- ?v=1.0 es para obligar a que se actualice el css!-->
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
        echo "<h1>Categorias</h1><table>"; //Abre tabla
        $listaCategorias = $shop->getCategorias();; //Pasas las filas de la base de datos a un array. 
        foreach ($listaCategorias as $categoria) { //Array para pasar las filas al objeto de categoria (NombreCat y CodCat)
            echo "<tr><td>". $categoria["NombreCat"] ."</td> <td> <form action='producto.php' method='POST'>
			<input type='hidden' name='cat' value='".$categoria['CodCat']."'>
			<button type='submit'>Ver productos</button>
		  </form></td></tr>"; //Fila de la tabla.
        }
        echo "</table>";
        include "footer.html";
    ?>
    </body>

</html>