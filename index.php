<?php
    ob_start();
    require_once('Connections/Conexion.php');
?>
<!doctype html>
<html lang="es">
<head>    
    <meta charset="utf-8">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="img/favicon.png">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="micss/micss.css" type="text/css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/0d34c82604.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>RadioMandonguilla</title>
</head>
<body>
    <!-- Grid -->
    <div id="fondo__Negro">     
        <?php include("includes/menu.php");?>  
</div>
<div class="container">

        <?php include("includes/cabecera.php");?>      
        <?php include("includes/sonandoAhora.php");?>
        <div class="row">
            <div class="col-xl-8 mt-5">
                <?php include("includes/numeroUnoDeLaSemana.php");?>
                <?php include("includes/chart.php");?>
            </div>
            <div class="col-xl-4">
                <?php include("includes/novedadesDiscos.php");?>
                <?php include("includes/enAntena.php");?>
                <?php include("includes/ultimosNumeroUno.php");?>
            </div>
        </div>
        <?php include("includes/frases.php");?>
        <?php include("includes/eventos.php");?>
        <?php include("includes/programacionHoy.php");?>
        <?php include("includes/locutores.php");?>
        <?php include("includes/pideCanciones.php");?>
        <?php include("includes/solicitudCanciones.php");?>
        <?php include("includes/programas.php");?>
        <?php include("includes/whatsapp.php");?>
    </div>
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3081.905708274152!2d-0.3957724847058214!3d39.426256623201645!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd604ec1d5346b8f%3A0x7c4558119fae2ddd!2sC.%20de%20Castillo%20Olite%2C%2018%2C%2046910%20Alfafar%2C%20Valencia!5e0!3m2!1ses!2ses!4v1631388247731!5m2!1ses!2ses"
        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy">
    </iframe>
    <?php include("includes/footer1.php");?>
    <!-- Fin Grid -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="misjs/misfunciones.js" type="text/javascript"></script>
    <script src="misjs/misjquery.js" type="text/javascript"></script>
</body>

</html>
<script type="text/javascript">
$(document).ready(function() {
    setInterval(ProgramaActual, 1000);                  // cada segundo se actualiza
    setInterval(ActualizaSolicitudCanciones, 1000);     // cada segundo se actualiza
    setInterval(ProgEnAntena, 1000);                    // cada segundo se actualiza
    setInterval(CancionEnAntena, 1000);                 // cada segundo se actualiza
});
</script>
