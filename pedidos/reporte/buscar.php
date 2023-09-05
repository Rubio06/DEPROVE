<?php
    include ("../../coneccion.php");
    $cn = Db::conectar();
    $mes=date("Y-m-");
    $hoy=date("d");
    $dni=array();
    $asesores=array();
    $inicioOtros=0;
    $ante="";
    $inicio=0;
    $otros=0;
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
        
        if(isset($_POST["fecha"])){
            
        }
        if(!isset($dni[$x["id"]])){
            $inicioOtros=0;
            array_push($nuevos,$x["nombre"]);
            $dni[$x['id']]=$x["nombre"];
            $dni[$inicio]=$x['id'];
            $inicio=count($dni)/2;
            $asesores[$dni[$x["id"]]]=Array();
            $asesores[$dni[$x["id"]]][0]["fecha"]=$x["fecha"];
            $asesores[$dni[$x["id"]]][0]["asistencia"]="F";
            $asesores[$dni[$x["id"]]][0]["cargo"]=$x["cargo"];
            $asesores[$dni[$x["id"]]][0]["estado"]=$x["estado"];
            $asesores[$dni[$x["id"]]][0]["total"]=0;
        }
        if(isset($asesores[$dni[$x["id"]]][count($asesores[$dni[$x["id"]]])-1]["fecha"])&&$asesores[$dni[$x["id"]]][count($asesores[$dni[$x["id"]]])-1]["fecha"]!=$x["fecha"]){
            $tot=0;
            $tot+=$x['total'];
            $asesores[$dni[$x["id"]]][count($asesores[$dni[$x["id"]]])]["fecha"]=$x["fecha"];
            $asesores[$dni[$x["id"]]][count($asesores[$dni[$x["id"]]])-1]["asistencia"]="F";
            $asesores[$dni[$x["id"]]][count($asesores[$dni[$x["id"]]])-1]["cargo"]=$x["cargo"];
            $asesores[$dni[$x["id"]]][count($asesores[$dni[$x["id"]]])-1]["estado"]=$x["estado"];
            $asesores[$dni[$x["id"]]][count($asesores[$dni[$x["id"]]])-1]["total"]=0;
        }
        if(!isset($asesores[$dni[$x["id"]]][(count($asesores[$dni[$x["id"]]])-1)]["tipif"])){
            for($z=0;$z<count($tipificaciones);$z++){
                $asesores[$dni[$x["id"]]][(count($asesores[$dni[$x["id"]]])-1)]["tipif"][$tipificaciones[$z]]=0;
            }
            if($x["tipif2"]==""){$x["tipif2"]="NO TIPIFICADO";}
            $asesores[$dni[$x["id"]]][(count($asesores[$dni[$x["id"]]])-1)]["tipif"][$x["tipif2"]]=(int)$x["total"];
            $asesores[$dni[$x["id"]]][(count($asesores[$dni[$x["id"]]])-1)]["total"]=$tot;
            $inicioOtros++;
        }
        else{
            if($x["tipif2"]==""){$x["tipif2"]="NO TIPIFICADO";}
            $asesores[$dni[$x["id"]]][(count($asesores[$dni[$x["id"]]])-1)]["tipif"][$x["tipif2"]]=(int)$x["total"];
            $asesores[$dni[$x["id"]]][(count($asesores[$dni[$x["id"]]])-1)]["total"]=$tot;
        }
    }
    $consulta=mysqli_query($cn,"SELECT * from asistencia where fecha ".$fecha." group by fecha,id_trabajador order by fecha asc;");
    while($x=mysqli_fetch_assoc($consulta)){ 
        if(isset($dni[$x["id_trabajador"]])){
            $asesores[$dni[$x["id_trabajador"]]][$x["fecha"]]["asistencia"]="A";
        }
    }
    // echo json_encode([$asesores,$dni]);
    $i=0;
    $ante=$dni[0];
    // echo "<td rowspan=".($hoy+1).">1</td>";
    for($x=0;$x<count($dni)/2;$x++){ 
        if($dni[$x]=="OTROS"){
            echo "<tr><td style='background:#fff700'>OTROS TRABAJADORES</td><td style='background:#fff700' colspan=23></td></tr>";
            $otros=1;
            $x++;            
             continue;
        }
        if($otros!=0){
            if(strlen($y)==1){$h="0".$y;}else{$h=$y;}
            // echo "<td style='border-top:1px solid black;left:-50px;' rowspan=".(count($asesores[$dni[$dni[$x]]])+1).">".($x)."</td></tr>";
            // echo "<td>".json_encode($asesores[$dni[$dni[$x]]])."</td> </tr>";
            $s="";
            echo "<td style='' >".json_encode($asesores[$dni[$dni[$x]]])."</td>";
            for($fechaDir=0;$fechaDir<count($asesores[$dni[$dni[$x]]]);$fechaDir++){
                $s="";
                if(isset($asesores[$dni[$dni[$x]]][$fechaDir]["tipif"])){
                    if($ante!=$dni[$x]){
                        $ante=$dni[$x];
                        $s="style='border-top:1px solid black;'";
                    }
                    if(!isset($asesores[$dni[$dni[$x]]][$fechaDir]["estado"]) || $asesores[$dni[$dni[$x]]][$fechaDir]["estado"]==""|| $asesores[$dni[$dni[$x]]][$fechaDir]["estado"]==" "){
                        $asesores[$dni[$dni[$x]]][$fechaDir]["estado"]="SIN ESTADO";
                    }
                    if(!isset($asesores[$dni[$dni[$x]]][$fechaDir]["cargo"])){
                        $asesores[$dni[$dni[$x]]][$fechaDir]["cargo"]="CARGO NO ENCONTRADO";
                    }
                    echo "<tr $s> 
                    <td><p>".$dni[$dni[$x]]."</p></td>
                    <td>".$asesores[$dni[$dni[$x]]][$fechaDir]["fecha"]."</td>
                    <td>".$asesores[$dni[$dni[$x]]][$fechaDir]["estado"]."</td>
                    <td>".$asesores[$dni[$dni[$x]]][$fechaDir]["asistencia"]."</td>
                    <td>".$asesores[$dni[$dni[$x]]][$fechaDir]["cargo"]."</td>
                    <td>".$asesores[$dni[$dni[$x]]][$fechaDir]["total"]."</td><td></td>";
                    for($z=0;$z<count($tipificaciones);$z++){
                        echo "<td>".$asesores[$dni[$dni[$x]]][$fechaDir]["tipif"][$tipificaciones[$z]]."</td>";
                    }
                    echo "</tr>";
                }
            }
            $otros++;
        }
        else{
            for($y=1;$y<=$hoy;$y++){
                if(strlen($y)==1){$h="0".$y;}else{$h=$y;}
                $s="";
                if(isset($asesores[$dni[$dni[$x]]][$mes.$h]["tipif"])){
                    if($otros==1){
                        // echo "<td style='border-top:1px solid black;left:-50px;' rowspan=2>".$x."</td></tr>";
                        echo "<td>".json_encode([$dni[$dni[$x]]])."</td> </tr>";
                    }
                    else if($ante!=$dni[$x]){
                        $ante=$dni[$x];
                        if($otros==0){
                            // echo "<td style='border-top:1px solid black;left:-50px;' rowspan=".($hoy+1).">".($x+1)."</td>";
                        }
                        $s="style='border-top:1px solid black;'";
                    }
                    if(!isset($asesores[$dni[$dni[$x]]][$mes.$h]["estado"]) || $asesores[$dni[$dni[$x]]][$mes.$h]["estado"]==""|| $asesores[$dni[$dni[$x]]][$mes.$h]["estado"]==" "){
                        $asesores[$dni[$dni[$x]]][$mes.$h]["estado"]="SIN ESTADO";
                    }
                    if(!isset($asesores[$dni[$dni[$x]]][$mes.$h]["cargo"])){
                        $asesores[$dni[$dni[$x]]][$mes.$h]["cargo"]="CARGO NO ENCONTRADO";
                    }
                    echo "<tr $s> 
                    <td><p>".$dni[$dni[$x]]."</p></td>
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
?>