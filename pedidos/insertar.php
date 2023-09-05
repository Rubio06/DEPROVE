<?php 
    require_once("../coneccion.php");
    $cn = Db::conectar();
    $query = $_POST['query'];
    $insertar = mysqli_query($cn,$query);
?>