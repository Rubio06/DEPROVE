<?php
require_once("../coneccion.php");
$cn = Db::conectar();
session_start();
date_default_timezone_set('America/Lima');
$planes=Array(Array(),Array(),Array());
$edit['s']=false;
if((isset($_POST["id_ped"]))&&isset($_SESSION["id"])){
    if(!isset($_POST["id_ped"])){
        $_POST["id_ped"]=$_GET["id_ped"];
    }
    $pedido=mysqli_fetch_assoc(mysqli_query($cn,"SELECT * FROM pedido where id='$_POST[id_ped]';"));
    if(($_SESSION["id"]!=$pedido["idasesor"] && $_SESSION["id"]!=$pedido["id_coord"] && !str_contains($_SESSION["cargo"],'SUPERVISOR'))){
        echo "ESTA FICHA NO TE PERTENECE";
        die();
    }
    else{
        $detalle=mysqli_query($cn,"SELECT * from detallepedido where idpedido='$pedido[id]'");
        $i=0;
        while($x=mysqli_fetch_assoc($detalle)){
            $planes[$i]=$x;
            $i++;
        }
        echo "<script>console.log('".json_encode($pedido)."')</script>";
        echo "<script>console.log(".json_encode($planes).")</script>";
    }
    // echo json_encode($_POST);
}
else{
    echo "No hay ninguna ficha seleccionada";
    die();
}
$coordinador= "";
$distritos=['','Ancón','Ate Vitarte','Barranco','Carabayllo','Chaclacayo','Chorrillos','Cieneguilla','Comas','El Agustino','Independencia','Jesús María','La Molina','La Victoria','Lima','Lince','Los Olivos','Lurigancho','Lurín','Magdalena del Mar','Miraflores','Pachacamac','Pucusana','Pueblo Libre','Puente Piedra','Punta Hermosa','Punta Negra','Rímac','San Bartolo','San Borja','San Isidro','San Juan de Lurigancho','San Juan de Miraflores','San Luis','San Martín de Porres','San Miguel','Santa Anita','Santa María del Mar','Santa Rosa','Santiago de Surco','Surquillo','Villa El Salvador','Villa María del Triunfo'];
// echo json_encode($_SESSION);
$edit['almacen']=false;
$edit['afiliacion']=false;
$edit['validacion']=false;
$edit['despacho']=false;
$edit['activacion']=false;
$edit['hfc']=false;
$edit["modifT"]=false;
if(str_contains($_SESSION["cargo"],'SUPERVISOR')){
    $edit['s']=true;
}
if($_SESSION["cargo"]=='SUPERVISOR ALMACEN'){
    $edit['almacen']=true;
}
if($_SESSION["cargo"]=='SUPERVISOR AFILIADOR'){
    $edit['afiliador']=true;
    $edit["modifT"]=true;
}
if($_SESSION["cargo"]=='SUPERVISOR VALIDACION'){
    $edit['validacion']=true;
    $edit["modifT"]=true;
}
if($_SESSION["cargo"]=='SUPERVISOR DESPACHO'){
    $edit['despacho']=true;
}
if($_SESSION["cargo"]=='SUPERVISOR ACTIVACION'){
    $edit['activacion']=true;
    $edit["modifT"]=true;
}
$PesoVenta= Array();
$datosPedidos = Array();
$nombresPedidos = Array();
$nombresPedidos[0]="";
$select_planes=Array();
$fecha=date("Y-m", strtotime($pedido["fecha"]));
$resultado = mysqli_query($cn,"SELECT pesoventa.id,concat(categoria, ' ', planes.plan) as plan,nombre,mes,pesoventa,modo_venta from pesoventa inner join planes on pesoventa.plan=planes.id inner join tipoPlan on planes.tipo=tipoPlan.id where mes='$fecha-01' order by nombre,plan;");
while($mostrar = mysqli_fetch_array($resultado)){
    $PesoVenta[$mostrar['id']]=$mostrar['pesoventa'];
    for($i=0;$i<3;$i++){
        if(isset($planes[$i]["plan"]) && $mostrar['id']==$planes[$i]["plan"]){
            $select_planes[$i]=[$mostrar['modo_venta'],$mostrar['nombre'],$mostrar['plan'],$mostrar['id'],$mostrar['pesoventa']];
        }
    }
    if(!isset($datosPedidos[$mostrar['modo_venta']][$mostrar['nombre']])){
        $datosPedidos[$mostrar['modo_venta']][$mostrar['nombre']]="";
    }
    $datosPedidos[$mostrar['modo_venta']][$mostrar['nombre']]=$datosPedidos[$mostrar['modo_venta']][$mostrar['nombre']]."<option value=\"".$mostrar['id']."\">".$mostrar['plan']."</option>";
    if(!in_array($mostrar['nombre'],$nombresPedidos)){
        array_push($nombresPedidos,$mostrar['nombre']);
        $nombresPedidos[0]=$nombresPedidos[0]."<option value=\"".$mostrar['nombre']."\">".$mostrar['nombre']."</option>";
    }
}
echo "<script> console.log(".json_encode($PesoVenta).");</script>";
echo "<script> console.log(".json_encode($datosPedidos).");</script>";
echo "<script> console.log(".json_encode($nombresPedidos).");</script>";
echo "<script> console.log(".json_encode($select_planes).");</script>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>
    <script src="https://code.jquery.com/jquery-latest.js"></script>
    <link rel="stylesheet" href="./estilo.css">
    <title>Formulario Pedido</title>
    <style>
        .span-input{
            top: -6px;
            left: 4px;
            padding: 1px;
            font-size: 12px;
            color: rgb(9, 7, 31);
            background-color: greenyellow;
            font-size: 10px;
        }
    </style>

