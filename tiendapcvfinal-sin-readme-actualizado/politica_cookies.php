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
    <title>Política de Cookies - PcPlus SL</title>
    <link rel="stylesheet" href="politicas.css">
</head>
<body>
<div class="content-container">
        <h1>Política de Cookies</h1>
        <p>
            En <strong>PcPlus SL</strong>, utilizamos cookies para mejorar la experiencia de los usuarios en nuestro sitio web.
            A continuación, explicamos qué son las cookies, cómo las usamos y cómo puede gestionarlas.
        </p>

        <h2>¿Qué son las cookies?</h2>
        <p>
            Las cookies son pequeños archivos de texto que se almacenan en su dispositivo cuando visita un sitio web. 
            Estos archivos permiten al sitio web recordar sus preferencias y mejorar su experiencia de navegación.
        </p>

        <h2>Tipos de cookies que utilizamos</h2>
        <table>
            <tr>
                <th>Tipo de Cookie</th>
                <th>Finalidad</th>
                <th>Duración</th>
            </tr>
            <tr>
                <td>Cookies Técnicas</td>
                <td>Esenciales para el correcto funcionamiento del sitio web.</td>
                <td>Sesión</td>
            </tr>
            <tr>
                <td>Cookies de Análisis</td>
                <td>Nos ayudan a entender cómo interactúan los usuarios con el sitio web.</td>
                <td>Persistente</td>
            </tr>
            <tr>
                <td>Cookies de Publicidad</td>
                <td>Utilizadas para mostrar anuncios relevantes para el usuario.</td>
                <td>Persistente</td>
            </tr>
        </table>

        <h2>Gestión de cookies</h2>
        <p>
            Puede configurar su navegador para aceptar, bloquear o eliminar las cookies. A continuación, le mostramos cómo hacerlo en los principales navegadores:
        </p>
        <ul>
            <li><strong>Google Chrome:</strong> Vaya a Configuración > Privacidad y seguridad > Cookies y otros datos del sitio.</li>
            <li><strong>Mozilla Firefox:</strong> Vaya a Opciones > Privacidad y seguridad > Cookies y datos del sitio.</li>
            <li><strong>Microsoft Edge:</strong> Vaya a Configuración > Cookies y permisos del sitio.</li>
            <li><strong>Safari:</strong> Vaya a Preferencias > Privacidad.</li>
        </ul>
        <p>
            Tenga en cuenta que deshabilitar ciertas cookies puede afectar el funcionamiento del sitio web.
        </p>

        <h2>Actualizaciones de la política de cookies</h2>
        <p>
            Esta política puede actualizarse periódicamente para reflejar cambios en nuestras prácticas o en la normativa vigente. 
            Le recomendamos revisarla regularmente.
        </p>

        <h2>Contacto</h2>
        <p>
            Si tiene alguna pregunta sobre nuestra política de cookies, puede contactarnos a través del número 
            (+34) 666 777 888 o enviarnos un correo electrónico a <strong>contacto@pcplus.com</strong>.
        </p>
    </div>
    <?php include "footer.html"; ?>
</body>
</html>