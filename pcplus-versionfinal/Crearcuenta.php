<?php
// Establecer conexión a la base de datos (asegúrate de haberlo hecho antes)
 require "tienda.php";
 
 $shop = new tienda();
   
//Si se ha accedido a login.php desde un formulario que contiene POST, guardará las variables
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["correo"];
    $clave = $_POST["clave"];
    $clavead= $_POST["ClaveAd"];

    //la clave de admin debe ser "root", si no, no se creará la cuenta
    if($clavead!="root"){
        echo "No se ha podido crear la cuenta";
    }else{
        //método que te devuelve el id de usuario si el usuario existe, si no, devuelve 0
        $result = $shop->Comprobarcreado($correo);
        
        if ($result!=0) {
            
        echo"El usuario ya está creado";
        } else {
            //método que crea el usuario (introduce datos en la base de datos)
            $result = $shop->Crearusuario($correo,$clave);
            echo"el usuario esta creado correctamente";
        }
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear cuenta</title>
    <link rel="stylesheet" href="style.css">
</head>
<body align="center">
<h1>Crear Cuenta</h1>
    <form action="Crearcuenta.php" method="post">
        <label for="correo">Cliente:</label>
        <input type="text" name="correo" placeholder="Nombre del Cliente" required><br>

        <label for="clave">Contraseña:</label>
        <input type="password" name="clave" placeholder="Contraseña" required><br>

        <label for="clave">Clave admin:</label>
        <input type="password" name="ClaveAd" placeholder="Clave administrador" required><br>
        <input type="submit" name="crear" value="Crear usuario" style="width: 200px">
    </form>
    
    <br>

    <form action="login.php">
        <button type="submit" name="crear">Volver a login</button>
    </form>
</body>
</html>