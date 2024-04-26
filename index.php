<?php

// No mostrar las alertas del codigo
error_reporting(0);

$ciudad = "Bogota";

if($_POST) {
    // print_r($_POST);
    $ciudad = $_POST['ciudad'];
}


$URL = "https://api.openweathermap.org/data/2.5/weather?q=$ciudad&appid=00780d189ac29ce79a65839278cac7ae&units=metric&lang=es";

$ruta_icon = "https://www.imelcf.gob.pa/wp-content/plugins/location-weather/assets/images/icons/weather-icons/";


// funcion predeterminada de json, a partir de un URL nos va a devolver el contenido en formato json
$stringMeteo = file_get_contents($URL);

$jsonMeteo = json_decode($stringMeteo, true);

// $ciudad = $_POST['ciudad'];

/** Obtener la ciudad
 * Icono
 * Descripcion
 * Del Main: temp, tempo_min, temp_max, feels_like, humedity
 * 
 */

 //variables
$icon = $jsonMeteo['weather']['0']['icon'];
$ciudad = $jsonMeteo['name'];
$descripcion = $jsonMeteo['weather']['0']['description'];
$temperatura = $jsonMeteo['main']['temp'];
$temp_min = $jsonMeteo['main']['temp_min'];
$temp_max = $jsonMeteo['main']['temp_max'];
$sensacion = $jsonMeteo['main']['feels_like'];
$humedad = $jsonMeteo['main']['humidity'];


?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Meteo</title>
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family:Verdana, Geneva, Tahoma, sans-serif;
    font-size: 1vw;
    /* color: #4CAF50; */
  }
  .container{
    width: 600px;
    text-align: center;
    background-color: red;
    margin: 15px auto;
}
body{
    background-color: aquamarine;
}
h1{
    font-family: Georgia, 'Times New Roman', Times, serif;
    font-size: 2vw;
    padding: 1rem;
}
legend{
    font-size: 1.5vw;
}
.info_img{
    display: flex;
    justify-content: center;
}
.info_img >img{
    width: 10%;
    position: center top;
}
.info{
    display: flex;
    flex-direction: column;
    padding: 12px;
}
.ciudad{
    padding: 12px;
}
    </style>
</head>
<body>
    <?php if(!$stringMeteo) : ?>
        <p><?php $ciudad ?> : Nombre de ciudad incorrecto</p>
    <?php else : ?> 
        <div class="container">
        <h1>El tiempo en Directo</h1>
        <fieldset>
            <legend>Ciudad Actual: <?= $ciudad?></legend>
            <div class="info_img">
                <img src=<?= $ruta_icon.$icon.".svg"?> alt="Icono del tiempo">
                <div class="info">
                    <p>Descripción: <?= $descripcion ?></p>
                    <p>Temperatura: <?= $temperatura ?>ºC </p>
                    <p>Temperatura Máxima: <?= $temp_max ?>ºC </p>
                    <p>Temperatura Mínima: <?= $temp_min ?>ºC </p>
                    <p>Sensación Térmica: <?= $sensacion ?>ºC </p>
                    <p>Humedad: <?= $humedad ?> </p>
                </div>
            </div>
            <form action="index.php" method="POST" class="container">
                <label for="ciudad">Cambiar Ciudad</label>
                <input type="text" name="ciudad" id="ciudad" value="<?= $ciudad ?>"/>
                <button type="submit">enviar</button>
            </form>
        </fieldset>

    </div>
    <?php endif; ?>

</body>
</html>