<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
</head>

<body align="center">
    <?php
    session_start();
    if (isset($_SESSION['id_cliente'])) { //Comprobar si $_SESSION['id_cliente'] existe, para que muestre la página o te pegue la patada a login.php
        require_once "tienda.php";
        $shop = new tienda;
        echo '<header> <a href="categoria.php">'. $shop->getNombreCliente($_SESSION['id_cliente']).'</a>';
        //Conecta a la base de datos y saca el correo del cliente, porque el nombre no está en la base de datos.
        echo '<a href="pedidos.php">Pedidos</a>';
        //Pedidos.
        echo '<a href="logout.php">Cerrar sesión</a>';
        //Cerrar sesión.
        echo '<a href="carrito.php">Carrito</a></header>';
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