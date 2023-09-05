<?php
require_once(__DIR__."/../coneccion.php");
$conexion=Db::conectar();
    if(isset($_POST['query'])){
        $query = $_POST['query'];
        $insertar = mysqli_query($conexion,$query);
    }
    if(isset($_POST["op"])){
        $op=$_POST["op"];
        $ante="";
        if($op=="SubirDatos"){
          if($_POST["dni"]!=""&&$_POST["nombre"]!=""&&$_POST["apellido"]!=""&&$_POST["telf"]!=""){
            $sql = "INSERT IGNORE INTO trabajador
            (id,nombre,apellido,telefono,estado_civil,email,direccion,banco,fecha_naci,numero_cuenta,cci_cuenta,afp_onp,reclutadora,idcargo,idsede,idarea)
             VALUES ('".$_POST["dni"].
            "', '" . strtoupper($_POST["nombre"]).
            "', '" . strtoupper($_POST["apellido"]). 
            "', '" . strtoupper($_POST["telf"]) .
            "', '" . strtoupper($_POST["estado_civil"]). 
            "', '" . strtoupper($_POST["email"]) .
            "', '" . strtoupper($_POST["direccion"]). 
            "', '" . strtoupper($_POST["banco"]). 
            "', '" . strtoupper($_POST["fecha_naci"]) .
            "', '" . strtoupper($_POST["numero_cuenta"]) .
            "', '" . $_POST["cci_cuenta"] .
            "', '" . strtoupper($_POST["afp_onp"]). 
            "', '" . strtoupper($_POST["reclutadora"]). 
            "', '". ($_POST["idcargo"]) .
            "', '" . ($_POST["idsede"]) .
            "', '" . ($_POST["idarea"]) .
            "');";
            // echo $sql."\n";
            $var=mysqli_fetch_assoc(mysqli_query($conexion,"SELECT count(*) as c FROM trabajador where id='".$_POST["dni"]."'"));
            if($var["c"]=="0"){
              echo mysqli_query($conexion,$sql);
            }
            else{
              echo "encontrado";
            }
          }
          else{
            echo "falta";
          }
        }
        else{
          echo "nada";
        }
    }
?>