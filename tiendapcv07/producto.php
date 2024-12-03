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
    
    //comprueba que el usuario accedió a producto.php desde el formulario en categoria.php o le dio al botón de añadir al carrito
    if(isset($_REQUEST['cat']) || isset($_REQUEST["addCarrito"]))
    {
        //si existe,guarda la variable en la session
        if(isset($_REQUEST['cat'])) $_SESSION['cat'] = $_REQUEST['cat']; 
        
        //Método que, al darle la categoría, te devuelve un array con los productos
        $productos = $shop->getProductos($_SESSION['cat']);

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
    <title>Formulario de Pedido</title>
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
    //solo mostrara la tabla si no se accedio de forma "bruta" a la web mediante el enlace
    if(isset($_REQUEST['cat']) || isset($_REQUEST["addCarrito"])){

    echo '<h1>Productos</h1>
    <form action="producto.php" method="post">
        <table>
            <tr>
                <th>Nombre</th>
                <th>Stock</th>
                <th>Precio</th>
                <th>Cantidad</th>
            </tr>';
            
            // Bucle que escribe la tabla y crea los inputs con las variables de $_POST
            for ($i = 0; $i < sizeof($productos); $i++) {
                echo 
                "<tr>
                    <td>" . $productos[$i]["NombreProd"] . "</td>
                    <td>" . $productos[$i]["Stock"] . "</td>
                    <td>" . $productos[$i]["Precio"] . " €</td>
                    <td>";
                
                echo "<input type='hidden' name='producto$i' value='" . $productos[$i]["CodProd"] . "'>
                    <input type='hidden' name='addCarrito' value='1'>";
                
                // Crear el input para la cantidad
                echo "<input type='number' name='cantidad$i' placeholder='Cantidad'><br>";
                echo "</td>
                </tr>";
            }

        
        echo '</table>
        <br>
        <input type="submit" value="Añadir al carrito">
        </form>';

        //Si hubo un error, lo mostrara en pantalla
        if (!empty ($error)){
            
            for($i=0;$i<sizeof($error);$i++)
            {
                echo "Se supero la cantidad de stock de: <b>".$error[$i]."</b><br>";
            }  
        }
    }else{
        echo "<hr><br>No se puede mostrar productos sin seleccionar una categoría.";
    }

    include "footer.html";
    ?>

</body>
</html>