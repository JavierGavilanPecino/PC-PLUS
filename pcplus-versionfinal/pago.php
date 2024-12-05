<?php
session_start();

if (!isset($_SESSION['id_cliente'])) {
    header("Location: login.php");
    exit();
}

require_once "tienda.php";
$shop = new tienda;

// Comprueba si se recibió el formulario de pago
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['procesar_pago'])) {
    $total = $_POST['total'];
    $numero_tarjeta = $_POST['numero_tarjeta'];
    $cvv = $_POST['cvv'];
    $fecha_expiracion = $_POST['fecha_expiracion'];

    // Validación básica
    if (empty($numero_tarjeta) || empty($cvv) || empty($fecha_expiracion)) {
        $error = "Todos los campos son obligatorios.";
    } else {
        // Aquí simulas la validación del pago.
        //Comprueba si la longitud del número de la tarjeta y del cvv es correcta
        if (strlen($numero_tarjeta) === 16 && strlen($cvv) === 3) { 
            // Confirmar el pedido
            $_SESSION['carrito'] = $shop->ConfirmarPedido($_SESSION['carrito'], $_SESSION['id_cliente']);
            header("Location: procesando_pago.html");
            exit();
        } else {
            $error = "Los detalles de la tarjeta son inválidos.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago</title>
    <link rel="stylesheet" href="pago.css">
</head>
<body>
    <div class="container">
    <h1>Pago por Tarjeta</h1>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<!-- Formulario de pago -->
    <form method="post" action="" onsubmit="return validarFechaCaducidad()">
        <label for="total">Total a pagar:</label>
        <!--Tomamos el valor de total_pagar de carrito para mostrar la cuantía total del producto-->
        <input type="text" id="total" name="total" value="<?php echo $_POST['total_pagar']; ?> €" readonly><br><br>

        <label for="numero_tarjeta">Número de tarjeta:</label>
        <input type="text" id="numero_tarjeta" name="numero_tarjeta" maxlength="16" pattern="[0-9]*" required><br><br>

        <label for="cvv">CVV:</label>
        <input type="text" id="cvv" name="cvv" maxlength="3" pattern="[0-9]*" required><br><br>

        <label for="fecha_expiracion">Fecha de expiración:</label>
        <input type="month" id="fecha_expiracion" name="fecha_expiracion" required><br><br>

        <button type="submit" name="procesar_pago">Pagar</button>
    </form>

    <script>
        //Llamamos a la funcion validarFechaCaducidad para que compruebe si la fecha introducida para la tarjeta es válida
        function validarFechaCaducidad() {
            var fechaExpiracion = document.getElementById('fecha_expiracion').value;

            if (!fechaExpiracion) {
                alert("Debe ingresar una fecha de caducidad.");
                return false;
            }

            var [year, month] = fechaExpiracion.split('-').map(Number);
            var fechaActual = new Date();
            var añoActual = fechaActual.getFullYear();
            var mesActual = fechaActual.getMonth() + 1; // El primer mes cuenta como 0, por lo que le sumamos 1 para obtener el mes correcto

            // Validar año y mes
            if (year < añoActual || (year === añoActual && month <= mesActual)) {
                alert("Tarjeta no válida. Compruebe la fecha de caducidad.");
                return false;
            }

            // Fecha válida
            return true;
        }
    </script>

    <a href="carrito.php">Volver al carrito</a>
    </div>
</body>
</html>
