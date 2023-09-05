<?php

include ("../coneccion.php");
$cn = Db::conectar();
$id=0;
$consulta = mysqli_query($cn,$_POST["query"]);
?>