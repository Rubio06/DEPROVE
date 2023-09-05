<?php

    include ("../coneccion.php");
    $cn = Db::conectar();

    $banco = $_POST['selectbanco'];

    $sql = "INSERT INTO `banco`(`banco`) VALUES ('$banco');";

    $resultado = mysqli_query($cn,$sql);
   
?>