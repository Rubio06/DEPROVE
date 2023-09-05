<?php
date_default_timezone_set('America/Lima');
require_once("../coneccion.php");
if(isset($_POST)){
    if(isset($_POST["txt"])){
        $cn=Db::conectar();
        $txt=$_POST['txt'];
        $hoy=date("Y-m-d");
        $hora=date("H:i:s");
        $sql=mysqli_query($cn,"SELECT nombre, apellido,turno from trabajador WHERE id=\"$txt\"");
        while ($row = $sql->fetch_object()) {
            $sql2=mysqli_query($cn,"SELECT hora from asistencia WHERE fecha='$hoy' and id_trabajador='$txt'");
            while ($row2 = $sql2->fetch_object()) {
                $resultSet[]=$row2; 
            }
            if(isset($resultSet)){
                echo json_encode([$row,$resultSet]);
            }
            else{
                echo json_encode([$row,"00:00:00"]);
            }
        }
    }
    if(isset($_POST["hora"])){
        echo date("H:i:s");
    }
    if(isset($_POST["fecha"])){
        echo date("Y-m-d");
    }
    if(isset($_POST["dni"])){
        $cn=Db::conectar();
        $sql="INSERT into asistencia values (null,'".date("Y-m-d")."','".date("H:i:s")."','".$_POST["dni"]."','".$_POST["nombre"]."')";
        $result=mysqli_query($cn,$sql);
        echo $sql."\n".$result;
    }
}
?>