<?php
date_default_timezone_set('America/Lima');
require_once("../coneccion.php");
if(isset($_POST)){
    $cn=Db::conectar();
    if(isset($_POST["txt"])){
        $txt=$_POST['txt'];
        $hoy=date("Y-m-d");
        $hoy=date("h:i:s");
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
        echo date("h:i:s");
    }
    if(isset($_POST["fechai"])){
        $arr=[];
        $bg="";
        $valor=$_POST["nombre"];
        $sql=mysqli_query($cn,
        "SELECT 
        a.*,
        concat(t.nombre,' ',t.apellido) as nombre 
        from asistencia a 
        inner join trabajador t on t.id=a.id_trabajador 
        WHERE a.fecha>='".$_POST["fechai"]."' and a.fecha<='".$_POST["fechaf"]."' and (t.nombre like '%$valor%' or t.apellido like '%$valor%' or t.id like '%$valor%');");
        $ante="";
        while($x=mysqli_fetch_array($sql)){
            if(!in_array($x["id_trabajador"],$arr)&& $x["hora"]<"14"){
                $bg="background:#c1eb99;";
                array_push($arr,$x["id_trabajador"]);
            }
            else{
                array_splice($arr,array_search($x["id_trabajador"],$arr),1);
                if($valor=="" && $ante==$x["id_trabajador"]){
                    $bg="background:orange;";
                }
                else if($valor!="" && $ante==$x["id_trabajador"]){
                    $bg="background:indianred;";
                }
                else{
                    $bg="background:indianred;";
                }
                if($x["hora"]=="7"){
                        $bg="background:yellow;";
                }
            }
            if(($valor=="" ) || ($valor!="")){ ?>  
                <tr>
                <td style="<?php echo $bg;?>" ><?php echo $x["id_trabajador"]; ?></td>
                <td style="<?php echo $bg;?>" ><?php echo $x["nombre"]; ?></td>
                <td style="<?php echo $bg;?>" <?php echo $x["hora"] ?> ><?php echo date("d/m/Y", strtotime($x["fecha"]))."  -  ".date("h:i:s A", strtotime($x["hora"])); ?></td>
                <td style="<?php echo $bg;?>" > <img onclick='Agrandar(this)' src="<?php echo "https://deproveglobal.com/imagenasistencia/".$x["foto"]; ?>.png" alt="" width="150px"></td>
            </tr>
            <?php
            }
            $ante=$x["id_trabajador"];
        }
    }
    if(isset($_POST["dni"])){
        $sql="INSERT into asistencia values (null,'".date("Y-m-d")."','".date("H:i:s")."','".$_POST["dni"]."','".$_POST["nombre"]."')";
        $result=mysqli_query($cn,$sql);
        echo $sql."\n".$result;
    }
}
?>