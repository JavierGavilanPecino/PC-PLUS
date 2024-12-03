<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css?v=1.0""> <!-- ?v=1.0 es para obligar a que se actualice el css!-->
</head>

<body align="center">
    <?php
    session_start();
    if (isset($_SESSION['id_cliente'])) { //Comprobar si $_SESSION['id_cliente'] existe, para que muestre la página o te pegue la patada a login.php
        require_once "tienda.php";
        include "header.php";
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
    } else { //Pero si no existe la sesión...
        header("Location: login.php"); //Pues te manda a login.php
    }
    ?>
    </body>

</html>