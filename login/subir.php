<?php
    require_once("../coneccion.php");
    $cn=Db::conectar();
    if(isset($_POST["login"])){
        $usuario=$_POST["dni"];
        $contraseña=$_POST["contraseña"];
        $coordinador=$_POST["coordinador"];
        $sede=$_POST["sede"];
        if($contraseña==""||$usuario==""|| ($coordinador=="" && $sede=="")){
            echo "vacio";
        }
        else{
            $contraseña=sha1($contraseña);
            $usuarios=mysqli_fetch_assoc(mysqli_query($cn,"SELECT t.idarea,t.id,u.usuario,u.contraseña,concat(t.nombre,' ',t.apellido) as nombre,ca.cargo FROM usuario u inner join trabajador t on t.id=u.trabajador inner join cargo ca on ca.idcargo=t.idcargo WHERE u.usuario='$usuario' and contraseña='$contraseña' and t.estado='ACTIVO'"));
            if($usuarios!=null){
                $asis=mysqli_fetch_assoc(mysqli_query($cn,"SELECT COUNT(*) as c FROM asistencia WHERE id_trabajador='".$usuarios["id"]."' and fecha ='".date("Y-m-d")."';"));
                if($asis["c"]==1 || $usuarios["idarea"]=="9" || $usuarios["cargo"]=="MOTORIZADO" || $usuarios["id"]=="80007822" || $usuarios["idarea"]=="7"    || str_contains($usuarios["cargo"],'SUPERVISOR')){
                    session_start();
                    switch ($usuarios["cargo"]) {
                        case 'ASESOR DE VENTAS':
                        case 'CAPACITACION':
                        case 'SELECCION':
                        case 'POSTULANTE':
                        case 'OJT':
                            if($sede=="c" || $usuarios["idarea"]=="4"){
                                $cord=mysqli_fetch_assoc(mysqli_query($cn,"SELECT t.id FROM usuario u inner join trabajador t on t.id=u.trabajador inner join cargo ca on ca.idcargo=t.idcargo WHERE u.usuario='$coordinador' and ca.cargo in ('COORDINADOR','CAPACITADOR') and t.estado='ACTIVO'"));
                                if($cord==null){
                                    echo "noCoord";
                                }
                                else{
                                    if($usuarios["idarea"]=="4"){
                                        unset($usuarios["usuario"]);
                                        unset($usuarios["contraseña"]);
                                        $_SESSION=$usuarios;
                                        $_SESSION["coordinador"]=$cord["id"];
                                        echo "entra";
                                    }
                                    else{
                                        $_SESSION=["usuario"=>$usuarios["usuario"],"contraseña"=>$usuarios["contraseña"],"coordinador"=>$cord["id"]];
                                        echo "asesor";
                                    }
                                }
                            }
                            else{
                                echo "sedeIncorrecta";
                            }
                            break;
                        case 'MOTORIZADO':
                            unset($usuarios["usuario"]);
                            unset($usuarios["contraseña"]);
                            $_SESSION=$usuarios;
                            $_SESSION["id_moto"]=$_SESSION["id"];
                            unset($_SESSION["id"]);
                            echo "moto";
                            break;
                        default:
                            if($sede=="c"){
                                echo "sedeIncorrecta2";
                            }
                            else{
                                unset($usuarios["usuario"]);
                                unset($usuarios["contraseña"]);
                                $_SESSION=$usuarios;
                                echo "entra";
                            }
                            break;
                    }
                }
                else if($asis["c"]>1){
                    echo "Salio";
                }
                else if($asis["c"]==0){
                    echo "FaltaAsistencia";
                }
            }
            else{
                echo "noEntra";
            }
        }
    }
    else if(isset($_POST["regis"])){
        if(isset($_POST["regis_usuario"])){
            $sql="INSERT into usuario values (null,'".$_POST["regis_usuario"]."','".sha1($_POST["regis_contra"])."','".$_POST["regis_dni"]."')";
            $result=mysqli_query($cn,$sql);
            echo $sql."\n".$result;
        }
    }
    else if(isset($_POST["txt"])){
        $txt=$_POST['txt'];
        $existe=mysqli_fetch_array(mysqli_query($cn,"SELECT count(*) as c FROM usuario WHERE trabajador=\"$txt\";"));
        if($existe["c"]=="0"){
            $sql=mysqli_fetch_array(mysqli_query($cn,"SELECT cargo,concat (nombre,' ',apellido) as nombre FROM trabajador t INNER JOIN cargo c on t.idcargo=c.idcargo WHERE id=\"$txt\""));
            if($sql!=null){
                echo "NOMBRE: <p style='color:red;text-align:center;'>".$sql["nombre"]."</p><br>CARGO: <p style='color:red;text-align:center;'>".$sql["cargo"]."</p>";
            }
        }
        else{
            echo "<p style='color:red;text-align:center;'>YA EXISTE UN USUARIO CON ESTE DNI</p>";
        }
    }
    else{
        echo json_encode($_POST);
    }
?>