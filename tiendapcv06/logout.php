<?php
//borra la cookie de la sesión al acceder a la página
setcookie("PHPSESSID", "", time() - 3600, "/");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerrar Sesión</title>
    <link rel="stylesheet" href="style.css">
</head>
<body align="center">
    <h1>Has cerrado sesión</h1>
    <form action="login.php">
    <button type="submit">Iniciar sesión</button>
</form>
</body>
</html>