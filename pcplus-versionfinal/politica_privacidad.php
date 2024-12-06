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
    <title>Política de privacidad</title>
    <link rel="stylesheet" href="politicas.css">
</head>
<body>
<div class="content-container">
        <h1>Política de Privacidad</h1>
        <p>
            En <strong>PcPlus SL</strong>, valoramos y respetamos tu privacidad. A continuación, te explicamos cómo recopilamos, usamos y protegemos tus datos personales.
        </p>

        <h2>1. Información Recopilada</h2>
        <p>
            Podremos recopilar diferentes tipos de datos personales, entre ellos:
        </p>
        <ul>
            <li>Datos de identificación: nombre, correo electrónico, dirección postal, y número de teléfono.</li>
            <li>Datos de navegación: dirección IP, tipo de navegador, y datos recopilados mediante cookies.</li>
        </ul>

        <h2>2. Finalidad del Tratamiento</h2>
        <p>Utilizamos tus datos personales para los siguientes fines:</p>
        <ul>
            <li>Procesar y gestionar tus pedidos.</li>
            <li>Proporcionar asistencia al cliente.</li>
            <li>Mejorar la funcionalidad y experiencia de nuestro sitio web.</li>
            <li>Enviar información comercial (previo consentimiento).</li>
        </ul>

        <h2>3. Protección de Datos</h2>
        <p>
            Nos comprometemos a implementar medidas técnicas y organizativas para proteger tus datos personales frente a accesos no autorizados, pérdidas, o alteraciones.
        </p>

        <h2>4. Cesión de Datos a Terceros</h2>
        <p>
            No compartimos tus datos con terceros, excepto en los siguientes casos:
        </p>
        <ul>
            <li>Cuando sea requerido por ley.</li>
            <li>Para cumplir con solicitudes de autoridades competentes.</li>
        </ul>

        <h2>5. Derechos de los Usuarios</h2>
        <p>
            Como usuario, tienes derecho a:
        </p>
        <ul>
            <li>Acceder a tus datos personales.</li>
            <li>Rectificar datos incorrectos o incompletos.</li>
            <li>Solicitar la eliminación de tus datos personales.</li>
            <li>Oponerte al tratamiento de tus datos.</li>
        </ul>
        <p>
            Para ejercer estos derechos, puedes contactarnos a través de:
        </p>
        <p><strong>Correo Electrónico:</strong> privacidad@pcplus.com</p>
        <p><strong>Teléfono:</strong> (+34) 666 777 888</p>

        <h2>6. Cambios en la Política</h2>
        <p>
            PcPlus SL se reserva el derecho de actualizar esta política de privacidad cuando sea necesario. Publicaremos cualquier cambio en esta misma página.
        </p>

        <h2>Contacto</h2>
        <p>
            Si tienes alguna duda sobre esta política de privacidad, no dudes en contactarnos:
        </p>
        <p><strong>Dirección:</strong> Calle Bernardo Jiménez nº4, Los Barrios, Cadiz</p>
        <p><strong>Teléfono:</strong> (+34) 666 777 888</p>
    </div>
    <?php include "footer.html"; ?>
</body>
</html>