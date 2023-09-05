<?php 
include ("../coneccion.php");
header('Content-Type: text/html; charset=UTF-8');
$cn = Db::conectar();
session_start();
if(isset($_POST["q"])){
    date_default_timezone_set('America/Lima');
    $hora = date("h:i:s");
    $hoy= date("Y-m-d");
    $tipif1=["CONTACTO EFECTIVO","CONTACTO NO EFECTIVO","NO CONTACTO","NO TIPIFICADO","CONTACTO EFECTIVO"=>[0,0],"CONTACTO NO EFECTIVO"=>[0,0],"NO CONTACTO"=>[0,0],"NO TIPIFICADO"=>[0,0]];
    $tipificaciones=['VENTA','NO INTERESADO','VOLVER A LLAMAR','NO CALIFICA','NO LLAMAR','PROVINCIA','NUMERO EQUIVOCADO','USUARIO CONTESTA, NO ES EL TITULAR','TITULAR FALLECIDO','SU LINEA ES COORPORATIVA','NO CONTESTA','NUMERO NO EXISTE','BUZON DE VOZ','LINEA SUPENDIDA / BLOQUEADA','NUMERO OCUPADO','CLIENTE RECHAZA LLAMADA'];
    $q=$_POST["q"];
    if($q=="bajar_data"){
        $arra=[];
        $arra=mysqli_fetch_array(mysqli_query($cn,"select * from numerosllamadas where tipif1='' ORDER BY RAND() limit 1;"));
        if($arra!=null && $arra!=""){
            mysqli_query($cn,"update numerosllamadas set tipif1='Gestionando', fecha='".$hoy."', asesor='".$_SESSION["id"]."' where id=".$arra[0]);
        }
        echo json_encode($arra);
    }
    else if($q=="subir_data"){
        mysqli_query($cn,"update numerosllamadas set tipif1='".$_POST["tipif1"]."', tipif2='".$_POST["tipif2"]."', fin='".$hora."' where id=".$_POST["id"]);
    }
    else if($q=="inicioLlamada"){
        mysqli_query($cn,"update numerosllamadas set inicio='$hora' where id=".$_POST["id"]." and inicio='00:00:00'");
    }
    else if($q=="buscarDetaTotalLlamadas"){
        $cn = Db::conectar();
        $mes=date("Y-m-");
        $hoy=date("d");
        $dni=array();
        $asesores=array();
        $ante="";
        $extra="";
        $inicio=0;
        $tabla="";
        $cargo=" cargo.cargo in ('ASESOR DE VENTAS','OJT','SELECCION')";
        if(isset($_POST["cargo"])){
            $cargo= " cargo.idcargo = ".$_POST["cargo"];
        }
        if(isset($_POST["sede"])){
            $extra=$extra." and idsede='".$_POST["sede"]."'";
        }
        if(isset($_POST["estado"])){
            $extra=$extra." and estado='".$_POST["estado"]."'";
        }
        $consulta=mysqli_query($cn,"SELECT id,reclutadora,jefe as 'coordinador', concat(nombre,' ', apellido) as nombre,estado,cargo FROM trabajador INNER JOIN cargo ON trabajador.idcargo = cargo.idcargo where ".$cargo. $extra." order by nombre asc");
        while($x=mysqli_fetch_assoc($consulta)){ 
            $dni[$x['id']]=$x["nombre"];
            $dni[$inicio]=$x['id'];
            $inicio=count($dni)/2;
            $fecha_asig="";
            for($y=1;$y<=$hoy;$y++){
                if(strlen($y)==1){$fecha_asig=$mes."0".$y;}else{$fecha_asig=$mes.$y;}
                if(isset($_POST["fecha"])){$fecha_asig=$_POST["fecha"];}
                $asesores[$x["nombre"]][$fecha_asig]["asistencia"]="F";
                $asesores[$x["nombre"]][$fecha_asig]["cargo"]=$x["cargo"];
                $asesores[$x["nombre"]][$fecha_asig]["estado"]=$x["estado"];
                $asesores[$x["nombre"]][$fecha_asig]["reclutador"]=$x["reclutadora"];
                $asesores[$x["nombre"]][$fecha_asig]["coordinador"]=$x["coordinador"];
                $asesores[$x["nombre"]][$fecha_asig]["total"]=0;
                for($z=0;$z<count($tipificaciones);$z++){
                    $asesores[$x["nombre"]][$fecha_asig]["tipif"][$tipificaciones[$z]]=0;
                    // if(date("N",strtotime($fecha_asig))!=7){}
                }
                if(isset($_POST["fecha"])){break;}
            }
        }
        $dni["OTROS"]="---";
        $dni[$inicio]="OTROS";
        array_push($dni,"OTROS");
        $inicio=count($dni)/2;
        $ante=0;
        $tot=0;
        $nuevos=Array();
        $asistencia=['F','A'];
        if(isset($_POST["asistencia"])){
            $asistencia=[$_POST["asistencia"]];
        }
        $fecha= ">='".$mes."01'";
        if(isset($_POST["fecha"])){
            $fecha= "='".$_POST["fecha"]."'";
        }
        $consulta=mysqli_query($cn,"SELECT trabajador.id,reclutadora,jefe as 'coordinador', concat(nombre,' ', apellido) as nombre,estado, count(*) as total, fecha, tipif1, tipif2, SEC_TO_TIME(sum(fin-inicio)) as 'Total llamado' , trabajador.id, estado, cargo from numerosllamadas inner join trabajador on trabajador.id=numerosllamadas.asesor INNER JOIN cargo ON trabajador.idcargo = cargo.idcargo where tipif1!='' and inicio!=\"00:00:00\" and fecha ".$fecha.$extra." GROUP by asesor,fecha,tipif2 order by nombre ASC,fecha DESC;");
        if($cargo!=" cargo.cargo in ('ASESOR DE VENTAS','OJT','CAPACITACION','SELECCION')"){
            // $consulta=mysqli_query($cn,"SELECT trabajador.id,reclutadora,jefe as 'coordinador', concat(nombre,' ', apellido) as nombre,estado, count(*) as total, fecha, tipif1, tipif2, SEC_TO_TIME(sum(fin-inicio)) as 'Total llamado' , trabajador.id, estado, cargo from numerosllamadas inner join trabajador on trabajador.id=numerosllamadas.asesor INNER JOIN cargo ON trabajador.idcargo = cargo.idcargo where tipif1!='' and inicio!=\"00:00:00\" and fecha ".$fecha." and ".$cargo." GROUP by asesor,fecha,tipif2 order by nombre ASC,fecha DESC;");
        }else{}
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
                $asesores[$dni[$x["id"]]][$x["fecha"]]["reclutador"]=$x["reclutadora"];
                $asesores[$dni[$x["id"]]][$x["fecha"]]["coordinador"]=$x["coordinador"];
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
        // $tabla=$tabla. "<td rowspan=".($hoy+1).">1</td>";
        $fondo="";
        $iniciofor=(int)((int)$_POST["indice"]*(int)$_POST["cantidadamostrar"]);
        $maximoamostrar=(int)(((int)$_POST["indice"]+1)*(int)$_POST["cantidadamostrar"])-1;
        if($maximoamostrar>count($asesores)){
            $maximoamostrar=count($asesores);
        }
        for($x=$iniciofor;$x<=$maximoamostrar;$x++){
            if($dni[$x]=="OTROS"){
                $tabla=$tabla."<tr><td style='background:#fff700'>OTROS TRABAJADORES</td><td style='background:#fff700' colspan=27></td></tr>";
                // $x++;
                continue;
                $fondo="border-top:1px solid black;";
            }
            for($y=1;$y<=$hoy;$y++){
                if(strlen($y)==1){$h="0".$y;}else{$h=$y;}
                if(isset($_POST["fecha"])){
                    $h=date("d",strtotime($_POST["fecha"]));
                }
                $llama="";
                $s="";$tot=0;$cadena="";
                $tabla=$tabla. "<tr style='display:none;'>";
                $tabla=$tabla. "<td id='primero del ".$x."'>".json_encode($dni[$dni[$x]])."</td>";
                if(isset($asesores[$dni[$dni[$x]]][$mes.$h]["tipif"])){
                    $tabla=$tabla. "<td id='segundo del ".$x."'>".json_encode($asesores[$dni[$dni[$x]]][$mes.$h])."</td>";
                    if(in_array($asesores[$dni[$dni[$x]]][$mes.$h]["asistencia"],$asistencia)){
                        $tabla=$tabla. "<td id='tercero del ".$x."'>".json_encode($asesores[$dni[$dni[$x]]][$mes.$h]["tipif"])."</td>";
                        if($ante!=$dni[$x]){
                            $ante=$dni[$x];
                            $i=$i+1;
                            // $tabla=$tabla. "<td style='border-top: 1px solid black;' rowspan=".($hoy+1).">".($x/$hoy+1)."</td>";
                            $s="border-top:1px solid black;";
                        }
                        if(!isset($asesores[$dni[$dni[$x]]][$mes.$h]["estado"]) || $asesores[$dni[$dni[$x]]][$mes.$h]["estado"]==""|| $asesores[$dni[$dni[$x]]][$mes.$h]["estado"]==" "){
                            $asesores[$dni[$dni[$x]]][$mes.$h]["estado"]="SIN ESTADO";
                        }
                        if(!isset($asesores[$dni[$dni[$x]]][$mes.$h]["cargo"])){
                            $asesores[$dni[$dni[$x]]][$mes.$h]["cargo"]="CARGO NO ENCONTRADO";
                        }
                        if($asesores[$dni[$dni[$x]]][$mes.$h]["total"]!=0){
                            $llama=" background:#337afb;";
                        }
                        $tabla=$tabla. "<tr style='$s $fondo $llama'> 
                        <td><p style='$llama'>".$dni[$dni[$x]]."</p></td>
                        <td>".$mes.$h."</td>
                        <td>".$asesores[$dni[$dni[$x]]][$mes.$h]["estado"]."</td>
                        <td>".$asesores[$dni[$dni[$x]]][$mes.$h]["asistencia"]."</td>
                        <td>".$asesores[$dni[$dni[$x]]][$mes.$h]["cargo"]."</td>
                        <td>".$asesores[$dni[$dni[$x]]][$mes.$h]["reclutador"]."</td>
                        <td>".$asesores[$dni[$dni[$x]]][$mes.$h]["coordinador"]."</td>
                        <td>".$asesores[$dni[$dni[$x]]][$mes.$h]["total"]."</td><td></td><td></td><td></td><td></td>";
                        for($z=0;$z<count($tipificaciones);$z++){
                            $tabla=$tabla. "<td>".$asesores[$dni[$dni[$x]]][$mes.$h]["tipif"][$tipificaciones[$z]]."</td>";
                        }
                        $tabla=$tabla. "</tr>";
                    }
                }
                if(isset($_POST["fecha"])){
                    break;
                }
            }
        } 
        $paginas="";
        for($x=0;$x<(count($asesores)/$_POST["cantidadamostrar"]);$x++){
            if(($x+1)>(count($asesores)/$_POST["cantidadamostrar"])){
                $paginas=$paginas."<a href=\"javascript:cargarTabla(".($x+1).")\">".($x+1)." <p>(".($x*$_POST["cantidadamostrar"]+1)."-".(count($asesores)).")</p></a>"; 
            } else{
                $paginas=$paginas."<a href=\"javascript:cargarTabla(".($x+1).")\">".($x+1)." <p>(".($x*$_POST["cantidadamostrar"]+1)."-".(($x+1)*$_POST["cantidadamostrar"]).")</p></a>";
            }
        }
        echo json_encode([$paginas,$tabla,count($asesores),$asesores,$dni]);
    }
    else if($q=="calcuregis"){
        $consulta=mysqli_query($cn,"SELECT count(*) as total,tipif1, asesor, SEC_TO_TIME(sum(fin-inicio)) as 'llamado',sum(if(fecha='".$hoy."',1,0)) as 'hoy' from numerosllamadas where asesor='".($_SESSION["id"])."' and tipif1!='' GROUP by tipif1;");
        $totdia=0;
        $tot=0;
        while($x=mysqli_fetch_array($consulta)){
            if($x["tipif1"]=="Gestionando"){$x["tipif1"]="NO TIPIFICADO";}
            $tipif1[$x["tipif1"]][0]=$x["hoy"];
            $tipif1[$x["tipif1"]][1]=$x["total"];
            $totdia+=$x1["total"];
            $tot+=$x["total"];
        }
        for ($i=0; $i < count($tipif1)/2 ; $i++) { ?>
        <tr>
            <td><?php echo $tipif1[$i];?></td> 
            <td><?php echo $tipif1[$tipif1[$i]][0];?></td>
            <td><?php echo $tipif1[$tipif1[$i]][1];?></td>
        </tr> 
        <?php } //echo json_encode($tipif1); ?>
        <tr>
            <td style="border: red solid 1px;">TOTAL LLAMADAS</td>
            <td style="border: red solid 1px;"><?php echo $totdia;?></td>
            <td style="border: red solid 1px;"><?php echo $tot;?></td>
        </tr>
        <?php
    }
    else if($q=="SubirPedidos"){
        if(!isset($_SESSION["coordinador"])){
            $_SESSION["coordinador"]=0;
            if($_SESSION["cargo"]=="CAPACITADOR"||$_SESSION["cargo"]=="COORDINADOE"){
                $_SESSION["coordinador"]=$_SESSION["id"];
            }
        }
        $fecha=date('Y-m-d');
        $hora=date('H:i:s');
        $sql1="INSERT INTO pedido VALUES (null,
        '$_POST[sec]',
        '$_POST[empresa]',
        '$fecha',
        '$hora',
        '$_POST[distrito]',
        '$_POST[direccion]',
        '$_POST[referencia]',
        '$_POST[fechaPactada]',
        '$_POST[coorx]','',
        '$_POST[delivery]',
        '$_POST[asumeAses]',
        '$_POST[asumeCoord]',
        '$_POST[asumeEmpr]',
        '$_POST[asumeMotori]',
        '$_POST[cliente]',
        '$_POST[dni]',
        '$_POST[telf1]',
        '$_POST[telf2]',
        '$_POST[correo]',
        '$_POST[observacionCliente]',
        '$_POST[tipfAlma]',
        '$_POST[fechaAlma]',
        '$_POST[tipAfili]',
        '$_POST[fechaAfili]',
        '$_POST[obsAfili]',
        '$_POST[tipfVali]',
        '$_POST[fechaVali]',
        '$_POST[feDiferidoVali]',
        '$_POST[obsVali]',
        '$_POST[tipfDes]',
        '$_POST[feEntraDes]',
        '$_POST[feReproDes]',
        '$_POST[motoDes]',
        '$_POST[xDes]',
        '$_POST[yDes]',
        '$_POST[obsDes]',
        '$_POST[tipActi]',
        '$_POST[feActiClaro]',
        '$_POST[feEntreActi]',
        '$_POST[reActi]',
        '$_POST[obsActi]',
        '$_POST[tipHfc]',
        '$_POST[feContratoHfc]',
        '$_POST[feInsHfc]',
        '$_POST[obsHfc]',
        '$_SESSION[id]',
        '$_SESSION[coordinador]',
        ''
        )";
        $consulta=mysqli_query($cn,$sql1);
        $consulta2=1;
        $consulta1=mysqli_fetch_assoc(mysqli_query($cn,"SELECT id FROM pedido where fecha='$fecha' and hora='$hora' and idasesor='$_SESSION[id]'"));
        $datos=json_decode($_POST['pedidosTotal']);
        for($i=0;$i<count($datos);$i++){
            // PesoVenta
            // seleccionTipoPlan
            // seleccionPlan
            // cargofijoPlan
            // cuotaPlan
            // cuotasPlan
            // lineaportarPlan
            // operadorPlan 
            // rentaadelantadaPlan
            // imeiPlan" +n).value);
            // inicialPlan
            // imeiSisacPlan
            // imeiAreaPlan
            // iccPlan
            // precioPlan
            // iccSisacPlan
            // iccAreaPlan
            $sql2="INSERT INTO detallepedido VALUES (null,
            '".$datos[$i][2]."','',
            '".$datos[$i][3]."',
            '".$datos[$i][4]."',
            '".$datos[$i][5]."',
            '".$datos[$i][6]."',
            '".$datos[$i][7]."',
            '".$datos[$i][8]."',
            '".$datos[$i][9]."',
            '".$datos[$i][10]."',
            '".$datos[$i][11]."',
            '". str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $datos[$i][12]) ."',
            '".$datos[$i][13]."',
            '".$datos[$i][14]."',
            '".$datos[$i][15]."',
            '". str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $datos[$i][16]) ."',
            '".$consulta1["id"]."'
            );";
            $consulta2=mysqli_query($cn,$sql2);
        }
        echo $consulta." - ".$consulta2;
    }
    else if($q=="obtener"){
        $consulta = mysqli_query($cn,"select numerosllamadas.*,concat(trabajador.nombre,' ',trabajador.apellido) as nombre from numerosllamadas inner join trabajador on trabajador.id=numerosllamadas.asesor where asesor='".($_SESSION["id"])."' and tipif1!='' order by fecha,fin");
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
    else if($q=="agregarOperador"){
        mysqli_query($cn,"INSERT INTO operador values(null,'".$_POST["operador"]."');");
        $resultado = mysqli_query($cn,"SELECT * from operador;"); 
        $operadores="";
        while($mostrar = mysqli_fetch_array($resultado)){
            $s="";
            // if($mostrar['nombre']==$_POST["operador"]){$s="selected";}
            echo "<option $s value=\"".$mostrar['id']."\">".$mostrar['nombre']."</option>";
        } 
    }
    else{
        echo "Error ".$_POST["q"];
    }
}
else if(isset($_POST["editPedidos"])){
    unset($_POST["editPedidos"]);
    $sql="update pedido set ";
    $llaves=array_keys($_POST);
    for($i=0;$i<count($llaves)-1;$i++){
        if($sql != "update pedido set "){$sql=$sql." , ";}
        $sql=$sql. $llaves[$i]." = '".$_POST[$llaves[$i]]."' ";
    }
    if($sql != "update pedido set "){
        $sql=$sql."where id=".$_POST["id_edit"];
        mysqli_query($cn,$sql);
    }
    else{
        $sql="";
    }
    echo $sql;
}
else if(isset($_POST["detaPedidos"])){
    $coor=Array();
    $coordinadoresSql = mysqli_query($cn,"SELECT t.id, concat(t.nombre,' ',t.apellido) as nombre FROM usuario u inner join trabajador t on t.id=u.trabajador inner join cargo ca on ca.idcargo=t.idcargo WHERE ca.cargo in ('COORDINADOR','CAPACITADOR')");
    while ($xx=mysqli_fetch_assoc($coordinadoresSql)) {
        $coor[$xx["id"]]=$xx["nombre"];
    }
    switch ($_SESSION["cargo"]) {
        case "SUPERVISOR ACTIVACION":
            $rsListar = "SELECT pedido.id, pedido.sec,pedido.empresa 'EMPRESA EVALUADORA', concat(fecha,' ',hora) 'FECHA DE REGISTRO', feEntraDes 'FECHA DE ENTREGA', cliente, dni, telref1, tipfDes 'DESPACHO', tipActi 'ACTIVACIÓN', tipAfili 'AFILIADOR', tipfVali 'VALIDACIÓN',tipHfc 'HFC', concat(ase.nombre,' ',ase.apellido) 'ASESOR',if(id_coord=0,'sin coordinador',id_coord) 'COORDINADOR' FROM pedido inner join trabajador ase on pedido.idasesor= ase.id";
            break;
        case "SUPERVISOR JEFE DE OPERACIONES":
            $rsListar = "SELECT pedido.id, concat(fecha,' ',hora) 'FECHA DE REGISTRO', 0 'PESO VENTA','' as 'PLAN',tipfDes 'DESPACHO', tipActi 'ACTIVACIÓN', tipAfili 'AFILIADOR', tipfVali 'VALIDACIÓN',tipHfc 'HFC', motoDes 'MOTORIZADO', distrito,pedido.direccion,concat(ase.nombre,' ',ase.apellido) 'ASESOR',if(id_coord=0,'sin coordinador',id_coord) 'COORDINADOR' FROM pedido inner join trabajador ase on pedido.idasesor= ase.id";
            break;
        case 'SUPERVISOR DESPACHO':
            $rsListar = "SELECT pedido.id, concat(fecha,' ',hora) 'FECHA DE REGISTRO', motoDes 'MOTORIZADO', pedido.distrito, feEntraDes 'FECHA DE ENTREGA', cliente, dni, telref1, telref2, tipfAlma 'ALMACEN', tipAfili 'AFILIADOR', tipfVali 'VALIDACIÓN', tipfDes 'DESPACHO', feReproDes 'FECHA DE REPROGRAMACIÓN', tipActi 'ACTIVACIÓN', tipHfc 'HFC',concat(ase.nombre,' ',ase.apellido) 'ASESOR',if(id_coord=0,'sin coordinador',id_coord) 'COORDINADOR',feReproDes 'FECHA DE REPROGRAMACIÓN', fechapactada FROM pedido inner join trabajador ase on pedido.idasesor= ase.id ";
        break;
        case str_contains($_SESSION["cargo"],'SUPERVISOR'):
            $rsListar = "SELECT pedido.id, pedido.empresa 'EMPRESA EVALUADORA', concat(fecha,' ',hora) 'FECHA DE REGISTRO', feEntraDes 'FECHA DE ENTREGA', feReproDes 'FECHA DE REPROGRAMACIÓN', fechapactada, delivery, asumeases 'ASUME ASESOR', asumecoord 'ASUME COORDINADOR', cliente, dni, telref1, telref2, correo, tipfAlma 'ALMACEN', tipAfili 'AFILIADOR', tipfVali 'VALIDACIÓN', tipfDes 'DESPACHO', feReproDes 'FECHA DE REPROGRAMACIÓN', tipActi 'ACTIVACIÓN', tipHfc 'HFC', concat(ase.nombre,' ',ase.apellido) 'ASESOR',if(id_coord=0,'sin coordinador',id_coord) 'COORDINADOR' FROM pedido inner join trabajador ase on pedido.idasesor= ase.id";
            break;
        case 'COORDINADOR':
        case 'CAPACITADOR':
            $rsListar = "SELECT pedido.id, pedido.empresa 'EMPRESA EVALUADORA', concat(fecha,' ',hora) 'FECHA DE REGISTRO', feEntraDes 'FECHA DE ENTREGA', feReproDes 'FECHA DE REPROGRAMACIÓN', fechapactada, delivery, asumeases 'ASUME ASESOR', asumecoord 'ASUME COORDINADOR', cliente, dni, telref1, telref2, correo, tipfAlma 'ALMACEN', tipAfili 'AFILIADOR', tipfVali 'VALIDACIÓN', tipfDes 'DESPACHO', feReproDes 'FECHA DE REPROGRAMACIÓN', tipActi 'ACTIVACIÓN', tipHfc 'HFC', concat(ase.nombre,' ',ase.apellido) 'ASESOR',if(id_coord=0,'sin coordinador',id_coord) 'COORDINADOR' FROM pedido inner join trabajador ase on pedido.idasesor= ase.id where id_coord=$_SESSION[id] or ase.id=$_SESSION[id]";
            break;
        default:
            $rsListar = "SELECT pedido.id, pedido.empresa 'EMPRESA EVALUADORA', concat(fecha,' ',hora) 'FECHA DE REGISTRO', feEntraDes 'FECHA DE ENTREGA', feReproDes 'FECHA DE REPROGRAMACIÓN', fechapactada, delivery, asumeases 'ASUME ASESOR', asumecoord 'ASUME COORDINADOR', cliente, dni, telref1, telref2, correo, tipfAlma 'ALMACEN', tipAfili 'AFILIADOR', tipfVali 'VALIDACIÓN', tipfDes 'DESPACHO', feReproDes 'FECHA DE REPROGRAMACIÓN', tipActi 'ACTIVACIÓN', tipHfc 'HFC', concat(ase.nombre,' ',ase.apellido) 'ASESOR',if(id_coord=0,'sin coordinador',id_coord) 'COORDINADOR' FROM pedido inner join trabajador ase on pedido.idasesor= ase.id where ase.id=$_SESSION[id]";
            break;
    }
    $listar = mysqli_query($cn,$rsListar." order by id desc");
    $prim=mysqli_fetch_assoc($listar); 
    $encabezados=array_keys($prim);
    if($prim!=null){ ?>
        <tr ondblclick="abrirdeta(<?php echo $prim['id']; ?>)">
            <?php
            for($i=0;$i<count($encabezados);$i++){
                if($encabezados[$i]=="COORDINADOR" && isset($rslistar["COORDINADOR"])&&isset($coor[$prim["COORDINADOR"]])){
                    echo '<td>'.$coor[$prim["COORDINADOR"]].'</td>';
                }
                else{
                    echo '<td>'.$prim[$encabezados[$i]].'</td>';
                }
            }
        echo '</tr>';
        while($x=mysqli_fetch_assoc($listar)){ 
            echo "<tr ondblclick=\"abrirdeta($x[id])\">";
                $max=sizeof($x);
                for($i=0;$i<$max;$i++){
                    if($encabezados[$i]=="COORDINADOR" && isset($x["COORDINADOR"])&&isset($coor[$x["COORDINADOR"]])){
                        echo '<td class="datos1">'.$coor[$x["COORDINADOR"]].'</td>';
                    }
                    else{
                        echo '<td class="datos1">'.$x[$encabezados[$i]].'</td>';
                    }
                }
            echo '</tr>'; 
        } ?>
    <?php }else{
        echo "<tr style='width:100%;color:red;line-height:150px;background:#c2c2c2;text-align:center;'>USTED NO TIENE NINGUNA FICHA GRABADA</tr>";
    }
}
else{
    echo "No puedes estar aquí";
}
?>