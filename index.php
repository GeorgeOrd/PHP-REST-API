<?php

require_once "src/database/db.php";
//Objeto de la base de datos
$db = new db;

//consultas SQL para la base de datos
$query = "SELECT *FROM  tbl_empleado";

//Varaibles en las que se ejecutarn las consultas 
$res = $db->getInfo($query);


//Funciones para mostrar las consultas de manera adecuada
function show($array)
{
    if (is_array($array)) {
        echo "<table border=1 cellspacing=0 cellpadding=3 width=100%>";
        echo '<tr><td colspan=2 style="background-color:#333333;"><strong><font color=white>EMPLEADO</font></strong></td></tr>';
        foreach ($array as $k => $v) {
            echo '<tr><td valign="top" style="width:40px;background-color:#F0F0F0;">';
            echo '<strong>' . $k . "</strong></td><td>";
            show($v);
            echo "</td></tr>";
        }
        echo "</table>";

        return;
    }
    echo $array;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <title>Empleado Pequeños Traviesos</title>
</head>

<body>
    <button class="btn btn-success" onclick="window.location='xmlVenta.php'">MOSTRAR COMPRAS</button>
    <a class="btn btn-danger" href="pdf.php">GENERAR REPORTE PDF <i class="far fa-file-pdf"></i></a>
    <div id="jsonDIV" style="border:1px solid black; display: none;">
    </div>
    <?php
    show($res);
    ?>
    <script src="app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>

</html>