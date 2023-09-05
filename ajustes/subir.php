<?php

include ("../coneccion.php");
$cn = Db::conectar();
$id=0;
echo mysqli_query($cn,$_POST["query"]);

?>