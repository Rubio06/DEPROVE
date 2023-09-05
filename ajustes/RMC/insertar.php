<?php 
    require_once("../../coneccion.php");
    $cn = Db::conectar();

    if(isset($_POST["op"])){
        $op=$_POST["op"];
        $fecha=$_POST["fecha"];
        $par=$_POST["par"];
        $mini=$_POST["mini"];
        $full=$_POST["full"];
        if($op=="insertar"){
            $count=
            mysqli_fetch_array(mysqli_query(Db::conectar(),"SELECT count(*) as num from cuotaModalidad where fecha='".$fecha."-01'"));
            if($count["num"]=="0"){
                $sql = "INSERT INTO cuotaModalidad VALUES (null,'".$fecha."-01', 'P', '" .$par
                ."'), (null,'" .$fecha."-01','M','" .$mini 
                ."'), (null,'" .$fecha."-01','F','".$full."');";
                echo mysqli_query($cn,$sql);
            }
            else{
                echo "editar";
            }
        }
        else if($op=="editar"){
            $count=mysqli_fetch_array(mysqli_query(Db::conectar(),"SELECT count(*) as num from cuotaModalidad where fecha='".$fecha."-01'"));
            if($count["num"]!="0"){
                echo mysqli_query(Db::conectar(),"UPDATE cuotaModalidad set cantidad= '".$par."' where fecha='".$fecha."-01' and modalidad='P';");
                echo mysqli_query(Db::conectar(),"UPDATE cuotaModalidad set cantidad='".$mini."' where fecha='".$fecha."-01' and modalidad='M';");
                echo mysqli_query(Db::conectar(),"UPDATE cuotaModalidad set cantidad='".$full."' where fecha='".$fecha."-01' and modalidad='F';");
            }
            else{
                echo "existe";
            }
        }
    }
?>