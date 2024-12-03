<?php
//Requerimos de cliente.php y creamos el objeto
 require "tienda.php";
 
 $shop = new tienda();
   
//Si se ha accedido a login.php desde un formulario que contiene POST, guardará las variables
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["correo"];
    $clave = $_POST["clave"];
    //El formulario de iniciar sesión contiene un $_POST oculto de iniciar
    if(isset($_POST['iniciar'])){
        //Método que devolverá la id del cliente si el usuario y contraseña son válidos. si no, devuelve 0
        $result = $shop->comprobar_usuario($correo,$clave);

        if ($result!=0) {
            //Iniciamos la sesión
            session_start();
            
            //Guardamos la id del cliente, necesaria en los siguientes archivos
            $_SESSION['id_cliente'] = $result;
    
            header("Location: index.php"); // Redirigir a la página de inicio o donde desees
        } else {
            // Usuario o contraseña incorrectos
            $mensaje = "Usuario o contraseña incorrectos";
        }
    }
    }

    
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body align="center">
    <h1>Login</h1>
    <form action="login.php" method="post">
        <label for="correo">cliente:</label>
        <input type="text" name="correo" placeholder="Nombre del cliente" required><br>

        <label for="clave">Contraseña:</label>
        <input type="password" name="clave" placeholder="Contraseña" required><br>

        <input type="submit"name="iniciar" value="Iniciar sesión">
        
    </form>
<form action="Crearcuenta.php" >
<button type="submit" name="crear">Crear cuenta</button>
</form>
    <?php
        //Si existe el mensaje de error, lo mostrará por pantalla
        if(isset($mensaje))
        {
            echo $mensaje;
        }
    ?>
</body>
</html>
