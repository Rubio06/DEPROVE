 <?php 
include ("../coneccion.php");
header('Content-Type: text/html; charset=UTF-8');
if(isset($_POST["q"])){
    date_default_timezone_set('America/Lima');
    $hora = date("h:i:s");
    $hoy= date("Y-m-d");
    $cn = Db::conectar();
    $q=$_POST["q"];
    if($q=="bajar_data"){
        $arra=[];
        $arra=mysqli_fetch_array(mysqli_query($cn,"select * from numerosllamadas where tipif1='' ORDER BY RAND() limit 1;"));
        if($arra!=null && $arra!=""){
            mysqli_query($cn,"update numerosllamadas set tipif1='Gestionando', fecha='".$hoy."', asesor='".strtoupper($_POST["asesor"])."' where id=".$arra[0]);
        }
        echo json_encode($arra);
    }
    if($q=="subir_data"){
        mysqli_query($cn,"update numerosllamadas set tipif1='".$_POST["tipif1"]."', tipif2='".$_POST["tipif2"]."', fin='".$hora."' where id=".$_POST["id"]);
    }
    if($q=="inicioLlamada"){
        mysqli_query($cn,"update numerosllamadas set inicio='$hora' where id=".$_POST["id"]." and inicio='00:00:00'");
    }
    if($q=="verTotalLlamadas"){
        $cn = Db::conectar();
        $mes=date("Y-m-");$hoy=date("d");
        $dni=array();$tipif2=array();$asesores=array();$ante="";$estado=array();
        $tipificaciones=['VENTA','NO INTERESADO','VOLVER A LLAMAR','NO CALIFICA','NO LLAMAR','PROVINCIA','NUMERO EQUIVOCADO','USUARIO CONTESTA, NO ES EL TITULAR','TITULAR FALLECIDO','SU LINEA ES COORPORATIVA','NO CONTESTA','NUMERO NO EXISTE','BUZON DE VOZ','LINEA SUPENDIDA / BLOQUEADA','NUMERO OCUPADO','CLIENTE RECHAZA LLAMADA'];
        $consulta=mysqli_query($cn,"SELECT id, concat(nombre,' ', apellido) as nombre,estado,cargo FROM trabajador INNER JOIN cargo ON trabajador.idcargo = cargo.idcargo where cargo.cargo in ('ASESOR DE VENTAS','OJT','CAPACITACION','POSTULANTE') order by nombre asc");
        while($x=mysqli_fetch_array($consulta)){ 
            $dni[$x['id']]=$x["nombre"];
            $estado[$x["nombre"]][0]=$x["estado"];
            for($y=1;$y<=$hoy;$y++){
                if(strlen($y)==1){$h="0".$y;}else{$h=$y;}
                $estado[$x["nombre"]][1][$mes.$h]="F";
                array_push($asesores,[$x["nombre"],$mes.$h,$x["cargo"]]);
            }
        }
        array_push($asesores,"OTROS");
        
        $consulta=mysqli_query($cn,"SELECT * from asistencia where fecha >='".$mes."-01' group by fecha,id_trabajador order by fecha asc;");
        while($x=mysqli_fetch_array($consulta)){ 
            if(isset($dni[$x["id_trabajador"]])){
                $estado[$dni[$x["id_trabajador"]]][1][$x["fecha"]]="A";
            }
        }

        $consulta=mysqli_query($cn,"select count(*) as total,fecha,tipif1,tipif2, SEC_TO_TIME(sum(fin-inicio)) as 'Total llamado',concat(trabajador.nombre,' ',trabajador.apellido) as asesor from numerosllamadas inner join trabajador on trabajador.id=numerosllamadas.asesor where tipif1!='' and inicio!=\"00:00:00\" and fecha>=\"2022-11-01\" GROUP by asesor,fecha,tipif2 order by asesor ASC,fecha DESC;");
        while($x=mysqli_fetch_array($consulta)){
            $tipif2[$x["asesor"]][$x["fecha"]][$x["tipif2"]]=$x["total"];
            if(!in_array([$x["asesor"],$x["fecha"]],$asesores)){
                array_push($asesores,[$x["asesor"],$x["fecha"]]);
            }
        }
        $ante=$asesores[0][0];
        for($x=0;$x<count($asesores);$x++){ 
            if($asesores[$x]=="OTROS"){
                echo "<tr><td style='background:#fff700'>OTROS TRABAJADORES</td><td style='background:#fff700' colspan=24></td></tr>";
                $x++;
            }
            $s="";$tot=0;$cadena="";
            if($ante!=$asesores[$x][0]){
                $ante=$asesores[$x][0];
                $s="style='border-top:1px solid black;'";
            }
            if(!isset($estado[$asesores[$x][0]][0]) || $estado[$asesores[$x][0]][0]==""|| $estado[$asesores[$x][0]][0]==" "){
                $estado[$asesores[$x][0]][0]="SIN ESTADO";
            }
            if(!isset($asesores[$x][2])){
                $asesores[$x][2]="CARGO NO ENCONTRADO";
            }
            for($i=0;$i<count($tipificaciones);$i++){
                if(isset($tipif2[$asesores[$x][0]][$asesores[$x][1]][$tipificaciones[$i]])){
                    $tot+=$tipif2[$asesores[$x][0]][$asesores[$x][1]][$tipificaciones[$i]];
                    $cadena=$cadena."<td>".$tipif2[$asesores[$x][0]][$asesores[$x][1]][$tipificaciones[$i]]."</td>";
                }
                else{
                    $cadena=$cadena."<td>0</td>";
                }
            }

            echo "<tr $s> 
            <td>".$asesores[$x][0]."</td>
            <td>".$asesores[$x][1]."</td>
            <td>".$estado[$asesores[$x][0]][0]."</td>
            <td>".$estado[$asesores[$x][0]][1][$asesores[$x][1]]."</td>
            <td>".$asesores[$x][2]."</td>
            <td>".$tot."</td><td></td>".$cadena;
            // for($i=0;$i<count($tipificaciones);$i++){
            //     if(isset($tipif2[$asesores[$x][0]][$asesores[$x][1]][$tipificaciones[$i]])){
            //         echo "<td>".$tipif2[$asesores[$x][0]][$asesores[$x][1]][$tipificaciones[$i]]."</td>";
            //     }
            //     else{
            //         echo "<td>0</td>";
            //     }
            // }
            echo "</tr>";
        }
    }
    if($q=="verDetaTotalLlamadas"){
        $cn = Db::conectar();
        $mes=date("Y-m-");
        $hoy=date("d");
        $dni=array();$asesores=array();$ante="";
        $inicio=0;
        $tipificaciones=['VENTA','NO INTERESADO','VOLVER A LLAMAR','NO CALIFICA','NO LLAMAR','PROVINCIA','NUMERO EQUIVOCADO','USUARIO CONTESTA, NO ES EL TITULAR','TITULAR FALLECIDO','SU LINEA ES COORPORATIVA','NO CONTESTA','NUMERO NO EXISTE','BUZON DE VOZ','LINEA SUPENDIDA / BLOQUEADA','NUMERO OCUPADO','CLIENTE RECHAZA LLAMADA'];
        $consulta=mysqli_query($cn,"SELECT id, concat(nombre,' ', apellido) as nombre,estado,cargo FROM trabajador INNER JOIN cargo ON trabajador.idcargo = cargo.idcargo where cargo.cargo in ('ASESOR DE VENTAS','OJT','CAPACITACION','POSTULANTE') order by nombre asc");
        while($x=mysqli_fetch_assoc($consulta)){ 
            $dni[$x['id']]=$x["nombre"];
            $dni[$inicio]=$x['id'];
            $inicio=count($dni)/2;
            for($y=1;$y<=$hoy;$y++){
                if(strlen($y)==1){$h="0".$y;}else{$h=$y;}
                $asesores[$x["nombre"]][$mes.$h]["asistencia"]="F";
                $asesores[$x["nombre"]][$mes.$h]["cargo"]=$x["cargo"];
                $asesores[$x["nombre"]][$mes.$h]["estado"]=$x["estado"];
                $asesores[$x["nombre"]][$mes.$h]["total"]=0;
                for($z=0;$z<count($tipificaciones);$z++){
                    $asesores[$x["nombre"]][$mes.$h]["tipif"][$tipificaciones[$z]]=0;
                }
            }
        }
        $dni["OTROS"]="---";
        $dni[$inicio]="OTROS";
        $inicio=count($dni)/2;
        array_push($dni,"OTROS");
        $ante=0;
        $tot=0;
        $nuevos=Array();
        $consulta=mysqli_query($cn,"select trabajador.id, concat(nombre,' ', apellido) as nombre,estado, count(*) as total, fecha, tipif1, tipif2, SEC_TO_TIME(sum(fin-inicio)) as 'Total llamado' , trabajador.id, estado, cargo from numerosllamadas inner join trabajador on trabajador.id=numerosllamadas.asesor INNER JOIN cargo ON trabajador.idcargo = cargo.idcargo where tipif1!='' and inicio!=\"00:00:00\" and fecha>=\"2022-11-01\" GROUP by asesor,fecha,tipif2 order by nombre ASC,fecha DESC;");
        while($x=mysqli_fetch_array($consulta)){
            if($ante!=$x['id']){
                $ante=$x['id'];
                $tot=0;
            }
            $tot+=$x['total'];
            if(!isset($dni[$x["id"]])){
                array_push($nuevos,$x["nombre"]);
                $dni[$x['id']]=$x["nombre"];
                $dni[$inicio]=$x['id'];
                $inicio=count($dni)/2;
                $asesores[$dni[$x["id"]]][$x["fecha"]]["asistencia"]="F";
                $asesores[$dni[$x["id"]]][$x["fecha"]]["cargo"]=$x["cargo"];
                $asesores[$dni[$x["id"]]][$x["fecha"]]["estado"]=$x["estado"];
                $asesores[$dni[$x["id"]]][$x["fecha"]]["total"]=0;
                for($z=0;$z<count($tipificaciones);$z++){
                    $asesores[$dni[$x["id"]]][$x["fecha"]]["tipif"][$tipificaciones[$z]]=0;
                }
            }
            if($x["tipif2"]==""){$x["tipif2"]="NO TIPIFICADO";}
            $asesores[$dni[$x["id"]]][$x["fecha"]]["tipif"][$x["tipif2"]]=(int)$x["total"];
            $asesores[$dni[$x["id"]]][$x["fecha"]]["total"]=$tot;
        }
        
        $consulta=mysqli_query($cn,"SELECT * from asistencia where fecha >='".$mes."-01' group by fecha,id_trabajador order by fecha asc;");
        while($x=mysqli_fetch_assoc($consulta)){ 
            if(isset($dni[$x["id_trabajador"]])){
                $asesores[$dni[$x["id_trabajador"]]][$x["fecha"]]["asistencia"]="A";
            }
        }
        // echo json_encode($asesores);
        $i=0;
        $ante=$dni[0];
        // echo "<td rowspan=".($hoy+1).">1</td>";
        for($x=0;$x<count($dni)/2-1;$x++){ 
            for($y=1;$y<=$hoy;$y++){
                if(strlen($y)==1){$h="0".$y;}else{$h=$y;}
                if($dni[$x]=="OTROS"){
                    echo "<tr><td style='background:#fff700'></td><td style='background:#fff700'>OTROS TRABAJADORES</td><td style='background:#fff700' colspan=23></td></tr>";
                    $x++;
                    continue;
                }
                $s="";$tot=0;$cadena="";
                if($ante!=$dni[$x]){
                    $ante=$dni[$x];
                    $i=$i+1;
                    // echo "<td style='border-top: 1px solid black;' rowspan=".($hoy+1).">".($x/$hoy+1)."</td>";
                    $s="style='border-top:1px solid black;'";
                }
                if(isset($asesores[$dni[$dni[$x]]][$mes.$h]["tipif"])){
                    if(!isset($asesores[$dni[$dni[$x]]][$mes.$h]["estado"]) || $asesores[$dni[$dni[$x]]][$mes.$h]["estado"]==""|| $asesores[$dni[$dni[$x]]][$mes.$h]["estado"]==" "){
                        $asesores[$dni[$dni[$x]]][$mes.$h]["estado"]="SIN ESTADO";
                    }
                    if(!isset($asesores[$dni[$dni[$x]]][$mes.$h]["cargo"])){
                        $asesores[$dni[$dni[$x]]][$mes.$h]["cargo"]="CARGO NO ENCONTRADO";
                    }
                    echo "<tr $s> 
                    <td id='_____'><p>".$dni[$dni[$x]]."</p></td>
                    <td>".$mes.$h."</td>
                    <td>".$asesores[$dni[$dni[$x]]][$mes.$h]["estado"]."</td>
                    <td>".$asesores[$dni[$dni[$x]]][$mes.$h]["asistencia"]."</td>
                    <td>".$asesores[$dni[$dni[$x]]][$mes.$h]["cargo"]."</td>
                    <td>".$asesores[$dni[$dni[$x]]][$mes.$h]["total"]."</td><td></td>";
                    for($z=0;$z<count($tipificaciones);$z++){
                        echo "<td>".$asesores[$dni[$dni[$x]]][$mes.$h]["tipif"][$tipificaciones[$z]]."</td>";
                    }
                    echo "</tr>";
                }
            }
        } 
    }
    if($q=="buscarDetaTotalLlamadas"){
        $cn = Db::conectar();
        $mes=date("Y-m-");
        $hoy=date("d");
        $dni=array();
        $asesores=array();
        $ante="";
        $inicio=0;
        $cargo=" cargo.cargo in ('ASESOR DE VENTAS','OJT','CAPACITACION','POSTULANTE') ";
        if(isset($_POST["cargo"])){
            $cargo= " cargo.idcargo = ".$_POST["cargo"];
        }
        $tipificaciones=['VENTA','NO INTERESADO','VOLVER A LLAMAR','NO CALIFICA','NO LLAMAR','PROVINCIA','NUMERO EQUIVOCADO','USUARIO CONTESTA, NO ES EL TITULAR','TITULAR FALLECIDO','SU LINEA ES COORPORATIVA','NO CONTESTA','NUMERO NO EXISTE','BUZON DE VOZ','LINEA SUPENDIDA / BLOQUEADA','NUMERO OCUPADO','CLIENTE RECHAZA LLAMADA'];
        $consulta=mysqli_query($cn,"SELECT id, concat(nombre,' ', apellido) as nombre,estado,cargo FROM trabajador INNER JOIN cargo ON trabajador.idcargo = cargo.idcargo where ".$cargo." order by nombre asc");
        while($x=mysqli_fetch_assoc($consulta)){ 
            $dni[$x['id']]=$x["nombre"];
            $dni[$inicio]=$x['id'];
            $inicio=count($dni)/2;
            if(isset($_POST["fecha"])){
                $asesores[$x["nombre"]][$_POST["fecha"]]["asistencia"]="F";
                $asesores[$x["nombre"]][$_POST["fecha"]]["cargo"]=$x["cargo"];
                $asesores[$x["nombre"]][$_POST["fecha"]]["estado"]=$x["estado"];
                $asesores[$x["nombre"]][$_POST["fecha"]]["total"]=0;
                for($z=0;$z<count($tipificaciones);$z++){
                    $asesores[$x["nombre"]][$_POST["fecha"]]["tipif"][$tipificaciones[$z]]=0;
                }
            }
            else{
                for($y=1;$y<=$hoy;$y++){
                    if(strlen($y)==1){$h="0".$y;}else{$h=$y;}
                    $asesores[$x["nombre"]][$mes.$h]["asistencia"]="F";
                    $asesores[$x["nombre"]][$mes.$h]["cargo"]=$x["cargo"];
                    $asesores[$x["nombre"]][$mes.$h]["estado"]=$x["estado"];
                    $asesores[$x["nombre"]][$mes.$h]["total"]=0;
                    for($z=0;$z<count($tipificaciones);$z++){
                        $asesores[$x["nombre"]][$mes.$h]["tipif"][$tipificaciones[$z]]=0;
                    }
                }
            }
        }
        $dni["OTROS"]="---";
        $dni[$inicio]="OTROS";
        $inicio=count($dni)/2;
        array_push($dni,"OTROS");
        $ante=0;
        $tot=0;
        $nuevos=Array();
        $fecha= ">='".$mes."01'";
        if(isset($_POST["fecha"])){
            $fecha= "='".$_POST["fecha"]."'";
        }
        if($cargo!=" cargo.cargo in ('ASESOR DE VENTAS','OJT','CAPACITACION','POSTULANTE') "){
            $consulta=mysqli_query($cn,"SELECT trabajador.id, concat(nombre,' ', apellido) as nombre,estado, count(*) as total, fecha, tipif1, tipif2, SEC_TO_TIME(sum(fin-inicio)) as 'Total llamado' , trabajador.id, estado, cargo from numerosllamadas inner join trabajador on trabajador.id=numerosllamadas.asesor INNER JOIN cargo ON trabajador.idcargo = cargo.idcargo where tipif1!='' and inicio!=\"00:00:00\" and fecha ".$fecha." and ".$cargo." GROUP by asesor,fecha,tipif2 order by nombre ASC,fecha DESC;");
        }
        else{
            $consulta=mysqli_query($cn,"SELECT trabajador.id, concat(nombre,' ', apellido) as nombre,estado, count(*) as total, fecha, tipif1, tipif2, SEC_TO_TIME(sum(fin-inicio)) as 'Total llamado' , trabajador.id, estado, cargo from numerosllamadas inner join trabajador on trabajador.id=numerosllamadas.asesor INNER JOIN cargo ON trabajador.idcargo = cargo.idcargo where tipif1!='' and inicio!=\"00:00:00\" and fecha ".$fecha." GROUP by asesor,fecha,tipif2 order by nombre ASC,fecha DESC;");
        }
        while($x=mysqli_fetch_array($consulta)){
            if($ante!=$x['id']){
                $ante=$x['id'];
                $tot=0;
            }
            $tot+=$x['total'];
            if(!isset($dni[$x["id"]])){
                array_push($nuevos,$x["nombre"]);
                $dni[$x['id']]=$x["nombre"];
                $dni[$inicio]=$x['id'];
                $inicio=count($dni)/2;
                $asesores[$dni[$x["id"]]][$x["fecha"]]["asistencia"]="F";
                $asesores[$dni[$x["id"]]][$x["fecha"]]["cargo"]=$x["cargo"];
                $asesores[$dni[$x["id"]]][$x["fecha"]]["estado"]=$x["estado"];
                $asesores[$dni[$x["id"]]][$x["fecha"]]["total"]=0;
                for($z=0;$z<count($tipificaciones);$z++){
                    $asesores[$dni[$x["id"]]][$x["fecha"]]["tipif"][$tipificaciones[$z]]=0;
                }
            }
            if($x["tipif2"]==""){$x["tipif2"]="NO TIPIFICADO";}
            $asesores[$dni[$x["id"]]][$x["fecha"]]["tipif"][$x["tipif2"]]=(int)$x["total"];
            $asesores[$dni[$x["id"]]][$x["fecha"]]["total"]=$tot;
        }
        $consulta=mysqli_query($cn,"SELECT * from asistencia where fecha ".$fecha." group by fecha,id_trabajador order by fecha asc;");
        while($x=mysqli_fetch_assoc($consulta)){ 
            if(isset($dni[$x["id_trabajador"]])){
                $asesores[$dni[$x["id_trabajador"]]][$x["fecha"]]["asistencia"]="A";
            }
        }
        // echo json_encode($asesores);
        $i=0;
        $ante=$dni[0];
        // echo "<td rowspan=".($hoy+1).">1</td>";
        for($x=0;$x<count($dni)/2-1;$x++){ 
            for($y=1;$y<=$hoy;$y++){
                if(strlen($y)==1){$h="0".$y;}else{$h=$y;}
                if($dni[$x]=="OTROS"){
                    echo "<tr><td style='background:#fff700'></td><td style='background:#fff700'>OTROS TRABAJADORES</td><td style='background:#fff700' colspan=23></td></tr>";
                    $x++;
                    continue;
                }
                $s="";$tot=0;$cadena="";
                if($ante!=$dni[$x]){
                    $ante=$dni[$x];
                    $i=$i+1;
                    // echo "<td style='border-top: 1px solid black;' rowspan=".($hoy+1).">".($x/$hoy+1)."</td>";
                    $s="style='border-top:1px solid black;'";
                }
                if(isset($asesores[$dni[$dni[$x]]][$mes.$h]["tipif"])){
                    if(!isset($asesores[$dni[$dni[$x]]][$mes.$h]["estado"]) || $asesores[$dni[$dni[$x]]][$mes.$h]["estado"]==""|| $asesores[$dni[$dni[$x]]][$mes.$h]["estado"]==" "){
                        $asesores[$dni[$dni[$x]]][$mes.$h]["estado"]="SIN ESTADO";
                    }
                    if(!isset($asesores[$dni[$dni[$x]]][$mes.$h]["cargo"])){
                        $asesores[$dni[$dni[$x]]][$mes.$h]["cargo"]="CARGO NO ENCONTRADO";
                    }
                    if($asesores[$dni[$dni[$x]]][$mes.$h]["total"]!=0){
                        $s=$s."style='background:green;'";
                    }
                    echo "<tr $s> 
                    <td><p $s>".$dni[$dni[$x]]."</p></td>
                    <td>".$mes.$h."</td>
                    <td>".$asesores[$dni[$dni[$x]]][$mes.$h]["estado"]."</td>
                    <td>".$asesores[$dni[$dni[$x]]][$mes.$h]["asistencia"]."</td>
                    <td>".$asesores[$dni[$dni[$x]]][$mes.$h]["cargo"]."</td>
                    <td>".$asesores[$dni[$dni[$x]]][$mes.$h]["total"]."</td><td></td>";
                    for($z=0;$z<count($tipificaciones);$z++){
                        echo "<td>".$asesores[$dni[$dni[$x]]][$mes.$h]["tipif"][$tipificaciones[$z]]."</td>";
                    }
                    echo "</tr>";
                }
            }
        } 
    }
    if($q=="calcuregis"){
        $consulta=mysqli_query($cn,"select count(*) as total,tipif1, SEC_TO_TIME(sum(fin-inicio)) as 'llamado' from numerosllamadas where asesor='".strtoupper($_POST["asesor"])."' and tipif1!='' and inicio!='00:00:00' GROUP by tipif1;");
        $totdia=0;
        $tot=0;
        while($x=mysqli_fetch_array($consulta)){
            $x1=mysqli_fetch_array(mysqli_query($cn,"select count(*) as total,tipif1, SEC_TO_TIME(sum(fin-inicio)) as 'llamado' from numerosllamadas where asesor='".strtoupper($_POST["asesor"])."' and inicio!='00:00:00' and tipif1='".$x["tipif1"]."' and fecha='".$hoy."' GROUP by tipif1"))
        ?>
        <tr>
            <?php 
            if($x["tipif1"]=="Gestionando"){ ?>
                <td>NO TIPIFICADO</td>
                <td><?php echo $x1["total"];?></td>
                <!-- <td>00:00:00</td> -->
                <td><?php echo $x["total"];?></td>
                <!-- <td>00:00:00</td> -->
            <?php } else{ ?> 
                <td><?php echo $x["tipif1"];?></td> 
                <td><?php echo $x1["total"];?></td>
                <!-- <td><?php echo $x1["llamado"]; ?></td> -->
                <td><?php echo $x["total"];?></td>
                <!-- <td><?php echo $x["llamado"];?></td> -->
            <?php } ?>
        </tr>
        <?php 
         $totdia+=$x1["total"];
         $tot+=$x["total"];
        }
        ?>
        <tr>
            <td style="border: red solid 1px;">TOTAL LLAMADAS</td>
            <td style="border: red solid 1px;"><?php echo $totdia;?></td>
            <td style="border: red solid 1px;"><?php echo $tot;?></td>
        </tr>
        <?php
    }
    if($q=="obtener"){
        $consulta = mysqli_query($cn,"select numerosllamadas.*,concat(trabajador.nombre,' ',trabajador.apellido) as nombre from numerosllamadas inner join trabajador on trabajador.id=numerosllamadas.asesor where asesor='".($_POST["asesor"])."' and tipif1!='' order by fecha,fin");
        $i=0;
        while($x=mysqli_fetch_array($consulta)){
            $i++;
        ?>
        <tr>
            <td><?php echo $i?></td>
            <td><?php echo $x["cliente"];?></td>
            <td><?php echo $x["dni"];?></td>
            <td><?php echo $x["referencia"];?></td>
            <?php
                if($x["tipif1"]=="Gestionando"){ echo "<td>NO TIPIFICADO</td><td>---</td>"; }
                else{ echo "<td>".$x["tipif1"]."</td><td>".$x["tipif2"]."</td>";} 
            ?>
            <td><?php echo $x["fecha"]; ?></td>
            <td><?php echo $x["nombre"]; ?></td>
        </tr>
        <?php }
    }
}
else{
    echo "No puedes estar aquí".$_POST["q"];
}
?>