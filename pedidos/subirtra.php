<?php
require_once(__DIR__."/../coneccion.php");
$cn=Db::conectar();
    if(isset($_POST['query'])){
        $query = $_POST['query'];
        $insertar = mysqli_query($cn,$query);
    }
    if(isset($_POST["op"])){
        $op=$_POST["op"];
        $ante="";
        if($op=="SubirNatural"){
            $sql = "INSERT IGNORE INTO cliente VALUES (null,'".$_POST["mostrarNatural"].
            "','" . strtoupper($_POST["ingreso_dni"]).
            "','" . strtoupper($_POST["ingreso_Nombre"]).
            "', '" . strtoupper($_POST["ingreso_Apellido"]). 
            "', '" . strtoupper($_POST["ingreso_Correo"]).
            "', '" .
            "', '" .
            "');";
            echo mysqli_query($cn,$sql);
        }
        if($op=="SubirRazon"){
            $sql = "INSERT IGNORE INTO cliente VALUES (null,'".$_POST["mRazon"].
            "','" . strtoupper($_POST["ingresa_RUC"]).
            "','" . strtoupper($_POST["Ingresa_Razon"]).
            "','" . 
            "', '" . strtoupper($_POST["Razon_correo"]). 
            "', '" . strtoupper($_POST["Razon_Distrito"]).
            "', '" . strtoupper($_POST["Razon_direc"]).
            "');";
            echo mysqli_query($cn,$sql);
        }
        if($op=="cerrar"){
            session_start();
            session_destroy();
        }
    }
    if(isset($_POST["txt"])){
        $txt=$_POST['txt'];
        $sql=mysqli_fetch_assoc(mysqli_query($cn,"SELECT * from cliente WHERE dni_ruc=\"$txt\""));
        if($sql!=null){
            echo json_encode($sql);
        }
    }
?>