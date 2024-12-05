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
    <title>Aviso Legal - PcPlus SL</title>
    <link rel="stylesheet" href="politicas.css">
</head>
<body>
<div class="content-container">
    <h1>Aviso Legal</h1>
    <p>
        Este aviso legal regula el uso del sitio web proporcionado por <strong>PcPlus SL</strong>, 
        en cumplimiento de la normativa vigente.
    </p>

    <h2>Información General</h2>
    <table>
        <tr>
            <th>Razón Social</th>
            <td>PcPlus SL</td>
        </tr>
        <tr>
            <th>Número de Teléfono</th>
            <td>(+34) 666 777 888</td>
        </tr>
        <tr>
            <th>Dirección Física</th>
            <td>Calle Bernardo Jiménez nº4, Los Barrios, Cadiz</td>
        </tr>
        <tr>
            <th>Email de Contacto</th>
            <td>contacto@pcplus.com</td>
        </tr>
    </table>

    <h2>Condiciones de Uso</h2>
    <p>
        El acceso y uso del sitio web de PcPlus SL está sujeto a los siguientes términos:
    </p>
    <ul>
        <li>El usuario se compromete a utilizar el sitio web de manera legal y respetuosa.</li>
        <li>PcPlus SL no se hace responsable de los daños que puedan derivarse del uso indebido del sitio web.</li>
        <li>Queda prohibido copiar, modificar o distribuir el contenido del sitio sin la autorización previa de PcPlus SL.</li>
    </ul>

    <h2>Protección de Datos</h2>
    <p>
        En PcPlus SL respetamos su privacidad. Todos los datos recopilados serán tratados de acuerdo con la legislación vigente
        y no serán compartidos con terceros sin su consentimiento.
    </p>

    <h2>Propiedad Intelectual</h2>
    <p>
        Todo el contenido, incluyendo textos, imágenes, logotipos y diseño gráfico, es propiedad de PcPlus SL o de sus licenciantes.
        Está prohibida su reproducción total o parcial sin autorización expresa.
    </p>

    <h2>Contacto</h2>
    <p>
        Para cualquier consulta relacionada con este aviso legal, puede contactarnos a través del número 
        (+34) 666 777 888 o del correo electrónico <strong>contacto@pcplus.com</strong>.
    </p>
</div>
<?php include "footer.html"; ?>
</body>
</html>