</head>

<body>
    <div>
        <!-- Primer formulario de Pedido -->
        <div class="conte_pedido">
            <div class="conte-pedido_ficha borde">
                <span class="ficha-titulo"><?php echo $_SESSION["nombre"]; ?></span>
                
                <div class="efecto-input">
                    
                    <input readonly type="text" value="<?php 
                    echo "DK_";
                    for($i=0; $i<7-strlen($pedido["id"]); $i++){
                        echo "0";    
                    }
                    echo $pedido["id"];
                    ?>" required />
                    <span class="span-input">CODIGO DE FICHA</span>
                </div>
                <div class="efecto-input">
                    <input <?php if(!$edit["modifT"]){echo "readonly";} ?> type="number" value="<?php echo $pedido["sec"]; ?>" />
                    <span class="span-input">SEC</span>
                </div>
                <div class="efecto-input">
                    <input <?php if(!$edit["modifT"]){echo "readonly";} ?> type="text" value="<?php echo $pedido["empresa"]; ?>">
                    <span class="span-input">EMPRESA</span>
                </div>
                <div class="efecto-input">
                    <input readonly value="<?php echo $pedido["fecha"].' '.$pedido["hora"]?>">
                    <span class="span-input">FECHA Y HORA</span>
                </div>
            </div>
            <div class="conte-pedido_check borde">
                <?php  if($edit['s']){ 
                        echo '<button class="botton-check" onclick="editarFicha('.$_POST["id_ped"].')">GRABAR</button>';
                    } ?>
                <button class="botton-check" onclick="window.location.href = './'">Volver</button>
                
            </div>
            </div>
        <!-- Segundo formulario de Pedido -->
        <div class="conte_operation" style="display:flex;">
                <?php  if($edit['s'] && $edit['almacen']){ 
                        $ed="";
                        $style="border: 1px solid green;";
                    }
                    else{
                        $ed="readonly";
                        $style="";
                    }
                    ?>
            <div class="conte_operation-form borde" style="<?php echo $style;?>">
                <label style="margin-left: 5px;">ALMACEN</label>
                <div class="efecto-input">
                    <select <?php echo $ed;?>>
                        <?php $resultado = mysqli_query($cn,"SELECT * from tipialmacen");
                        while($mostrar = mysqli_fetch_array($resultado)){ 
                            if($mostrar['tipialmacen']==""){$select="selected";}
                            else{$select="";}
                            ?>
                            <option  <?php  echo $select.' value="'.$mostrar['tipialmacen']; ?>"> <?php echo $mostrar['tipialmacen']; ?></option>
                        <?php } ?>
                    </select>
                    <span class="span-input">TIPIFICACION:</span>
                </div>
                <div class="efecto-input" style="<?php echo $style;?>">
                    <input <?php echo $ed;?>  type="text" value="<?php echo $pedido["fechaAlma"]; ?>"><br>
                    <span class="span-input">FECHA VENTA:</span>
                </div>
            </div>
            <?php  if($edit['s'] && $edit['afiliacion']){ 
                    $ed="";
                    $style="border: 1px solid green;";
                }
                else{
                    $ed="readonly";
                    $style="";
                }
                ?>
            <div class="conte_operation-form borde">
                <label style="margin-left: 5px;">AFILIACION</label>
                <div class="efecto-input" style="<?php echo$style; ?>">
                    <input <?php echo $ed;?>   type="text" value="<?php //echo $pedido["tipAfili"]; ?>"><br>
                    <span class="span-input">TIPIFICACION:</span>
                </div>
                <div class="efecto-input" style="<?php echo$style; ?>">
                    <input <?php echo $ed;?>  type="text" value="<?php echo $pedido["fechaAfili"]; ?>"><br>
                    <span class="span-input">FECHA AFILIACION:</span>
                </div>
                <div class="efecto-input" style="width:100%;height:90px;<?php echo$style; ?>">
                    <textarea <?php echo $ed;?>  cols="1" rows="4"><?php echo $pedido["obsAfili"]; ?></textarea><br>
                    <span class="span-input">OBSERVACION:</span>
                </div>
            </div>
                <?php  if($edit['s'] && $edit['validacion']){ 
                        $ed="";
                        $style="border: 1px solid green;";
                    }
                    else{
                        $ed="readonly";
                        $style="";
                    }
                    ?>
            <div class="conte_operation-form borde">
                <label style="margin-left: 5px;">VALIDACION</label>
                <div class="efecto-input" style="<?php echo$style; ?>">
                    <select <?php echo $ed;?>>
                        <?php $resultado = mysqli_query($cn,"SELECT * from tipivalidacion");
                        while($mostrar = mysqli_fetch_array($resultado)){ 
                            if($mostrar['tipivalidacion']==$pedido["tipfVali"]){$select="selected";}
                            else{$select="";}
                            ?>
                            <option  <?php  echo $select.' value="'.$mostrar['tipivalidacion']; ?>"> <?php echo $mostrar['tipivalidacion']; ?></option>
                        <?php } ?>
                    </select>
                    <span class="span-input">TIPIFICACION:</span>
                </div>
                <div class="efecto-input" style="<?php echo$style; ?>">
                    <input <?php echo $ed;?>  type="text" value="<?php echo $pedido["fechaVali"]; ?>"><br>
                    <span class="span-input">VALIDACION:</span>
                </div>
                <div class="efecto-input" style="<?php echo$style; ?>">
                    <input <?php echo $ed;?>  type="text" value="<?php echo $pedido["feDiferidoVali"]; ?>"><br>
                    <span class="span-input">DIFERIDO:</span>
                </div>
                <div class="efecto-input" style="width:100%;height:90px; <?php echo$style; ?>">
                    <textarea <?php echo $ed;?> cols="1" rows="4"><?php echo $pedido["obsVali"]; ?></textarea><br>
                    <span class="span-input">OBSERVACION:</span>
                </div>
            </div>
            <?php 
            if($edit['s'] && $edit['despacho']){ 
                $ed="";
                $style="border: 1px solid green;";
                }
                else{
                    $ed="readonly";
                    $style="";
                } ?>
            <div class="conte_operation-form borde">
                <label style="margin-left:5px;">DESPACHO</label>
                <div class="efecto-input">
                        <select <?php echo $ed.">";
                    $resultado = mysqli_query($cn,"SELECT * from tipidespacho");
                        while($mostrar = mysqli_fetch_array($resultado)){ 
                            if($mostrar['tipidespacho']==$pedido["tipfDes"]){$select="selected";}
                            else{$select="";}
                            ?>
                            <option <?php echo $select.' value="'.$mostrar['tipidespacho']; ?>"> <?php echo $mostrar['tipidespacho']; ?></option>
                        <?php } ?>
                    </select>
                    <span class="span-input ">TIPIFICACION:</span>
                </div>
                <div class="efecto-input ">
                    <input <?php echo $ed;?>  type="text" value="<?php echo $pedido["feEntraDes"]; ?>"><br>
                    <span class="span-input ">FECHA DE ENTREGA:</span>
                </div>
                <div class="efecto-input ">
                    <input <?php echo $ed;?>  type="text" value="<?php echo $pedido["feReproDes"]; ?>"><br>
                    <span class="span-input">REPROGRAMACION:</span>
                </div>
                <div class="efecto-input ">
                    <?php  if($ed==""){ 
                        echo "<select>";
                        $resultado = mysqli_query($cn,"SELECT id, concat (nombre,' ',apellido) as nombre from trabajador where idcargo=1;");
                        while($mostrar = mysqli_fetch_assoc($resultado)){ ?>
                        <option <?php if($pedido["motoDes"]==$mostrar['id']){echo "selected";} ?>
                        value="<?php echo $mostrar['id']; ?>"> <?php echo $mostrar['nombre']?></option>
                        <?php } 
                        echo "</select>";
                    }
                    else{ 
                        
                        $resultado = mysqli_query($cn,"SELECT id, concat (nombre,' ',apellido) as nombre from trabajador where idcargo=1;");
                        while($mostrar = mysqli_fetch_assoc($resultado)){ 
                            if($pedido["motoDes"]==$mostrar['id']){ ?>
                                <input readonly type="text" value="<?php echo $mostrar["nombre"]; ?>"><br>
                        <?php break;} } ?>
                    <?php }?>
                    <span class="span-input ">MOTORIZADO:</span>
                </div>
                <div class="efecto-input">
                    <input <?php echo $ed;?>  type="text" value="<?php echo $pedido["xDes"]; ?>"><br>
                    <span class="span-input">COORDENADAS:</span>
                </div>
                <div class="efecto-input" style="width:100%;height:50px">
                    <textarea <?php echo $ed;?> cols="1" rows="4"><?php echo $pedido["obsDes"]; ?></textarea><br>
                    <span class="span-input">OBSERVACION:</span>
                </div>
            </div>
                <?php  if($edit['s']&&$edit['activacion']){ 
                        $ed="";
                        $style="border: 1px solid green;";
                        $mostrat="display:flex";
                    }
                    else{
                        $ed="readonly";
                        $style="";
                        $mostrat="";
                    }
                    ?>
            <div class="conte_operation-form borde">
                <label style="margin-left: 5px;">ACTIVACION</label><br>
                <div class="efecto-input" style="<?php echo$style; ?>">
                    <select <?php echo $ed.">";
                        $res = mysqli_query($cn,"SELECT * from tipiactivacion");
                        while($mostrar = mysqli_fetch_array($res)){ 
                            if($mostrar['tipiactivacion']==$pedido["tipActi"]){$select="selected";}
                            else{$select="";}
                            ?>
                            <option <?php  echo $select.' value="'.$mostrar['tipiactivacion'].'">'.$mostrar['tipiactivacion']; ?></option>
                        <?php } ?>
                    </select>
                    <!-- <input <?php echo $ed;?>  type="text" value="<?php if($pedido["tipActi"]!="RT"){echo $pedido["tipActi"];} ?>"> -->
                    <span class="span-input">TIPIFICACION:</span>
                </div>
                <div class="efecto-input" style="<?php echo$style; ?>">
                    <input <?php echo $ed;?>  type="text" value="<?php echo $pedido["feActiClaro"]; ?>"><br>
                    <span class="span-input">FECHA ACTIVACION CLARO:</span>
                </div>
                <div class="efecto-input" style="<?php echo$style; ?>">
                    <input <?php echo $ed;?>  type="text" value="<?php echo $pedido["feEntreActi"]; ?>"><br>
                    <span class="span-input">FECHA DE ENTREGA:</span>
                </div>
                <div class="efecto-input" style="<?php echo$style; ?>">
                    <input <?php echo $ed;?>  type="text" value="<?php //echo $pedido["reActi"]; ?>"><br>
                    <span class="span-input">RECLAMO:</span>
                </div>
                <div class="efecto-input" style="width:100%;height:50px;<?php echo$style; ?>">
                    <textarea <?php echo $ed;?> cols="1" rows="4"><?php //echo $pedido["obsActi"]; ?></textarea><br>
                    <span class="span-input">OBSERVACION:</span>
                </div>
            </div>
                <?php  if($edit['s'] && $edit['hfc']){ 
                        $ed="";
                        $style="border: 1px solid green;";
                    }
                    else{
                        $ed="readonly";
                        $style="";
                    }
                    ?>
            <div class="conte_operation-form borde">
                <label style="margin-left: 5px;">ValidadorHFC</label>
                <div class="efecto-input">
                    <input <?php echo $ed;?>  type="text" value="<?php echo "---------------"; //echo $pedido["tipHfc"]; ?>"><br>
                    <span class="span-input">TIPIFICACION:</span>
                </div>
                <div class="efecto-input">
                    <input <?php echo $ed;?>  type="text" value="<?php echo "---------------"; //echo $pedido["feContratoHfc"]; ?>"><br>
                    <span class="span-input">CONTRATO:</span>
                </div>
                <div class="efecto-input">
                    <input <?php echo $ed;?>  type="text" value="<?php echo "---------------"; //echo $pedido["feInsHfc"]; ?>"><br>
                    <span class="span-input">INSTALACION:</span>
                </div>
                <div class="efecto-input" style="width:100%;height:90px">
                    <textarea <?php echo $ed;?> cols="1" rows="4"><?php echo "---------------"; //echo $pedido["obsHfc"]; ?></textarea><br>
                    <span class="span-input">OBSERVACION:</span>
                </div>
            </div>
        </div>
        <div class="conte_Plan_padre" style="width:100%">
            <div class="conte_plan-form">
                <!-- formulario de direcciones -->
                <div class="plan_form-info borde">
                    <!-- distrito y direccion -->
                        <div class="efecto-input">
                            <select>
                                <?php
                                    echo "<option>$pedido[distrito]</option>";
                                ?>
                            </select>
                            <span class="span-input">DISTRITO</span>
                        </div>
                        <div class="efecto-input" style="position:relative">
                            <input readonly id="direccion" type="text" value="<?php echo $pedido["direccion"]; ?>">
                            <span class="span-input">DIRECCION</span>
                        </div>
                        <!-- formulario Referencia -->
                        <div class="efecto-input">
                            <input readonly id="referencia" type="text" value="<?php echo $pedido["referencia"]; ?>" />
                            <span class="span-input">REFERENCIA</span>
                        </div>
                        <!-- formulario de fecha de entrega y coordenadas -->
                        <!-- fecha de entrega  -->
                        
                        <div class="efecto-input">
                            <input readonly type="date" value="<?php echo $pedido["fechapactada"]; ?>">
                            <span class="span-input">FECHA PACTADA</span>
                        </div>
                        <div class="efecto-input">
                            <input readonly type="text" value="<?php echo $pedido["coordx"]; ?>" />
                            <span class="span-input">COORDENADAS X,Y</span>
                        </div>
                        <!-- las información servicios -->
                        <div class="efecto-input">
                            <input readonly type="text" value="<?php echo $pedido["delivery"]; ?>">
                            <span class="span-input">DELIVERY</span>
                        </div>
                        <div class="efecto-input">
                            <input readonly type="text" value="<?php echo $pedido["asumeases"]; ?>">
                            <span class="span-input">ASUME ASES.</span>
                        </div>
                        <div class="efecto-input">
                            <input readonly type="text" value="<?php echo $pedido["asumecoord"]; ?>">
                            <span class="span-input">ASUME COORD.</span>
                        </div>
                        <div class="efecto-input">
                            <input readonly type="text" value="<?php echo $pedido["asumeempr"]; ?>">
                            <span class="span-input">ASUME EMPR.</span>
                        </div>
                        <div class="efecto-input">
                            <input readonly type="text" value="<?php echo $pedido["asumemotori"]; ?>">
                            <span class="span-input">ASUME MOTORI.</span>
                        </div>
                </div>

                <!-- formulario de información de Cliente -->
                <div class="plan_form-info borde">
                    <div class="efecto-input" style="width:70%; margin:auto;">
                        <input readonly type="text" value="<?php echo $pedido["dni"]; ?>">
                        <span class="span-input">DNI / RUC:</span>
                    </div>
                    <div class="efecto-input">
                        <input readonly type="text" value="<?php echo $pedido["cliente"]; ?>">
                        <span class="span-input">CLIENTE / RAZON SOCIAL:</span>
                    </div>
                    <div class="efecto-input">
                        <input readonly type="text" value="<?php echo $pedido["correo"]; ?>">
                        <span class="span-input">CORREO:</span>
                    </div>
                    <div class="efecto-input">
                        <input readonly type="text" value="<?php echo $pedido["telref1"]; ?>">
                        <span class="span-input">TELF REF:</span>
                    </div>
                    <div class="efecto-input">
                        <input readonly type="text" value="<?php echo $pedido["telref2"]; ?>">
                        <span class="span-input">TELF REF 2:</span>
                    </div>
                    <div class="efecto-input" style="width:100%;height:70px">
                        <textarea readonly cols="1" rows="4" style="height:max-content;resize: none;"><?php echo $pedido["observacion"]; ?></textarea>
                        <span class="span-input">OBSERVACION:</span>
                    </div>
                </div>
            </div>
            <?php 
            for($i=1;$i<4;$i++){ ?>
            <div class="conte_plan borde">
                <!-- <div class="tapar"></div> -->
                <div class="Titulo-plan">
                    <input readonly readonly type="checkbox">
                    <span>PLAN <?php echo $i; ?></span>
                </div>
                <div class="Peso-venta" style="left:auto;right: 0;background:yellow;color:red; cursor: alias;">
                <?php 
                    if(isset($planes[$i-1]["plan"])&&isset($select_planes[$i-1][4])){
                        if($edit["modifT"]) { 
                            echo '<span id="PesoVenta'.$i.'">PESO VENTA: 0.0</span>';
                        } else{
                            echo '<span>PESO VENTA: '.$select_planes[$i-1][4].'</span>';
                        }
                    }else{
                        echo '<span>PESO VENTA: 0.0</span>';
                    }
                ?>
                </div>
                <div class="conte_plan-planes">
                    <div class="bordeTipoPlanes" >
                        <div <?php if(isset($planes[$i-1]["id"])&&$select_planes[$i-1][0]=="POSTPAGO"){echo 'style="background:blue;color:white"';} ?>>
                            <label>Postopago</label>
                            <input <?php if(isset($planes[$i-1]["id"])&&$select_planes[$i-1][0]=="POSTPAGO"){echo "checked";} ?> type="checkbox" style="display:none">
                        </div>
                        <div <?php if(isset($planes[$i-1]["id"])&&$select_planes[$i-1][0]=="PREPAGO"){echo 'style="background:blue;color:white"';} ?>>
                            <label>Prepago</label>
                            <input <?php if(isset($planes[$i-1]["id"])&&$select_planes[$i-1][0]=="PREPAGO"){echo "checked";} ?> type="checkbox" style="display:none">
                        </div>
                    </div>
                    <div class="efecto-input" style="padding:0;">
                        <?php 
                            if(isset($planes[$i-1]["plan"])&&isset($select_planes[$i-1][0])){
                                if($edit["modifT"]) { 
                                    echo '<select id="seleccionTipoPlan'.$i.'" onchange="llenarPlanes('.$i.');">';
                                    for($n=0;$n<count($nombresPedidos)-1;$n++){
                                        if(isset($datosPedidos[$select_planes[$i-1][0]][$nombresPedidos[$n]])){
                                            ?>
                                            <option <?php if($nombresPedidos[$n]==$select_planes[$i-1][1]){echo "selected";} ?> value="<?php echo $nombresPedidos[$n]; ?>"><?php echo $nombresPedidos[$n]; ?></option>
                                        <?php }
                                    }
                                    echo '</select>';
                                } else{
                                    echo "<select disabled><option>".$select_planes[$i-1][1]."</option></select>";
                                }
                            }
                            else{
                                echo '<select disabled></select>';
                            }
                        ?>
                        <span class="span-input">Tipo de plan <?php echo $i; ?></span>
                    </div>
                    <div class="efecto-input" style="padding:0;">
                        <?php 
                        if(isset($planes[$i-1]["plan"])&&isset($select_planes[$i-1][0])){
                            if($edit["modifT"]) { ?>
                                <select disabled name="<?php if(isset($planes[$i-1]["plan"])&&isset($select_planes[$i-1][0])){echo $select_planes[$i-1][0];} ?>" id="seleccionPlan<?php echo $i; ?>"></select>
                            <?php } else{
                                echo "<select disabled><option>".$select_planes[$i-1][2]."</option></select>";
                            }
                        } else{
                            echo '<select disabled></select>';
                        } ?>
                        <span class="span-input">Plan <?php echo $i; ?></span>
                    </div>
                    <div class="efecto-input">
                        <input readonly type="text" value="<?php if(isset($planes[$i-1]["id"])){echo $planes[$i-1]["cargofijo"];}?>">
                        <span class="span-input">Cargo Fijo</span>
                    </div>
                    <div class="efecto-input">
                        <input readonly type="text" value="<?php if(isset($planes[$i-1]["id"])){echo $planes[$i-1]["cuota"];}?>">
                        <span class="span-input">Cuota</span>
                    </div>
                    <div class="efecto-input">
                        <input readonly type="text" value="<?php if(isset($planes[$i-1]["id"])){echo $planes[$i-1]["ncuota"];}?>">
                        <span class="span-input">N° Cuotas</span>
                    </div>
                    <div class="efecto-input">
                        <input readonly type="text" value="<?php if(isset($planes[$i-1]["id"])){echo $planes[$i-1]["lineaportar"];}?>">
                        <span class="span-input">linea a portar</span>
                    </div>
                    <div class="operador">
                        <div class="efecto-input" style="width:calc(100% - 35px);">
                            <select name="operadoresSelect">
                                <?php 
                                    if(isset($planes[$i-1]["id"])){echo $operadores[$planes[$i-1]["operador"]];}
                                ?>
                            </select>
                            <span class="span-input">Operador</span>
                        </div>
                    </div>
                    <div class="efecto-input">
                        <input readonly type="text" value="<?php if(isset($planes[$i-1]["id"])){echo $planes[$i-1]["rentaadelantada"];}?>">
                        <span class="span-input">Renta adelantada</span>
                    </div>
                </div>
                <!-- /* formulario de IMEI Y ISSEC */ -->
                <!-- IMEI -->
                <div class="producto">
                    <div class="imei">
                        <span>Telefono</span>
                        <div class="efecto-input" style="width:90%">
                            <input readonly type="text" value="<?php if(isset($planes[$i-1]["id"])){echo $planes[$i-1]["imei"];}?>">
                            <span class="span-input">Imei</span>
                        </div>
                        <!-- Creacion de Inicial y Siacc -->
                        <div class="Inicial_Sissac">
                            <div class="efecto-input">
                                <input readonly type="text" value="<?php if(isset($planes[$i-1]["id"])){echo $planes[$i-1]["inicial"];}?>">
                                <span class="span-input">Inicial</span>
                            </div>
                            <div class="efecto-input">
                                <input readonly type="text" value="<?php if(isset($planes[$i-1]["id"])){echo $planes[$i-1]["imeisisac"];}?>">
                                <span class="span-input">Sisac</span>
                            </div>
                        </div>
                        <div class="efecto-input" style="width:100%;height:100px;">
                            <textarea disabled class="Area_imei"><?php if(isset($planes[$i-1]["id"])){echo $planes[$i-1]["imeiobservacion"];}?></textarea>
                        </div>
                    </div>
                    <!-- ICC -->
                    <div class="imei">
                        <span>Chip</span>
                        <div class="efecto-input" style="width:80%">
                                <input readonly type="text" value="<?php if(isset($planes[$i-1]["id"])){echo $planes[$i-1]["icc"];}?>">
                            <span class="span-input">Icc</span>
                        </div>
                        <!-- Creacion de Inicial y Siacc -->
                        <div class="Inicial_Sissac">
                            <div class="efecto-input">
                                <input readonly type="text" value="<?php if(isset($planes[$i-1]["id"])){echo $planes[$i-1]["precio"];}?>">
                                <span class="span-input">Precio</span>
                            </div>
                            <div class="efecto-input">
                                <input readonly type="text" value="<?php if(isset($planes[$i-1]["id"])){echo $planes[$i-1]["iccsisac"];}?>">
                                <span class="span-input">Sisac</span>
                            </div>
                        </div>
                        <div class="efecto-input" style="width:100%;height:100px;">
                            
                            <textarea disabled class="Area_icc"><?php if(isset($planes[$i-1]["id"])){echo $planes[$i-1]["iccobservación"];}?></textarea>
                        </div>
                    </div>
                </div>
                <!-- ------------------------------Checkbox------------------------ -->
                <div class="conte-check">
                    <div style="<?php echo$mostrat; ?>">
                        <input readonly type="checkbox"  class="check">
                        <label style="margin-left:5px;"> >= 90 DIAS</label>
                    </div>
                    <div style="<?php echo$mostrat; ?>">
                        <input readonly type="checkbox" class="check">
                        <label style="margin-left:5px;">  >= CF65</label>
                    </div>
                    <div style="<?php echo$mostrat; ?>">
                        <input readonly type="checkbox" class="check">
                        <label style="margin-left:5px;"> < CF65 </label>
                    </div>
                </div>
                <div class="conte-check">
                    <div style="<?php echo$mostrat; ?>">
                        <input readonly readonly type="checkbox"  class="check">
                        <label style="margin-left:5px;"> Up-SELL</label>
                    </div>
                    <div style="<?php echo$mostrat; ?>">
                        <input readonly readonly type="checkbox" class="check">
                        <label style="margin-left:5px;">Cross-Sell</label>
                    </div>
                </div>
            </div>
            <?php } ?>
        <div class="conte_Pedilibre">

            <div class="pedilibre borde">
                <!-- Inicial Renta Cargo -->
                <!-- <div class="tapar"></div> -->
                <div class="Peso-venta" style="left:auto;right: 0;background:yellow;color:red; cursor: alias;">
                    <span>PESO VENTA: 0.0</span>
                </div>
                <div class="Titulo-plan">
                    <input readonly readonly type="checkbox">
                    <span>HFC - Migracion sin imei/icc</span>
                </div>
                <div class="conte_plan-planes">
                    <div class="bordeTipoPlanes" >
                        <div>
                            <label>Postopago</label>
                            <input readonly readonly type="checkbox" style="display:none"/>
                        </div>
                        <div onclick="tipoPlanSelect(<?php echo $i; ?>,'E');">
                            <label>Prepago</label>
                            <input readonly readonly type="checkbox" style="display:none"/>
                        </div>
                    </div>
                    <div class="efecto-input" style="padding:0;">
                        <select disabled id="seleccionPlan4"></select>
                        <span class="span-input">HFC/MIGRACIÓN SIN CHIP</span>
                    </div>
                </div>
                <div class="conte_plan-planes">
                    <div class="efecto-input">
                        <input readonly readonly id="inicialPedido" type="number" step="any" required>
                        <label class="span-input">INICIAL</label>
                    </div>
                    <div class="efecto-input">
                        <input readonly readonly id="rentaPedido" type="number" step="any" required>
                        <label class="span-input">RENTA AD.</label>
                    </div>
                    <div class="efecto-input">
                        <input readonly readonly id="cargofijoPedido" type="number" step="any" required>
                        <label class="span-input">CARGO FIJO</label>
                    </div>
                    <div class="operador">
                        <div class="efecto-input" style="width:calc(100% - 35px);">
                            <select name="operadoresSelect" id="operadorPlan4">
                                <?php echo $operadores; ?>
                            </select>
                            <span class="span-input">Operador</span>
                        </div>
                    </div>
                    <div class="efecto-input">
                        <input readonly readonly type="number" step="any" id="lineaPedido<?php echo $i; ?>" required onkeypress="llamadas(event);">
                        <label class="span-input">Linea / Número a portar</label>
                    </div>
                <!-- ------------------- -->
                    <!-- --------primero--- -->
                    <div class="efecto-input">
                        <input readonly readonly id="fechanacPedido" type="date" step="any">
                        <label class="span-input">Fecha de nacimiento</label>
                    </div>
                    <div class="efecto-input">
                        <input readonly readonly id="lugarnacPedido" type="text" step="any" required>
                        <label class="span-input">Lugar de nacimiento</label>
                    </div>
                    <div class="efecto-input">
                        <input readonly id="fechaAgendPedido" type="date" >
                        <label class="span-input">Fecha agendada</label>
                    </div>
                    <div class="efecto-input">
                        <input readonly id="P-nombrePedido" type="text" required>
                        <label class="span-input">Nombre del Padre</label>
                    </div>
                    <div class="efecto-input">
                        <input readonly id="M-nombrePedido" type="text" required>
                        <label class="span-input">Nombre del Padre</label>
                    </div>
                </div>

            </div>
            <div class="pedilibre-none">

            </div>
        </div>
    </div>
    </div>
    <script>
        document.addEventListener ("keydown",function (e){
            var tecla=e.keyCode;
            if (tecla==116) {
                if(confirm('Si recarga la página perdera todos los datos ingresados,\n ¿Deseas recargar la página?')){
                } 
                else {
                    e.keyCode=0;
                    e.returnValue=false;
                }
            }
            if (e.ctrlKey) {
                if(e.shiftKey){
                    if(tecla == 67|| tecla==73){
                        console.log(e);
                        alertify.error("No se puede el Control + Shift + "+e.key);
                        e.preventDefault(); 
                    }
                }
                if (tecla==82) {
                    if(confirm('Si recarga la página perdera todos los datos ingresados,\n ¿Seguro que deseas recargar la página?')){
                        e.shiftKey=true;
                        e.keyCode=82;
                        e.returnValue=true;
                    } 
                    else {
                        e.keyCode=0;
                        e.returnValue=false;
                    }
                }
            }
            if (tecla==123) {
                alertify.error("No se puede uar el \"F12\" ");
                event.keyCode=0;
                event.returnValue=false;
            }
        })
        
        document.addEventListener("contextmenu",(e)=>{
            e.preventDefault();
        })
        PesoVenta= JSON.parse('<?php if(count($PesoVenta)!=0){echo json_encode($PesoVenta);}else{echo json_encode([0]);} ?>')
        TipoPedido= '<?php echo $nombresPedidos[0]; ?>';
        DTipoPedido= <?php echo json_encode($nombresPedidos); ?>;
        datoPed= <?php echo json_encode($datosPedidos); ?>;

        const llenarPlanes=(n)=>{
            valor=document.getElementById("seleccionTipoPlan" + n).value;
            tipde=document.getElementById("seleccionPlan" + n).name.toUpperCase();
            if(datoPed[tipde][valor]==undefined){
                document.getElementById("seleccionPlan" + n).disabled = true;
                document.getElementById("seleccionPlan" + n).innerHTML = "";
                document.getElementById("PesoVenta" + n).innerHTML = "PESO VENTA: 0.0";
                alertify.error("No hay planes para este tipo");
            }
            else{
                document.getElementById("seleccionPlan" + n).disabled = false;
                document.getElementById("seleccionPlan" + n).innerHTML = datoPed[tipde][valor];
                select=document.getElementById("seleccionPlan" + n).value;
                document.getElementById("PesoVenta" + n).innerHTML = "PESO VENTA: "+PesoVenta[select];
            }
        }
        setTimeout(()=>{
            <?php for($i=0;$i<count($select_planes);$i++){ ?>
                document.getElementById("seleccionPlan" + <?php echo $i+1 ?>).value = <?php echo $select_planes[$i][3]; ?>;
            <?php } ?>
            },150
        );
        for(n=0;n< <?php echo count($select_planes);?>;n++){
            llenarPlanes(n+1);
            document.getElementById("seleccionPlan"+(n+1)).addEventListener("change",(pos)=>{
                        id=pos.path[0].id.substr(-1);
                        select=pos.path[0].value;
                        if(select>=0){
                            document.getElementById("PesoVenta" + id).innerHTML = "PESO VENTA: "+PesoVenta[select];
                        }
                        console.log(select);
                    }
                );
        }
    </script>
    <script>
        <?php  if($edit['s']){ ?>
            const editarFicha = (n) =>{
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log(this.response);
                        window.close();
                    }
                };
                xmlhttp.open("POST", "./comun.php",true);
                data = new FormData();
                data.append("editPedidos","si");
                <?php  if($edit["despacho"]){ ?>
                    el=document.getElementsByClassName("conte_operation-form")[3].children;
                    data.append("tipfDes",el[1].children[0].value);
                    data.append("feEntraDes",el[2].children[0].value);
                    data.append("feReproDes",el[3].children[0].value);
                    data.append("motoDes",el[4].children[0].value);
                    data.append("xDes",el[5].children[0].value);
                    data.append("obsDes",el[6].children[0].value);
                <?php } if($edit["validacion"]){ ?>
                    el=document.getElementsByClassName("conte_operation-form")[2].children;
                    data.append("tipfVali",el[1].children[0].value);
                    data.append("fechaVali",el[2].children[0].value);
                    data.append("feDiferidoVali",el[3].children[0].value);
                    data.append("obsVali",el[4].children[0].value);
                <?php } if($edit["activacion"]){ ?>
                    el=document.getElementsByClassName("conte_operation-form")[4].children;
                    data.append("tipActi",el[2].children[0].value);
                    data.append("feActiClaro",el[3].children[0].value);
                    data.append("feEntreActi",el[4].children[0].value);
                    data.append("reActi",el[5].children[0].value);
                    data.append("obsActi",el[6].children[0].value);
                <?php } if($edit["modifT"]){ ?>
                    data.append("sec",document.getElementsByClassName("efecto-input")[1].value);
                    data.append("empresa",document.getElementsByClassName("efecto-input")[2].value);
                <?php } if($edit["modifDireccion"]){ ?>
                    data.append("distrito",document.getElementsByClassName("efecto-input")[28].value);
                    data.append("direccion",document.getElementsByClassName("efecto-input")[29].value);
                    data.append("referencia",document.getElementsByClassName("efecto-input")[30].value);
                <?php } ?>
                data.append("id_edit",n)
                xmlhttp.send(data);
            }
        <?php } else{
            echo "no";
            } ?>
    </script>
</body>

</html>