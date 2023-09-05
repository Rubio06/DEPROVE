<?php
require_once("../coneccion.php");
$cn = Db::conectar();
date_default_timezone_set('America/Lima');
$hora_actual= date("Y-m-d h:i a");
$fecha_actual= date("Y-m-d");
session_start();
$coordinador= "";
$distritos=['','Ancón','Ate Vitarte','Barranco','Callao','Carabayllo','Chaclacayo','Chorrillos','Cieneguilla','Comas','El Agustino','Independencia','Jesús María','La Molina','La Victoria','Lima','Lince','Los Olivos','Lurigancho','Lurín','Magdalena del Mar','Miraflores','Pachacamac','Pucusana','Pueblo Libre','Puente Piedra','Punta Hermosa','Punta Negra','Rímac','San Bartolo','San Borja','San Isidro','San Juan de Lurigancho','San Juan de Miraflores','San Luis','San Martín de Porres','San Miguel','Santa Anita','Santa María del Mar','Santa Rosa','Santiago de Surco','Surquillo','Villa El Salvador','Villa María del Triunfo'];
// echo json_encode($_SESSION);
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <link href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./estilo.css">
    <title>Formulario Pedido</title>
    <style>
    </style>

</head>

<body>
    <div id="busqEdquip" style="display:none">
        <div class="form-box" style="transform: translate(-50%, -50%);display: flex;justify-content: space-evenly;margin: auto;position: fixed;z-index: 5;left: 50%;top: 50%;">
            <div id="edit_code">
            <div style="position: absolute;right: 10px;top: 10px;border-radius: 15px;background: red;z-index: 6;padding: 5px 10px;" id="CerrarbusqEdquip">X</div>
                <h2 style="text-align:center;">PRODUCTO</h2>
                <div id="pack_actu_marca" class="packform">
                    <label>Marca: </label>
                    <select name="" id="busq_equip_marca">
                        <?php
                            $marca=Array(1=>Array(),2=>Array());
                            $modelos=Array(1=>Array(),2=>Array());
                            $colores=Array();  
                            $marcas=mysqli_query($cn,"SELECT modelo.*,marca.nombre marc,codigos.tipo FROM marca INNER join modelo on modelo.marca=marca.id inner join codigos on codigos.id_producto=modelo.id order by marc, nombre ASC;");
                            while ($x=mysqli_fetch_assoc($marcas)){
                                if($x["marc"]!=""){
                                    if(!isset($modelos[$x["tipo"]][$x["marca"]])){
                                        if($x["tipo"]=="1"){
                                            echo "<option value='[$x[tipo],$x[marca]]'>$x[marc]</option>";
                                        }
                                        $modelos[$x["tipo"]][$x["marca"]]=Array();
                                    }
                                    if(!in_array([$x["marca"],$x["marc"]],$marca[$x["tipo"]])){
                                        array_push($marca[$x["tipo"]],[$x["marca"],$x["marc"]]);
                                    }
                                    array_push($modelos[$x["tipo"]][$x["marca"]],[$x["id"],$x["nombre"]]);
                                }
                            }
                            $marcas=mysqli_query($cn,"SELECT * FROM color order by modelo");
                            while ($x=mysqli_fetch_assoc($marcas)){
                                if(!isset($colores[$x["modelo"]])){
                                    $colores[$x["modelo"]]=Array();
                                }
                                array_push($colores[$x["modelo"]],[$x["id"],$x["nombre"]]);
                            }
                        ?>
                    </select>
                </div>
                <div class="packform">
                    <label>modelo: </label>
                    <select name="" id="busq_equip_modelo">
                    </select>
                </div>
                <div id="pack_actu_color" class="packform">
                    <label>Color: </label>
                    <select name="" id="busq_equip_color"></select>
                </div>
                <input id="busq_equip_id" type="hidden">
                <input id="busq_equip_tipo" type="hidden">
                <button id="BajarDescProducto" class="submit-btn">AGREGAR PRODUCTO</button>
            </div>
        </div>
    </div>
    <div>
        <!-- Primer formulario de Pedido -->
        <div class="conte_pedido">
            <div class="conte-pedido_ficha borde">
                <span class="ficha-titulo"><?php echo $_SESSION["nombre"]; ?></span>
                
                <div class="efecto-input">
                    <input id="codigoFicha" type="text" required />
                    <span class="span-input">CODIGO DE FICHA</span>
                </div>
                <div class="efecto-input">
                    <input id="Sec" type="text" required />
                    <span class="span-input">SEC</span>
                </div>
                <div class="efecto-input">
                    <select id="empressa" class="empresa" name="empresa" style="margin-bottom:15px;" required>
                        <option value=""></option>
                        <option value="KOMUNICATE">KOMUNICATE</option>
                        <option value="DEPROVE">DEPROVE</option>
                    </select>
                    <span class="span-input">EMPRESA</span>
                </div>
                <div class="efecto-input">
                    <div style="background: #80808066;width:100%;position:absolute;height: 100%;transform: translateX(-5px);"></div>
                    <input onkeypress="return false;" onfocus="document.getElementsByClassName('efecto-input')[4].children[0].focus();" contenteditable="false" type="text" id="fechaHora" name="fecha" value="<?php echo $hora_actual?>">
                    <span class="span-input">FECHA Y HORA</span>
                </div>
            </div>
            <div class="conte-pedido_check borde">
                <div>
                    <button class="botton-check " onclick="subirRegistro()" id="grabar">GRABAR</button>
                </div>
                <!-- <div>
                    <button class="botton-check " id="verVaucher">VER VOUCHER</button>
                </div> -->
                    <!-- <a target="blank" id="WhatsApp" class="whas"></a> -->
                    <a id="Llamada"><img src="https://wiki.2n.com/hip/inte/files/latest/en/32544241/32544246/1/1544099426085/MicroSIP.png" width="40px" class="llamada"></a>
                </div>
            </div>
        <!-- Segundo formulario de Pedido -->
        <div class="conte_operation" style="display:none;">
            <div class="conte_operation-form borde">
                <label style="margin-left: 5px;">ALMACEN</label>
                <input id="almacen" type="button" name="almacen" style="margin-top:5px;width:20px;height:15px;margin-left:5px" /><br>
                <label style="margin-left: 5px; margin-right:5px;">tipf.</label>
                <select id="tipfAlmacen" name="tipfAlmacen" style="margin-bottom:15px;">
                    <?php $resultado = mysqli_query($cn,"SELECT * from tipialmacen");
                    while($mostrar = mysqli_fetch_array($resultado)){ 
                        ?>
                        <option value="<?php echo $mostrar['tipialmacen']; ?>"> <?php echo $mostrar['tipialmacen']; ?></option>
                    <?php } ?>
                    </select>
                <label style="margin-left: 5px;">fecha venta</label>
                <input type="date" id="almacenFecha" name="almacenFecha" size="10" value="<?php echo $fecha_actual;?>">
            </div>
            <div class="conte_operation-form borde">
                <label style="margin-left: 5px;">AFILIACION</label>
                <input id="afiliacion" type="button" name="afiliacion" style="margin-top:5px;width:20px;height:15px;margin-left:5px" /><br>
                <label style="margin-left: 5px; margin-right:5px;">tipf.</label>
                <select id="tipfAfilicion"  style="margin-bottom:15px;">
                    <?php $resultado = mysqli_query($cn,"SELECT * FROM tipiafilicacion");
                    while($mostrar = mysqli_fetch_array($resultado)){ ?> 
                        <option value="<?php echo $mostrar['tipiafilicacion']; ?>"> <?php echo $mostrar['tipiafilicacion']; ?></option>
                    <?php } ?>
                </select>
                <label style="margin-left: 5px;margin-right: 3px;">fecha afiliación</label>
                <input disabled id="fechaAfilicion" type="date" name="fechaAfilicion" size="10" value="<?php echo $fecha_actual?>"><br>
                <label style="margin-left: 5px;">Observación</label><br><textarea id="observacionAfiliacion" class="Area_afil" rows="9" cols="25"></textarea>
            </div>
            <div class="conte_operation-form borde">
                <label style="margin-left: 5px;">VALIDACION</label>
                <input id="validacion" type="button" name="validacion" style="margin-top: 5px;width:20px;height:15px;margin-left:5px" /><br>
                <label style="margin-left: 5px; margin-right:5px;">tipf.</label>
                <select id="tipfValidacion" name="tipfValidacion" style="margin-bottom:5px;">
                    <?php $resultado = mysqli_query($cn,"SELECT * FROM tipivalidacion");
                    while($mostrar = mysqli_fetch_array($resultado)){ ?>
                        <option value="<?php echo $mostrar['tipivalidacion']; ?>"> <?php echo $mostrar['tipivalidacion']; ?></option>
                    <?php } ?>
                </select>
                <label style="margin-left: 5px;">fecha validación</label><input disabled type="date" id="fechaValidacion" name="fechaValidacion" size="10" value="<?php echo $fecha_actual?>">
                <label style="margin-left: 5px;">fecha diferido</label><input style="margin-top: 5px;" type="date" id="diferidoValidacion" name="diferidoValidacion" size="10" value="<?php echo $fecha_actual?>">
                <label style="margin-left: 5px;">Observación</label><textarea id="observacionValidacion" class="Area_vali" rows="8" cols="25"></textarea>
            </div>
            <div class="conte_operation-form borde">
                <label style="margin-left:5px;">DESPACHO</label>
                <input type="button" id="despacho" style="margin-top:5px;width:20px;height:15px;margin-left:5px" /><br>
                <div class="operation-form">
                    <label style="margin-left:5px;">tipf. </label>
                    <select id="tipfDesapacho" name="tipfDesapacho" style="margin-bottom:5px;margin-left: 5px;">
                        <?php 
                            $resultado = mysqli_query($cn,"SELECT * FROM tipidespacho");
                            while($mostrar = mysqli_fetch_array($resultado)){ ?>
                                <option value="<?php echo $mostrar['tipidespacho']; ?>"> <?php echo $mostrar['tipidespacho']; ?></option>
                            <?php } ?>
                    </select>
                    <label style="margin-left:5px; margin-right: 5px;">ruta larga</label>
                    <input type="checkbox" id="rutaDespacho" name="rutaDespacho" style="width : 49px; margin-bottom: 5px;" /><br>
                </div>
                <div>
                    <label style="margin-left:5px;margin-right: 5px;">fecha entrega</label>
                    <input style="margin-top: 5px; margin-left:5px;" type="date" id="fechaentregaDespacho" name="fechaentregaDespacho" size="10" value="<?php echo $fecha_actual?>">
                </div>
                <div>
                    <label style="margin-left:5px; margin-right: 5px;">fecha reprogram</label>
                    <input style="margin-top: 5px; margin-left:5px;width:95px;" type="date" id="fechareprogramDespacho" name="fechareprogramDespacho" value="<?php echo $fecha_actual?>">
                </div>
                <div>
                    <label style="margin-left:5px;font-size:11px;margin-right:5px;">MONITORIZADO</label>
                    <input type="text" id="monitorizado" name="monitorizado" style="width:80px;margin-bottom: 5px;" />
                </div>
                <div class="operation-form_cor">
                    <div class="form_cor">
                        <label style="font-size:11px;margin-left: 5px;">COORDENADAS</label>
                    </div>
                    <div class="form_cor">
                        <div class="form_cor-x">
                            <label>X:</label><input type="text" id="despachoCoordenadasX" style="width:56px;">
                        </div>
                        <div>
                            <label>Y:</label><input type="text" id="despachoCoordenadasY" style="width:56px;">
                        </div>
                    </div>

                </div>
                <label style="margin-left:5px;">Observación</label><textarea id="observacionDespacho" class="Area_Des" rows="2" cols="25"></textarea>
            </div>
            <div class="conte_operation-form borde">
                <label style="margin-left: 5px;">ACTIVACION</label><input type="button" id="activacion" name="activacion" style="margin-top:
                            5px;width:20px;height:15px;margin-left:5px" /><br>
                <label style="margin-left: 5px; margin-right:5px;">tipf.<select
                                id="tipfActivacion" name="tipfActivacion"
                                style="margin-bottom:5px;margin-left: 5px;">
                                <?php
                                    $query ="select * from tipiactivacion";
                                    $resultado = mysqli_query($cn,$query);
                                    while($mostrar = mysqli_fetch_array($resultado)){
                                    ?>
                                    <option value="<?php echo $mostrar['tipiactivacion']; ?>"> <?php echo $mostrar['tipiactivacion']; ?></option>
                                    <?php
                                    }
                                    ?>
                            </select>
                            <br>
                            <label style="margin-left: 5px;">fecha de activación de claro</label>
                            <input style="margin-top: 5px; margin-left:5px;" type="date" id="fechaActivacionClaro" name="fechaActivacionClaro" size="10" value="<?php echo $fecha_actual?>">
                            <br>
                            <label style="margin-left: 5px;margin-right: 5px;">fechade entrega</label>
                            <input style="margin-top: 5px;margin-left:5px;" type="date" id="fechaEntregaActivacion" name="fechaEntregaActivacion" size="10" value="<?php echo $fecha_actual?>">
                            <br>
                            <div style="display:flex;align-items:center;">
                                <label>RECLAMO</label>
                                <input type="button" id="reclamo" style="width:20px;height:15px;margin-left:5px"/>
                                <label style="margin-left: 5px; margin-right:5px;">tipf. </label>
                                <select id="tipfReclamo" style="margin-bottom:5px;margin-left: 5px;">
                                    <?php $resultado = mysqli_query($cn,"SELECT * FROM reclamo");
                                    while($mostrar = mysqli_fetch_array($resultado)){ ?>
                                        <option value="<?php echo $mostrar['reclamo']; ?>"> <?php echo $mostrar['reclamo']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                <label style="margin-left: 5px;">Observación</label><textarea id="observacionActivacion" class="Area_Acti" rows="4" cols="25"></textarea>
            </div>
            <div class="conte_operation-form borde">
                <label style="margin-left: 5px;">ValidadorHFC</label><input type="button" id="ValidadorHFC" name="ValidadorHFC" style="margin-top:
                                5px;width:20px;height:15px;margin-left:5px" /><br>
                <label style="margin-left: 5px;">tipf.<select
                                    id="tipfValidadorHFC"
                                    name="tipfValidadorHFC"
                                    style="margin-bottom:15px;margin-left:
                                    5px;">
                                   <?php
                                    $query ="select * from tipihfc";
                                    $resultado = mysqli_query($cn,$query);
                                    while($mostrar = mysqli_fetch_array($resultado)){ ?>
                                    <option value="<?php echo $mostrar['tipihfc']; ?>"> <?php echo $mostrar['tipihfc']; ?></option>
                                    <?php } ?>
                                </select><br>
                                <label style="margin-left: 5px;">fecha
                                    audio/contrato</label><input style="margin-top: 5px; margin-left:5px;" type="date" id="fechaudiocontratoValidadorHFC" name="fechaudiocontratoValidadorHFC" size="10" value="<?php echo $fecha_actual?>"><br>
                <label style="margin-left: 5px;">fecha de
                                    instalación</label><input style="margin-top:
                                    5px; margin-left:5px;" type="date" id="fechainstalacionValidadorHFC" name="fechainstalacionValidadorHFC" size="10" value="<?php echo $fecha_actual?>"><br>
                <label style="margin-left: 5px;">Observación</label><textarea id="observacionValidadorHFC" rows="5" cols="25" style="margin-left: 5px;resize:
                                    none;"></textarea>
            </div>
        </div>
<!-- -----------------------------botomes llamada izipay------------ -->
<p style="display:none;" id="asesor"><?php echo $_SESSION["id"];?>
<div class="contenedor-llaizi">
        <!-- -----modal LLamar---- -->
    <button id="llamar" class="llamar">LLAMAR</button>
    <button id="izipay" class="izipay">IZIPAY</button>
</div>
<!-- ----------------- -->

        <div class="conte_Plan_padre">
            <div class="conte_plan-form">
                <!-- formulario de direcciones -->
                <div class="plan_form-info borde">
                    <!-- distrito y direccion -->
                        <div class="efecto-input">
                            <select class="distrito" id="distrito" name="distrito" required>
                                <?php
                                for($i=0;$i<count($distritos);$i++){
                                    echo "<option value='$distritos[$i]'>$distritos[$i]</option>";
                                }?>
                            </select>
                            <span class="span-input">DISTRITO</span>
                        </div>
                        <div class="efecto-input" style="position:relative">
                            <input id="direccion" type="text" required />
                            <span class="span-input">DIRECCION</span>
                        </div>
                        <!-- formulario Referencia -->
                        <div class="efecto-input">
                            <input id="referencia" type="text" required />
                            <span class="span-input">REFERENCIA</span>
                        </div>
                        <!-- formulario de fecha de entrega y coordenadas -->
                        <!-- fecha de entrega  -->
                        
                        <div class="efecto-input">
                            <input type="date" id="fechaPactada" name="fechaPactada" value="<?php echo $fecha_actual?>" required/>
                            <span class="span-input">FECHA PACTADA</span>
                        </div>
                        <!-- Coordenadas X y Y -->
                        <!-- <div class="form-fecha_coor">
                            <label>COORDENADAS</label>
                            <div style="width: 50%;display: flex;justify-content: space-between;">
                                <div class="efecto-input" style="width: calc(50% - 5px);">
                                    <input id="coordenadasX" type="text" required />
                                    <span class="span-input">X</span>
                                </div>
                                <div class="efecto-input" style="width: calc(50% - 5px);">
                                    <input id="coordenadasY" type="text" required />
                                    <span class="span-input">Y</span>
                                </div>
                            </div>
                        </div> -->
                        <div class="efecto-input">
                            <input id="coordenadasX" type="text" required />
                            <span class="span-input">COORDENADAS X,Y</span>
                        </div>
                        <!-- las información servicios -->
                        <div class="efecto-input">
                            <input id="delivery" type="text" required />
                            <span class="span-input">DELIVERY</span>
                        </div>
                        <div class="efecto-input">
                            <input id="asumeAses" type="text" required />
                            <span class="span-input">ASUME ASES.</span>
                        </div>
                        <div class="efecto-input">
                            <input id="asumeCoord" type="text" required />
                            <span class="span-input">ASUME COORD.</span>
                        </div>
                        <div class="efecto-input">
                            <div style="background: #80808066;width:100%;position:absolute;height: 100%;transform: translateX(-5px);"></div>
                            <input onfocus="document.getElementsByClassName('efecto-input')[14].children[0].focus();" id="asumeEmpr" type="text" required />
                            <span class="span-input">ASUME EMPR.</span>
                        </div>
                        <div class="efecto-input">
                            <div style="background: #80808066;width:100%;position:absolute;height: 100%;transform: translateX(-5px);"></div>
                            <input onfocus="document.getElementsByClassName('efecto-input')[14].children[0].focus();" id="asumeMotori" type="text" required />
                            <span class="span-input">ASUME MOTORI.</span>
                        </div>
                </div>

                <!-- formulario de información de Cliente -->
                <div class="plan_form-info borde">
                    <div class="efecto-input" style="width:70%; margin:auto;">
                        <input id="dniCliente" type="text" required />
                        <span class="span-input">DNI / RUC:</span>
                    </div>
                    <div class="efecto-input infor_1-dni">
                        <div style="background: #80808066;width:100%;position:absolute;height: 100%;transform: translateX(-5px);"></div>
                        <input onfocus="document.getElementsByClassName('efecto-input')[17].children[0].focus();" id="cliente" type="text" required onkeypress="return false;">
                        <span class="span-input">CLIENTE / RAZON SOCIAL:</span>
                    </div>
                    <div class="efecto-input">
                        <div style="background: #80808066;width:100%;position:absolute;height: 100%;transform: translateX(-5px);"></div>
                        <input onfocus="document.getElementsByClassName('efecto-input')[17].children[0].focus();" id="correoCliente" type="text" required  onkeypress="return false;"/>
                        <span class="span-input">CORREO:</span>
                    </div>
                    <div class="efecto-input">
                        <input id="telefRefCliente1" type="number" step="any" required onkeypress="llamadas(event);" />
                        <span class="span-input">TELF REF:</span>
                    </div>
                    <div class="efecto-input">
                        <input id="telefRefCliente2" type="number" step="any" required onkeypress="llamadas(event);">
                        <span class="span-input">TELF REF 2:</span>
                    </div>
                    <div class="efecto-input" style="width:100%;height:70px">
                        <textarea id="observacionCliente" required="" id="" cols="1" rows="4" style="height:max-content;resize: none;"></textarea>
                        <span class="span-input">OBSERVACION:</span>
                    </div>
                </div>
            </div>
            <?php
            $PesoVenta= Array();
            $datosPedidos = Array();
            $nombresPedidos = Array();
            $resultado = mysqli_query($cn,"SELECT pesoventa.id,concat(categoria, ' ', planes.plan) as plan,nombre,mes,pesoventa,modo_venta from pesoventa inner join planes on pesoventa.plan=planes.id inner join tipoPlan on planes.tipo=tipoPlan.id where mes='".date("Y-m-")."01"."' order by nombre,plan;");
            $antePost="";
            $antePre="";
            array_push($nombresPedidos,"");
            while($mostrar = mysqli_fetch_array($resultado)){
                $PesoVenta[$mostrar['id']]=$mostrar['pesoventa'];
                if(!isset($datosPedidos[$mostrar['modo_venta']][$mostrar['nombre']])){
                    $datosPedidos[$mostrar['modo_venta']][$mostrar['nombre']]="";
                }
                $datosPedidos[$mostrar['modo_venta']][$mostrar['nombre']]=$datosPedidos[$mostrar['modo_venta']][$mostrar['nombre']]."<option value=\"".$mostrar['id']."\">".$mostrar['plan']."</option>";
                if(!in_array($mostrar['nombre'],$nombresPedidos)){
                    array_push($nombresPedidos,$mostrar['nombre']);
                    $nombresPedidos[0]=$nombresPedidos[0]."<option value=\"".$mostrar['nombre']."\">".$mostrar['nombre']."</option>";
                }
            }
            $resultado = mysqli_query($cn,"SELECT * from operador;"); $operadores="";
            while($mostrar = mysqli_fetch_array($resultado)){
                $operadores=$operadores."<option value=\"".$mostrar['id']."\">".$mostrar['nombre']."</option>";
            } 
            for($i=1;$i<4;$i++){ ?>
            <div class="conte_plan borde">
                <div id="tapa<?php echo $i; ?>" class="tapar"></div>
                <div onclick="presionarCheck(<?php echo $i; ?>)" class="Titulo-plan">
                    <input type="checkbox" id="Plan<?php echo $i; ?>"/>
                    <span>PLAN <?php echo $i; ?></span>
                </div>
                <div class="Peso-venta" style="left:auto;right: 0;background:yellow;color:red; cursor: alias;">
                    <span id="PesoVenta<?php echo $i; ?>">PESO VENTA: 0.0</span>
                </div>
                <div class="conte_plan-planes">
                    <div class="bordeTipoPlanes" >
                        <div onclick="tipoPlanSelect(<?php echo $i; ?>,'O');">
                            <label>Postopago</label>
                            <input id="Postpago<?php echo $i; ?>" type="checkbox" style="display:none"/>
                        </div>
                        <div onclick="tipoPlanSelect(<?php echo $i; ?>,'E');">
                            <label>Prepago</label>
                            <input id="Prepago<?php echo $i; ?>" type="checkbox" style="display:none"/>
                        </div>
                    </div>
                    <div class="efecto-input" style="padding:0;">
                        <select onchange="llenarPlanes(<?php echo $i; ?>);" disabled id="seleccionTipoPlan<?php echo $i; ?>"></select>
                        <span class="span-input">Tipo de plan <?php echo $i; ?></span>
                    </div>
                    <div class="efecto-input" style="padding:0;">
                        <select disabled id="seleccionPlan<?php echo $i; ?>"></select>
                        <span class="span-input">Plan <?php echo $i; ?></span>
                    </div>
                    <div class="efecto-input">
                        <input type="number" step="any" id="cargofijoPlan<?php echo $i; ?>" required>
                        <span class="span-input">Cargo Fijo</span>
                    </div>
                    <div class="efecto-input">
                        <input type="number" step="any" id="cuotaPlan<?php echo $i; ?>" required>
                        <span class="span-input">Cuota</span>
                    </div>
                    <div class="efecto-input">
                        <input type="number" step="any" id="cuotasPlan<?php echo $i; ?>" required>
                        <span class="span-input">N° Cuotas</span>
                    </div>
                    <div class="efecto-input">
                        <input type="number" step="any" id="lineaportarPlan<?php echo $i; ?>" required onkeypress="llamadas(event);">
                        <span class="span-input">linea a portar</span>
                    </div>
                    <div class="operador">
                        <div class="efecto-input" style="width:calc(100% - 35px);">
                            <select name="operadoresSelect" id="operadorPlan<?php echo $i; ?>">
                                <?php echo $operadores; ?>
                            </select>
                            <span class="span-input">Operador</span>
                        </div>
                        <input type="button" value="+" onclick="añadirOperador()">
                    </div>
                    <div class="efecto-input">
                        <input type="number" step="any" id="rentaadelantadaPlan<?php echo $i; ?>" required>
                        <span class="span-input">Renta adelantada</span>
                    </div>
                </div>
                <!-- /* formulario de IMEI Y ISSEC */ -->
                <!-- IMEI -->
                <div class="producto">
                    <div class="imei">
                        <span onclick="BusqEquipo(<?php echo $i; ?>,1)">Telefono</span>
                        <div class="efecto-input" style="width:90%">
                            <div style="background: #80808066;width:100%;position:absolute;height: 100%;transform: translateX(-5px);"></div>
                            <input disabled type="number" step="any" id="imeiPlan<?php echo $i; ?>" required>
                            <span class="span-input">Imei</span>
                        </div>
                        <!-- Creacion de Inicial y Siacc -->
                        <div class="Inicial_Sissac">
                            <div class="efecto-input">
                                <input type="number" step="any" step="any" id="inicialPlan<?php echo $i; ?>" required>
                                <span class="span-input">Inicial</span>
                            </div>
                            <div class="efecto-input">
                                <input type="number" step="any" step="any" id="imeiSisacPlan<?php echo $i; ?>" required>
                                <span class="span-input">Sisac</span>
                            </div>
                        </div>
                        <div class="efecto-input" style="width:100%;height:100px;">
                            <div style="background: #80808066;width:100%;position:absolute;height: 100%;transform: translateX(-5px);"></div>
                            <textarea disabled  id="imeiAreaPlan<?php echo $i; ?>" class="Area_imei">Marca: 
Modelo: 
Color:
                            </textarea>
                        </div>
                    </div>
                    <!-- ICC -->
                    <div class="imei">
                        <span onclick="BusqEquipo(<?php echo $i; ?>,2)">Chip</span>
                        <div class="efecto-input" style="width:80%">
                            <div style="background: #80808066;width:100%;position:absolute;height: 100%;transform: translateX(-5px);"></div>
                            <input disabled type="number" step="any" id="iccPlan<?php echo $i; ?>" required>
                            <span class="span-input">Icc</span>
                        </div>
                        <!-- Creacion de Inicial y Siacc -->
                        <div class="Inicial_Sissac">
                            <div class="efecto-input">
                                <input type="number" step="any" id="precioPlan<?php echo $i; ?>" required>
                                <span class="span-input">Precio</span>
                            </div>
                            <div class="efecto-input">
                                <input type="number" id="iccSisacPlan<?php echo $i; ?>" required>
                                <span class="span-input">Sisac</span>
                            </div>
                        </div>
                        <div class="efecto-input" style="width:100%;height:100px;">
                            <div style="background: #80808066;width:100%;position:absolute;height: 100%;transform: translateX(-5px);"></div>
                            <textarea disabled id="iccAreaPlan<?php echo $i; ?>" class="Area_icc">Marca: 
Modelo: 
Color:
                            </textarea>
                        </div>
                    </div>
                </div>
                <!-- ------------------------------Checkbox------------------------ -->
                <div class="conte-check">
                    <div>
                        <input type="checkbox"  class="check"  id=""/>
                        <label style="margin-left:5px;"> >= 90 DIAS</label>
                    </div>
                    <div>
                        <input type="checkbox" class="check" id=""/>
                        <label style="margin-left:5px;">  >= CF65</label>
                    </div>
                    <div>
                        <input type="checkbox" class="check" id=""/>
                        <label style="margin-left:5px;"> < CF65 </label>
                    </div>
                </div>
                <div class="conte-check">
                    <div style="display:flex;">
                        <input type="checkbox"  class="check"  id=""/>
                        <label style="margin-left:5px;"> Up-SELL</label>
                    </div>
                    <div style="display:flex;">
                        <input type="checkbox" class="check" id=""/>
                        <label style="margin-left:5px;">Cross-Sell</label>
                    </div>
                </div>
            </div>
            <?php } ?>
        <div class="conte_Pedilibre">

            <div class="pedilibre borde">
                <!-- Inicial Renta Cargo -->
                <div id="tapa4" class="tapar"></div>
                <div class="Peso-venta" style="left:auto;right: 0;background:yellow;color:red; cursor: alias;">
                    <span id="PesoVenta4">PESO VENTA: 0.0</span>
                </div>
                <div onclick="presionarCheck(4)" class="Titulo-plan">
                    <input type="checkbox" id="Plan4">
                    <span>HFC - Migracion sin imei/icc</span>
                </div>
                <div class="conte_plan-planes">
                    <div class="bordeTipoPlanes" >
                        <div onclick="tipoPlanSelect(<?php echo $i; ?>,'O');">
                            <label>Postopago</label>
                            <input id="Postpago<?php echo $i; ?>" type="checkbox" style="display:none"/>
                        </div>
                        <div onclick="tipoPlanSelect(<?php echo $i; ?>,'E');">
                            <label>Prepago</label>
                            <input id="Prepago<?php echo $i; ?>" type="checkbox" style="display:none"/>
                        </div>
                    </div>
                    <div class="efecto-input" style="padding:0;">
                        <select disabled id="seleccionPlan4"></select>
                        <span class="span-input">HFC/MIGRACIÓN SIN CHIP</span>
                    </div>
                </div>
                <div class="conte_plan-planes">
                    <div class="efecto-input">
                        <input id="inicialPedido" type="number" step="any" required>
                        <label class="span-input">INICIAL</label>
                    </div>
                    <div class="efecto-input">
                        <input id="rentaPedido" type="number" step="any" required>
                        <label class="span-input">RENTA AD.</label>
                    </div>
                    <div class="efecto-input">
                        <input id="cargofijoPedido" type="number" step="any" required>
                        <label class="span-input">CARGO FIJO</label>
                    </div>
                    <div class="operador">
                        <div class="efecto-input" style="width:calc(100% - 35px);">
                            <select name="operadoresSelect" id="operadorPlan4">
                                <?php echo $operadores; ?>
                            </select>
                            <span class="span-input">Operador</span>
                        </div>
                        <input type="button" value="+" onclick="añadirOperador()">
                    </div>
                    <div class="efecto-input">
                        <input type="number" step="any" id="lineaPedido<?php echo $i; ?>" required onkeypress="llamadas(event);">
                        <label class="span-input">Linea / Número a portar</label>
                    </div>
                <!-- ------------------- -->
                    <!-- --------primero--- -->
                    <div class="efecto-input">
                        <input id="fechanacPedido" type="date" step="any">
                        <label class="span-input">Fecha de nacimiento</label>
                    </div>
                    <div class="efecto-input">
                        <input id="lugarnacPedido" type="text" step="any" required>
                        <label class="span-input">Lugar de nacimiento</label>
                    </div>
                    <div class="efecto-input">
                        <input id="fechaAgendPedido" type="date" >
                        <label class="span-input">Fecha agendada</label>
                    </div>
                    <div class="efecto-input">
                        <input id="P-nombrePedido" type="text" required>
                        <label class="span-input">Nombre del Padre</label>
                    </div>
                    <div class="efecto-input">
                        <input id="M-nombrePedido" type="text" required>
                        <label class="span-input">Nombre del Padre</label>
                    </div>
                </div>

            </div>
            <div class="pedilibre-none">

            </div>
        </div>
    </div>
        <!-- ----------final-------- -->
        <!-- -----modal almacen---- -->

        <div id="miModal" class="modal">
            <div class="flex" id="flex">
                <div class="contenido-modal">
                    <div class="modal-header flex">
                        <h2>ALMACEN</h2>
                        <span class="close" id="close">&times;</span>
                    </div>
                    <div class="modal-body">

                    <div style="display:flex; flex-direction: row; justify-content:space-around">
                        <div style="display:flex; flex-direction: row ">
                           <label class="Ingresa-modal">Ingresar Tipificación: </label><input id="ingTipfAlmacen" type="text" />
                        </div>                 
                                  <div style="display:flex;  flex-direction: column;  justify-content: center;">
                                    <h1 style="text-align: center;font-size: 15px;color: red;">CHECK REPORTE</h1>   
                                    <input  id="repo_almacen" class="modal_check"type="checkbox" />
                                </div>    
                        </div>    
                                            
                                            <br>
                        <input type="button" onclick="botonAlmacen()" id="modalbuttonAlmacen" class="button" value="GUARDAR">
                    </div>

                </div>
            </div>
        </div>


        <!-- ------------ -->
        <!-- -----modal alfiliacion---- -->

        <div id="miModalAfili" class="modalAfili">
            <div class="flexAfili" id="flexAfili">
                <div class="contenido-modalAfili">


                    <div class="modal-headerAfili flexAfili">
                        <h2>AFILIACION</h2>
                        <span class="closeAfili" id="closeAfili">&times;</span>
                    </div>
                    <div class="modal-bodyAfili">
                        

                    <div style="display:flex; flex-direction: row; justify-content:space-around">
                        <div style="display:flex; flex-direction: row ">

                    <label class="Ingresa-modal">Ingresar Tipificación: </label>
                    <input id="ingTipAfili" type="text" />
                    </div>
                                           
                           <div style="display:flex;  flex-direction: column;  justify-content: center;">
                                    <h1 style="text-align: center;font-size: 15px;color: red;">CHECK REPORTE</h1>   
                                    <input  id="repo_afili" class="modal_check"type="checkbox" />
                                </div>    
                        

                        </div>


                        <br>
                        <input type="button" id="modalbuttonAfili" onclick="botonAfili()" class="button" value="GUARDAR">
                    </div>

                </div>
            </div>
        </div>


        <!-- ------------ -->
        <!-- -----modal Validacion---- -->

        <div id="miModalVali" class="modalVali">
            <div class="flexVali" id="flexVali">
                <div class="contenido-modalVali">
                    <div class="modal-headerVali flexVali">
                        <h2>VALIDACION</h2>
                        <span class="closeVali" id="closeVali">&times;</span>
                    </div>
                    <div class="modal-bodyVali">

                    <div style="display:flex; flex-direction: row; justify-content:space-around">
                        <div style="display:flex; flex-direction: row ">
                        <label class="Ingresa-modal">Ingresar Tipificación: </label>
                        <input id="ingTipVali" type="text" />
                        </div>
                        
                        <div style="display:flex;  flex-direction: column;  justify-content: center;">
                                    <h1 style="text-align: center;font-size: 15px;color: red;">CHECK REPORTE</h1>   
                                    <input  id="repo_valida" class="modal_check"type="checkbox" />
                                </div>   
                                
                        </div>
                        
                        
                        
                        <br>
                        <input type="button" id="modalbuttonVali" onclick="botonVali()" class="button" value="GUARDAR">
                    </div>

                </div>
            </div>
        </div>


        <!-- ------------ -->
        <!-- -----modal DESPACHO    ---- -->

        <div id="miModalDes" class="modalDes">
            <div class="flexDes" id="flexDes">
                <div class="contenido-modalDes">
                    <div class="modal-headerDes flexDes">
                        <h2>DESPACHO</h2>
                        <span class="closeDes" id="closeDes">&times;</span>
                    </div>
                    <div class="modal-bodyDes">


                    <div style="display:flex; flex-direction: row; justify-content:space-around">
                        <div style="display:flex; flex-direction: row ">

                        <label class="Ingresa-modal">IngresarTipificación: </label>
                        <input id="ingTipDes" type="text" />
                        </div>



                        <div style="display:flex;  flex-direction: column;  justify-content: center;">
                                    <h1 style="text-align: center;font-size: 15px;color: red;">CHECK REPORTE</h1>   
                                    <input  id="repo_des" class="modal_check"type="checkbox" />
                                </div>   
                        </div>
                        <br>
                        <input type="button" id="modalbuttonDes" onclick="botonDes()"class="button" value="GUARDAR">
                    </div>

                </div>
            </div>
        </div>


        <!-- ------------ -->
        <!-- -----modal Acticacion---- -->

        <div id="miModalActi" class="modalActi">
            <div class="flexActi" id="flexActi">
                <div class="contenido-modalActi">
                    <div class="modal-headerActi flexActi">
                        <h2>ACTIVACION</h2>
                        <span class="closeActi" id="closeActi">&times;</span>
                    </div>
                    <div class="modal-bodyActi">

                    <div style="display:flex; flex-direction: row; justify-content:space-around">
                        <div style="display:flex; flex-direction: row ">

                        <label class="Ingresa-modal">Ingresar Tipificación: </label>
                        <input id="ingTipActi" type="text" />
                        </div>
                        <div style="display:flex;  flex-direction: column;  justify-content: center;">
                                    <h1 style="text-align: center;font-size: 15px;color: red;">CHECK REPORTE</h1>   
                                    <input  id="repo_acti" class="modal_check"type="checkbox" />
                                </div>   
                        </div>
                        
                        <br>
                        <input type="button" id="modalbuttonActi" onclick="botonActi()"class="button" value="GUARDAR">
                    </div>

                </div>
            </div>
        </div>


        <!-- ------------ -->
        <!-- -----modal HFC---- -->

        <div id="miModalHfc" class="modalHfc">
            <div class="flexHfc" id="flexHfc">
                <div class="contenido-modalHfc">
                    <div class="modal-headerAfili flexHfc">
                        <h2>VALIDADOR HFC</h2>
                        <span class="closeHfc" id="closeHfc">&times;</span>
                    </div>
                    <div class="modal-bodyHfc">
                        

                    <div style="display:flex; flex-direction: row; justify-content:space-around">
                        <div style="display:flex; flex-direction: row ">


                    <label class="Ingresa-modal">Ingresar Tipificación: </label>
                        <input id="ingTipHfc" type="text" />
                        </div>
                        <div style="display:flex;  flex-direction: column;  justify-content: center;">
                                    <h1 style="text-align: center;font-size: 15px;color: red;">CHECK REPORTE</h1>   
                                    <input  id="repo_hfc" class="modal_check"type="checkbox" />
                                </div>   
                        
                        
                        </div>
                        <br>
                        <input type="button" id="modalbuttonHfc" onclick="botonHfc()" class="button" value="GUARDAR">
                    </div>

                </div>
            </div>
        </div>

         <!-- modal cliente Ingresar        -->

    <div id="miModalCli" class="modal">
            <div class="flex" id="flexCli">
                <div class="contenido-modal">
                    <div class="modal-header flex">
                        <h2>NUEVO CLIENTE</h2>
                        <span class="close" id="closeCli">&times;</span>
                    </div>
                    <div class="modal-body" style="height: 220px;">
                        <div style="width: 100%;display:flex;flex-direction: row;justify-content: space-around;">
                           <div> <label style="font-weight: 600;font-size: 15px;">PERSONA NATURAL</label><input type="radio"   value="N"id="mostrarNatural" onclick="mostrarNatural()"name="perfil"/></div>
                            <div><label style="font-weight: 600;font-size: 15px;">PERSONA JURIDICA </label><input type="radio" value="J"id="mRazon" onclick="mRazon()" name="perfil"/></div>
                        </div>

                        <div  style="display:none;" id="mostratNatural">
                        
                            <div >
                                <label class="packform_label">DNI :</label>
                                <input type="text" class="packform_input"  id="ingreso_dni">  <a href="https://eldni.com/pe/buscar-por-dni" target="_blank">
                                <input type="button" class="verificacion" value="DNI"></a>
                           
                            </div>
                            
                            <div>
                                <label class="packform_label">NOMBRE : </label>
                                <input type="text" class="packform_input"  id="ingreso_Nombre">
                            </div>
                            <div >
                            
                                <label class="packform_label">APELLIDO : </label>
                                <input type="text" class="packform_input"  id="ingreso_Apellido">
                            </div>
                            <div>
                                <label class="packform_label">CORREO : </label>
                                <input type="text" class="packform_input"  id="ingreso_Correo"> <a href="https://www.verifyemailaddress.org/es/validacion-de-email" target="_blank">
                                <input type="button" class="verificacion" value="Email"></a>
                            </div> 
                                <div style="width: 100%;display:flex;justify-content: center;">   
                                    <input type="button" onclick="botonCliente()" id="modalbuttonCliente" class="buttonCliente" value="GUARDAR CLIENTE"/>
                                </div>
                            </div>
                           
                           
                                <div id="mostrarRazon" style="display:none">
                            <div class="packform">
                                <label class="packform_label">RUC :</label>
                                <input type="text" class="packform_input"  id="ingresa_RUC">
                            </div>
                            
                            <div class="packform">
                                <label class="packform_label">RAZON SOCIAL: </label>
                                <input type="text" class="packform_input"  id="Ingresa_Razon"><a href="https://e-consultaruc.sunat.gob.pe/cl-ti-itmrconsruc/FrameCriterioBusquedaWeb.jsp" target="_blank">
                                <input type="button" class="verificacion" value="RUC"/></a>
                            </div>
                       
                            <div class="packform">
                                <label class="packform_label">CORREO : </label>
                                <input type="text" class="packform_input"  id="Razon_correo"><a href="https://www.verifyemailaddress.org/es/validacion-de-email" target="_blank">
                                <input type="button" class="verificacion" value="Email"/></a>
                            </div>
                            <div class="packform">
                                <label class="packform_label">DISTRITO: </label>
                                <select class="packform_input" id="Razon_Distrito" name="distrito">
                                    <?php
                                        for($i=0;$i<count($distritos);$i++){
                                        echo "<option value='$distritos[$i]'>$distritos[$i]</option>";
                                        } 
                                    ?>
                                </select>
                                
                            </div>
                            <div class="packform">
                                <label class="packform_label">DIRECCION: </label>
                                <input type="text" class="packform_input"  id="Razon_direc">
                            </div>
                            <div style="width: 100%;display:flex;justify-content: center;">
                                     <input type="button" class="buttonCliente" onclick="botonRazon()" id="modalbuttonRuc" value="GUARDAR DATOS"/>
                            </div>
                     </div>
                </div>
            </div>
        </div>
        <!-- modal sobre reclamo -->
        <div id="miModalRe" class="modal">
            <div class="flex" id="flexRe">
                <div class="contenido-modal">
                    <div class="modal-header flex">
                        <h2>RECLAMO</h2>
                        <span class="close" id="closeRe">&times;</span>
                    </div>
                    <div class="modal-body">

                    <div style="display:flex; flex-direction: row; justify-content:space-around">
                        <div style="display:flex; flex-direction: row ">
                           <label class="Ingresa-modal">Ingresar Reclamo: </label><input id="ingReclamo" type="text" />
                        </div>                 
                                  <div style="display:flex;  flex-direction: column;  justify-content: center;">
                                    <h1 style="text-align: center;font-size: 15px;color: red;">CHECK REPORTE</h1>   
                                    <input  id="repo_reclamo" class="modal_check"type="checkbox" />
                                </div>    
                        </div>    
                                            
                                            <br>
                        <input type="button" onclick="botonReclamo()"  class="button" value="GUARDAR">
                    </div>

                </div>
            </div>
        </div>
    </div>
        
    <div id="miModalLLa" class="modalLLa">
        <div class="flexLLa" id="flexLLa">
            <div class="contenido-modalLLa">
                <div class="modal-headerAfili flexLLa" style="height: 120px;">
                    <h2 style="font-size: 20px;">COORDINADOR VIRTUAL</h2>
                    <div style=" display:flex; width:30%;justify-content: space-between;text-align: center;">
                        <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
                        <script src="//code.jquery.com/jquery-1.9.1.js"></script>
                        <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

                        <button onclick="abrirmod(1,1)" class="borde boton_modal_img ">
                            <img src="https://cdn-icons-png.flaticon.com/512/768/768818.png" style="width: 50px;height: 50px;">
                            SPEECH
                        </button>
                        <button onclick="abrirmod(2,1)" class="boton_modal_img borde">
                            <img src="https://cdn-icons-png.flaticon.com/512/768/768818.png" style="width: 50px;height: 50px;">
                            Planes
                        </button>
                        <button onclick="abrirmod(3,1)" class="boton_modal_img borde ">
                            <img src="https://cdn-icons-png.flaticon.com/512/768/768818.png" style="width: 50px;height: 50px;">
                            GRABACION LEGAL
                        </button>
                        <div id="dialog-modal1" title="SPEECH DE VENTAS" style="display:none;">
                            <div></div>
                            <p></p> 
                        </div>
                        <div id="dialog-modal2" title="PLANES" style="display:none;">
                            <div></div>
                            <p></p>
                        </div>
                        <div id="dialog-modal3" title="GRABACION LEGAL" style="display:none;">
                            <div></div>
                            <p></p>
                        </div>
                    </div>
                    <div style="display: flex;align-items: center;">
                        <p  style="margin: 0 5px;line-height: 34px;font-size: 20px;"><?php  ?></p>
                        <label type="text" id="Nasesor" style="margin: 0 5px;line-height: 34px;font-size: 20px;"><?php echo $_SESSION["nombre"];?></label>
                        <span class="closeLLa" id="closeLLa" onclick="resetSelect()">&times;</span>
                    </div>
                </div>
                <div class="modal-bodyLLa">

                    <!-- --------------- contenido asesor----------------- -->

                    <div class="modal-asesor">
                    <div class="modal-asesor1">
                        <div class="conte-asesor">
                            <div class="asesor-Ate">
                                <label class="conte-peso-ASE">PESO VENTA:</label>
                                <p id="pesoVenta" class="peso-span">0 </p>
                            </div>
                            <div class="asesor-Ate">
                                <label class="conte-peso-ASE">CUOTA:</label>
                                <p id="cuota" class="asesor-span">   </p>
                            </div>
                            <div class="asesor-Ate">
                                <label class="conte-peso-ASE">TIPO:</label>
                                <p id="tipo" class="asesor-span">   </p>
                            </div>
                            <div class="asesor-Ate">
                                <label class="conte-peso-ASE">ESTADO:</label>
                                <p id="estado" class="asesor-span">  </p>
                            </div>
                            <div class="asesor-Ate">
                                <label class="conte-peso-ASE">COORDINADOR:</label>
                                <p id="coord" class="asesor-span">    </p>
                            </div>
                        </div>
                        <div class="lla-conte">
                            <label class="Ingresa-modal">CLIENTE:</label>
                            <input id="LLamadaCli" type="text"  class="lla-input" disabled>
                        </div>

                        <div class="lla-conte">
                            <label class="Ingresa-modal">DNI:</label>
                            <input id="llamadaDni" type="number" step="any"  class="lla-input-dni" required disabled>
                        </div>
                        <div class="lla-conte">
                            <label class="Ingresa-modal">TELEF RE:</label>
                            <input id="llamadaTelefRef" type="number" step="any"  class="lla-input-ref" onkeypress="llamadas(event);" disabled>
                        </div>
                        <div class="lla-conte">
                            <!-- ------------------------contenido provincia----- -->
                            <label class="Ingresa-modal">TIPIFICACION 1:</label>
                            <select id="tipificacion" onchange="tipfGuardar()" class="tipificacion" name="tipificacion" >
                                <option value=""> </option>
                                <option value="CONTACTO EFECTIVO">CONTACTO EFECTIVO</option>
                                <option value="CONTACTO NO EFECTIVO">CONTACTO NO EFECTIVO</option>
                                <option value="NO CONTACTO">NO CONTACTO</option>
                                <!-- <option value="INFORMATIVO">INFORMATIVO</option> -->
                            </select>
                        </div>
                        <div class="lla-conte">
                            <label class="Ingresa-modal">TIPIFICACION 2:</label>
                            <select id="prueba"  class="subtipificacion" onchange="tipif()">
                                <option id="prueba0" value=""></option>
                                <option id="prueba1" value="" style="display:none"></option>
                                <option id="prueba2" value="" style="display:none"></option>
                                <option id="prueba3" value="" style="display:none"></option>
                                <option id="prueba4" value="" style="display:none"></option>
                                <option id="prueba5" value="" style="display:none"></option>
                            </select>
                        </div>
                        <div class="lla-conte">
                            <label class="Ingresa-modal">DISTRITO LIMA:</label>
                            <select class="distrito" id="LlaDistrito" name="distrito">
                                <?php
                                    for($i=0;$i<count($distritos);$i++){
                                    echo "<option value='$distritos[$i]'>$distritos[$i]</option>";
                                    } 
                                ?>
                            </select>
                        </div>
                        <div class="lla-conte">
                            <label class="Ingresa-modal">PROVINCIA:     </label>
                            <input type="text" name="" id="Llaprov" disabled>
                        </div>
                    </div>
                    <!-- --------------------finde conte asor 1 -->
                    <div class="modal-asesor2" >
                        <!-- <a href="tel:" onclick="if(cantidad!=9){return false;}else{return true;}" id="Llamada"><img src="https://wiki.2n.com/hip/inte/files/latest/en/32544241/32544246/1/1544099426085/MicroSIP.png" width="40px" class="llamada"></a><br/> -->
                        <div>
                            <input type="button"  id="regis_tipf" class="Guardar_tipf" value="SOLICITAR CLIENTE"/>
                        </div>
                        <div style="display:flex;justify-content:space-around ;">
                            <a href="" onclick="inicioLlamada()" style="margin-top:5px;" id="Llamada_2"><img src="https://wiki.2n.com/hip/inte/files/latest/en/32544241/32544246/1/1544099426085/MicroSIP.png" width="70px" class="llamada"></a>
                            <a href="" target="_BLANCK" id="WhatsApp_2"><img src="./assets/bxl-whatsapp.svg" width="80px" class="llamada"></a>
                        </div>
                        <!-- <div style="display:flex;justify-content:center ;"><input type="button"  id="venta_tipf" class="venta_tipf" onclick="resVenta()" value="REGISTRAR Y LLENAR FICHA" ></div> -->
                    </div>
                    <div class="modal-asesor3">
                        <div>
                            <div style="float:rigth;border:solid 3px black; height  :50px;">

                            </div>
                        </div>
                        <div>
                            <table style="border: 1px solid rgb(216 32 32);">
                                <thead>
                                    <tr>
                                        <th rowspan="2">Tipo</th>
                                        <th >Dia</th>
                                        <th >Total</th>
                                    </tr>
                                    <!-- <tr>
                                        <th style="display:none"></th>
                                        <th>#</th>
                                        <th>Dura.</th>
                                        <th>#</th>
                                        <th>Dura.</th>
                                    </tr> -->
                                </thead>
                                <tbody id="calcuRegis">
                                    <tr>
                                        <td>CONTACTO EFECTIVO</td>
                                        <td>0</td>
                                        <!-- <td>00:00:49</td> -->
                                        <td>0</td>
                                        <!-- <td>01:05:29</td> -->
                                    </tr>
                                    <tr>
                                        <td>CONTACTO NO EFECTIVO</td>
                                        <td>0</td>
                                        <!-- <td>00:00:49</td> -->
                                        <td>0</td>
                                        <!-- <td>01:05:29</td> -->
                                    </tr>
                                    <tr>
                                        <td>NO CONTACTO</td>
                                        <td>0</td>
                                        <!-- <td>00:00:49</td> -->
                                        <td>0</td>
                                        <!-- <td>01:05:29</td> -->
                                    </tr>
                                    <tr>
                                        <td>TOTAL LLAMADAS</td>
                                        <td>0</td>
                                        <!-- <td>00:00:49</td> -->
                                        <td>0</td>
                                        <!-- <td>01:05:29</td> -->
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div>

                        </div>
                    </div>
                </div>
                <!-- ------------------------TABLA REGISTRO DE ASESORES-------------------- -->
                
                <div class="contenedor">
                <div class="conte-table" id="ta">
                <table >
                    <thead>
                    <tr style="position: sticky;top: 0;">
                        <th class="enca">ID</th>
                        <th class="enca">ClIENTE</th>
                        <th class="enca">DNI</th>
                        <th class="enca">TELF REFERENCIA</th>
                        <th class="enca">TIPIF 1</th>
                        <th class="enca">TIPIF 2</th>
                        <th class="enca">Fecha de llamada</th>
                        <th class="enca">ASESOR</th>
                    </tr>
                    </thead>
                    <tbody id="tbCli">
                    </tbody>
                </table>
                </div>
                </div>
                </div>
            </div>
        </div>
    </div>
        <!-- ------------------------ -->
    </div>
    <script>
        marca=(<?php echo json_encode($marca); ?>);
        colores=(<?php echo json_encode($colores); ?>);
        modelos=(<?php echo json_encode($modelos); ?>);
        // colores=JSON.parse("["+colores+"]");
        PesoVenta= JSON.parse('<?php if(count($PesoVenta)!=0){echo json_encode($PesoVenta);}else{echo json_encode([0]);} ?>')
        TipoPedido= '<?php echo $nombresPedidos[0]; ?>';
        DTipoPedido= <?php echo json_encode($nombresPedidos); ?>;
        datoPed= <?php echo json_encode($datosPedidos); ?>;
        carcar = setTimeout(function(){},200);
        cantidat = 0;
        i=0;
        id=0;
        horaped=new Date().toLocaleTimeString('en-En');
        Fecha = new Date();
        registroDefault=document.getElementById("calcuRegis").innerHTML;

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
        const BusqEquipo=(n,n2)=>{
            cadena="";
            console.log(n);
            document.getElementById("busq_equip_id").value=n;
            document.getElementById("busq_equip_tipo").value=n2;
            for(i=0;i<marca[n2].length;i++){
                cadena+="<option value='["+n2+","+marca[n2][i][0]+"]'>"+marca[n2][i][1]+" </option>";
            }
            document.getElementById("busq_equip_marca").innerHTML=cadena;
            cadena="";
            select=JSON.parse(document.getElementById("busq_equip_marca").value);
            for(i=0;i<modelos[select[0]][select[1]].length;i++){
                cadena+="<option value='"+modelos[select[0]][select[1]][i][0]+"'>"+modelos[select[0]][select[1]][i][1]+" </option>";
            }
            document.getElementById("busq_equip_modelo").innerHTML=cadena;
            cadena="";
            select=document.getElementById("busq_equip_modelo").value;
            for(i=0;i<colores[select].length;i++){
                cadena+="<option value='"+colores[select][i][0]+"'>"+colores[select][i][1]+" </option>";
            }
            document.getElementById("busq_equip_color").innerHTML=cadena;
            setTimeout(() => {
                document.getElementById("busqEdquip").style="opacity:1";
            }, 1);
            document.getElementById("busqEdquip").style="";
        }
        document.getElementById("BajarDescProducto").addEventListener('click',() => {
            document.getElementById("CerrarbusqEdquip").click();
            Marca=document.getElementById("busq_equip_marca").options[document.getElementById("busq_equip_marca").selectedIndex].text;
            Modelo=document.getElementById("busq_equip_modelo").options[document.getElementById("busq_equip_modelo").selectedIndex].text;
            Color=document.getElementById("busq_equip_color").options[document.getElementById("busq_equip_color").selectedIndex].text;
            if(document.getElementById("busq_equip_tipo").value=="1"){
                document.getElementById("imeiAreaPlan"+document.getElementById("busq_equip_id").value).innerHTML="Marca: '"+Marca+"'\nModelo: '"+Modelo+"'\nColor: '"+Color+"'";
            }
            else{
                document.getElementById("iccAreaPlan"+document.getElementById("busq_equip_id").value).innerHTML="Marca: '"+Marca+"'\nModelo: '"+Modelo+"'\nColor: '"+Color+"'";
            }
        });
        document.getElementById("CerrarbusqEdquip").addEventListener("click", ()=>{
            document.getElementById("busqEdquip").style="";
            setTimeout(() => {
                document.getElementById("busqEdquip").style="display:none";
            }, 300);
        });

        const presionarCheck = (n) => {
            if (document.getElementById("Plan" + n).checked) {
                document.getElementById("Plan" + n).checked = false;
            } else {
                document.getElementById("Plan" + n).checked = true;
            }
            ActivarPlan(n);
        }
        const tipoPlanSelect=(n,tip)=>{
            tipode="";PLanselect="";
            if (tip=="O") {tipode="Postpago"; document.getElementById("Prepago"+n).checked=false;}
            else {tipode="Prepago";document.getElementById("Postpago"+n).checked=false;}
            document.getElementById(tipode + n).click();
            document.getElementById(tipode + n).parentNode.parentNode.children[0].style="";
            document.getElementById(tipode + n).parentNode.parentNode.children[1].style="";
            if(document.getElementById(tipode+n).checked){
                document.getElementById("seleccionTipoPlan" + n).disabled = false;
                document.getElementById("seleccionTipoPlan" + n).innerHTML="";
                for(a=1;a<TipoPedido.length;a++) {
                    if(datoPed[tipode.toUpperCase()][DTipoPedido[a]]!=undefined){
                        document.getElementById("seleccionTipoPlan" + n).innerHTML += "<option value='"+DTipoPedido[a]+"'>"+DTipoPedido[a]+"</option>";
                    }
                }
                document.getElementById("seleccionPlan" + n).name = tipode;
                document.getElementById(tipode + n).parentNode.style="Background:blue;color:white";
                llenarPlanes(n);
                // document.getElementById("PesoVenta" + n).innerHTML = "PESO VENTA: "+PesoVenta[0];
            }
            else{
                document.getElementById("seleccionPlan" + n).innerHTML = "";
                document.getElementById("seleccionPlan" + n).name = "";
                document.getElementById("seleccionPlan" + n).disabled = true;
                document.getElementById("seleccionTipoPlan" + n).innerHTML = "";
                document.getElementById("seleccionTipoPlan" + n).disabled = true;
                document.getElementById("PesoVenta" + n).innerHTML = "PESO VENTA: 0.0";
            }
            ActivarPlan(n);
        }
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
        const añadirOperador= () => {
            Nuevo=prompt("Ingrese nombre del operador a añadir:");
            if(Nuevo==null || Nuevo==""){
                return 0;
            }
            if(confirm("¿Desea añadir el operador '"+Nuevo+"'")){
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log(this.response);
                        if(this.response!=""&&this.response!=null&&this.response!="null"){
                            selectop=document.getElementsByName("operadoresSelect");
                            for(i=0;i<selectop.length;i++){
                                selectop[i].innerHTML=this.response;
                            }
                        }
                        else{
                        }
                        console.log("bajó");
                    }
                };
                console.log("subiendo");
                xmlhttp.open("POST", "./comun.php",true);
                data = new FormData();
                data.append("q","agregarOperador")
                data.append("operador",Nuevo)
                xmlhttp.send(data);
            }
        }

        const ActivarPlan = (n) => {
            if (document.getElementById("Plan" + n).checked) {
                document.getElementsByClassName("Titulo-plan")[n-1].style.background = "gray";
                document.getElementsByClassName("Titulo-plan")[n-1].style.boxShadow= "#00000061 7px 7px 8px 2px";
                document.getElementById("tapa" + n).style.height = "0";
                document.getElementById("tapa" + n).style.width = "0";
                document.getElementById("tapa" + n).style.translate= "10px -20px";
                document.getElementById("tapa" + n).style.borderRadius = "50%";
            } else {
                document.getElementsByClassName("Titulo-plan")[n-1].style = "";
                document.getElementById("tapa" + n).style.height = "";
                document.getElementById("tapa" + n).style.height = "";
                document.getElementById("tapa" + n).style.width = "";
                document.getElementById("tapa" + n).style.translate= "";
                document.getElementById("tapa" + n).style.borderRadius = "";
            }
        }

        const llamadas = (e) => {
            console.log(e);
            n=e.path[0].value;
            console.log(n.length);
            if(n.length<9){
                if(e.path[0].id=="telefRefCliente1"){
                    // document.getElementById("WhatsApp").href = "https://wa.me/+51" + n + "?text=Prueba";
                    // document.getElementById("Llamada").href = "tel:" + n;
                }
            }
            else{
                e.path[0].value=e.path[0].value.substring(0,e.path[0].value.length-1);
            }
        }

        const buscar = () => {
            clearInterval(carcar);
            carcar = setTimeout(function(){obtener();},500);
        }
        
        const calcuregis = () => {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if(this.response!=""&&this.response!=null&&this.response!="null"){
                        document.getElementById("calcuRegis").innerHTML=this.response;
                    }
                    else{
                        document.getElementById("calcuRegis").innerHTML=registroDefault;
                    }
                }
            };
            xmlhttp.open("POST", "./comun.php",true);
            data = new FormData();
            data.append("q","calcuregis")
            xmlhttp.send(data);
        }

        const obtener = () => {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if(this.response!=""&&this.response!=null&&this.response!="null"){
                        document.getElementById("tbCli").innerHTML=this.response;
                        calcuregis();
                    }
                    else{
                        document.getElementById("tbCli").innerHTML="";
                        document.getElementById("calcuRegis").innerHTML=registroDefault;
                        alertify.error("No se encontraron registros de esta persona");
                    }
                }
            };
            xmlhttp.open("POST", "./comun.php",true);
            data = new FormData();
            data.append("q","obtener")
            xmlhttp.send(data);
        }

        const tipif = () => {
            tipif1=document.getElementById('tipificacion');
            document.getElementById("LlaDistrito").disabled=false;
            document.getElementById("Llaprov").disabled=true;
            document.getElementById("Llaprov").value="";
            if(document.getElementById("LLamadaCli").value!=""){
                document.getElementById("regis_tipf").value="GRABAR TIPIFICACION";
            }
            else{
                document.getElementById("regis_tipf").value="SOLICITAR CLIENTE";
            }
            if(tipif1.value=="CONTACTO EFECTIVO"){
                tipif2=document.getElementById('prueba');
                if(tipif2.selectedIndex==0){
                    if(document.getElementById("regis_tipf").value=="GRABAR TIPIFICACION"){
                        document.getElementById("regis_tipf").value="GRABAR VENTA";
                    }
                    document.getElementById("LlaDistrito").disabled=true;
                    document.getElementById("LlaDistrito").selectedIndex=0;
                }
                else if(tipif2.selectedIndex==5){
                    document.getElementById("LlaDistrito").disabled=true;
                    document.getElementById("Llaprov").disabled=false;
                }
            }
        }

        // chechk
        const resVenta = () => {
            botonCliente();
            let cliente = document.getElementById('LLamadaCli').value;
            let DNI = document.getElementById('llamadaDni').value;
            let ref = document.getElementById('llamadaTelefRef').value;

            document.getElementById('cliente').value=cliente;
            document.getElementById('dniCliente').value=DNI;
            document.getElementById('telefRefCliente1').value=ref;
            
            document.getElementById('miModalLLa').style.display = 'none';
            
        }

        function validacion(id){
            input=document.getElementById(id);
            if (input.value === '') {
                input.style.backgroundColor = '';
            } else {
                input.style.backgroundColor = 'lime';
            }
        }

        document.getElementById("regis_tipf").addEventListener("click",function(){
            if(document.getElementById('LLamadaCli').value==""){
                //solicitar
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        if(this.respose!=""&&this.response!=null&&this.response!="null"){
                            console.log(this.response);
                            var data=$.parseJSON(this.response);
                            if(data[0]!=""){
                                horaped=new Date().toLocaleTimeString('en-En');
                                document.getElementById("regis_tipf").value="GRABAR TIPIFICACION";
                                id=data[0];
                                document.getElementById("LLamadaCli").value=data[1];
                                document.getElementById("llamadaDni").value=data[2];
                                document.getElementById("llamadaTelefRef").value=data[3];
                                document.getElementById("Llamada_2").href="tel:"+data[3];
                                document.getElementById("WhatsApp_2").href="https://wa.me/+51"+data[3]+"?text=Prueba";
                            }
                        }
                        else{
                            i=i-1;
                            alertify.error("No hay más números para llamar");
                        }
                    }
                };
                xmlhttp.open("POST", "./comun.php",true);
                data = new FormData();
                data.append("q","bajar_data")
                xmlhttp.send(data);
            }
            else{
                //tipificar
                let cliente = document.getElementById('LLamadaCli').value;
                let DNI = document.getElementById('llamadaDni').value;
                let ref = document.getElementById('llamadaTelefRef').value;
                let tif1 = document.getElementById('tipificacion').value;
                prueba=document.getElementById('prueba');
                let tif2 = prueba.options[prueba.selectedIndex].text;
                // let inicio = document.getElementById('horaIngreso').innerText;
                // let muerto  = document.getElementById('tiempoMuerto').innerText;
            
                if(cliente==""||DNI==""||ref==""||tif1==""){
                    alertify.error("Rellene todos los campos por favor");
                    i=i-1;
                }
                else{
                    i=0;
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            if(this.respose!=""&&this.response!=null&&this.response!="null"){
                                if(document.getElementById("regis_tipf").value=="GRABAR VENTA"){
                                    resetSelect();
                                    document.getElementById('cliente').value = document.getElementById('LLamadaCli').value;
                                    document.getElementById('dniCliente').value = document.getElementById('llamadaDni').value;
                                    document.getElementById('telefRefCliente1').value = document.getElementById('llamadaTelefRef').value;
                                    document.getElementById('closeLLa').click();
                                    alerta.bien("Tipifique datos de la venta por favor");
                                }
                                document.getElementById("regis_tipf").value="SOLICITAR CLIENTE";
                                document.getElementById('LLamadaCli').value="";
                                document.getElementById('llamadaDni').value="";
                                document.getElementById('llamadaTelefRef').value="";
                                document.getElementById('tipificacion').value="";
                                prueba.selectedIndex=0;
                                obtener();
                                tipfGuardar();
                            }
                            else{
                                console.log(this.response);
                                alertify.error("No se pudo guardar la tipificacion");
                            }
                        }
                    };
                    xmlhttp.open("POST", "./comun.php",true);
                    data = new FormData();
                    data.append("q","subir_data")
                    data.append("asesor",asesor)
                    data.append("tipif1",tif1)
                    data.append("tipif2",tif2)
                    data.append("id",id)
                    xmlhttp.send(data);
                }
            }
        });

        const inicioLlamada=()=>{
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if(this.respose!=""&&this.response!=null&&this.response!="null"){
                        alertify.success("Llamada iniciada a las "+Fecha.toLocaleTimeString("en-En")+".");
                    }
                    else{
                        alertify.error("No hay más números para llamar");
                    }
                }
            };
            xmlhttp.open("POST", "./comun.php",true);
            data = new FormData();
            data.append("q","inicioLlamada");
            data.append("id",id);
            xmlhttp.send(data);
        }
        buscar();
        document.getElementById("busq_equip_marca").addEventListener("change",(pos)=>{
                select=JSON.parse(pos.path[0].value);
                cadena="";
                for(i=0;i<modelos[select[0]][select[1]].length;i++){
                    cadena+="<option value='"+modelos[select[0]][select[1]][i][0]+"'>"+modelos[select[0]][select[1]][i][1]+" </option>";
                }
                document.getElementById("busq_equip_modelo").innerHTML=cadena;
                cadena="";
                select=document.getElementById("busq_equip_modelo").value;
                for(i=0;i<colores[select].length;i++){
                    cadena+="<option value='"+colores[select][i][0]+"'>"+colores[select][i][1]+" </option>";
                }
                document.getElementById("busq_equip_color").innerHTML=cadena;
            }
        );
        document.getElementById("busq_equip_modelo").addEventListener("change",(pos)=>{
                select=pos.path[0].value;
                cadena="";
                for(i=0;i<colores[select].length;i++){
                    cadena+="<option value='"+colores[select][i][0]+"'>"+colores[select][i][1]+" </option>";
                }
                document.getElementById("busq_equip_color").innerHTML=cadena;
                console.log(colores[select].keys);
                console.log(cadena);
            }
        );

        const clickDivInput=()=>{
            elemento=document.getElementsByClassName("efecto-input");
            for(i=0;i<elemento.length;i++){
                elemento[i].addEventListener("click",(pos)=>{
                    try {pos.path[0].children[0].focus();} catch (error) {}
                    }
                );
            }
            for(n=1;n<5;n++){
                document.getElementById("seleccionPlan"+n).addEventListener("change",(pos)=>{
                        id=pos.path[0].id.substr(-1);
                        select=pos.path[0].value;
                        if(select>=0){
                            document.getElementById("PesoVenta" + id).innerHTML = "PESO VENTA: "+PesoVenta[select];
                        }
                        console.log(select);
                    }
                );
            }
        }
        clickDivInput();

    </script>
    <script src="modal.js"></script>
    <script src="SelectTipf.js"></script>
    <script src="Registrar.js"></script>
    <script>
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        SPEECH=["<img width='100%' src='./assets/4bf714a0-5a6f-4031-b7ba-11386d6d2d82.jpg'>"];
        planes=["<img heigth='100%' src='./assets/9f7fdafc-7292-45f4-afe5-1adc51a0ab78.jpg'>"];
        // SPEECH=["SALUDO:<br>BUENOS DIAS - TARDES <br><br>CLIENTE CONTESTA: SI, ¿Quien HABLA?<br>HOLA, ¿Cómo ESTÀS? TE SALUDA (NOMBRE/APELLIDO) DEL AREA DE PROMOCIONES DE LA COMPAÑÍA CLARO... ¿ME COMUNICO CON EL TITULAR DE LA LINEA? <br><br>CLIENTE INDICA QUE SI SOMOS DE LA COMPAÑÍA CLARO Y QUEREMOS OFRECERLE UNA PROMOCION DE PORTABILIDAD. <br><br>CLIENTE INDICA QUE NO: <br>SOLO SERAN UNOS BREVES MINUTOS....<br><br><hr><br>SONDEO:<br>UNA PREGUNTA. ¿Cuál ES SU NOMBRE?<br>CLIENTE ACCEDE A BRINDARME SU NOMBRE(.......))<br>PERFECTO (NOMBRE DE CLIENTE), COMENTAME:<br>-¿EN QUE OPERADOR SE ENCUENTRA? OSEA SI ES MOVISTAR, ENTEL O BITTEL<br>-¿USTED REALIZA RECARGAS O PAGA MENSUAL?<br>-¿CUÁNTO RECARGA O PAGAS?<br>-¿Qué UTILIZA MAS, INTERNET, MENSAJES, LLAMADAS?"];
        grabaLeg=["PLAN DE 39.90"+"<br>"
                +"<br>PREVENTA: CUENTA CON LLAMADAS Y MENSAJES TODO ILIMITADO A CUALQUIER OPERADOR A NIVEL NACIONAL. INTERNET DE 25 GB A NIVEL NACIONAL  "
                +"<br> "
                +"<br>SIENDO HOY DÍA "+new Date().toLocaleDateString('es-ES',options)+". A LAS <a id='HoraActuLegal'>"+new Date().toLocaleTimeString('es-ES')+"</a> SE CONCLUYE UNA VENTA DE PORTABILIDAD, ME PODRÍA INDICAR SU NOMBRE COMPLETO POR FAVOR …………….OK PERFECTO , SU NÚMERO DNI ME PODRÍA CONFIRMAR ."
                +"<br>(ME CONFIRMA EL NÚMERO QUE VA APORTAR A CLARO POR FAVOR).....999999999"
                +"<br>●  ME BRINDA SU DIRECCIÓN PARA LA ENTREGA POR FAVOR: "
                +"<br>●  REFERENCIA DE SU DIRECCIÓN POR FAVOR :"
                +"<br>●  DISTRITO:"
                +"<br>●  CORREO ELECTRÓNICO"
                +"<br>●  NÚMERO DE REFERENCIA POR FAVOR:"
                +"<br>●  SU ACTUAL OPERADOR "
                +"<br>●  ¿RECARGA O PAGA MENSUAL?"
                +"<br> "
                +"<br>A CONTINUACIÓN LE INDICARE LA CARACTERÍSTICA DEL PLAN "
                +"<br><div id='titDetallePlan'></div> "
                +"<br><div id='detallePlan'></div>"
                +"<br> "
                +"<br>ENTONCES EL DÍA DE MAÑANA LE ESTARÍA LLEGANDO SU CHIP A LA DIRECCIÓN BRINDADA  EL DELIVERY ES DE 5 SOLES Y EL COSTO DEL CHIP 5, EN TOTAL 10 SOLES. "
                +"<br> "
                +"<br>PARA CULMINAR CON LO SOLICITADO SE CONFIRMA LO QUE ESTÁ  SOLICITANDO UN CHIP POSTPAGO CON MI MISMO NUMERO PAGANDO MENSUAL 49.90, 55.90, 69.90 "
                +"<br>POR SER CLIENTE CLARO A PARTIR DEL TERCER,EN ADELANTE PUEDE SOLICITAR UNA  RENOVACIÓN DE EQUIPO CON UNA  PREVIA EVALUACIÓN CREDITICIA   “DE ACUERDO”"
                +"<br>EL DIA DE MAÑANA DE 8:00 AM HASTA LAS 8:30 EL MOTORIZADO SE VA COMUNICAR PARA COORDINAR LA HORA Y ENTREGA."
                +"<br>1.PRESENTAR SU DNI. SE ENTREGARÁ EL PRODUCTO SOLO AL TITULAR DE LA LÍNEA."
                +"<br>SI TODO ESTÁ CONFORME PODRÍA DECIR UN SI ACEPTO POR FAVOR ……………………………. OK BIENVENIDO A LA FAMILIA CLARO  QUE TENGA UN BUEN DIA (SR/SR"];
        detaPlan=[""];
        function abrirmod(a,n) {
            array_mostrar="";
            try{
                clearInterval(ActualizarHoraLegal);
            }catch(error){}
            switch (a) {
                case 1:
                    alto="600";
                    ancho="400";
                    array_mostrar=SPEECH[n-1];
                    break;
                case 2:
                    alto="600";
                    ancho="1000";
                    array_mostrar=planes[n-1];
                    break;
                case 3:
                    ActualizarHoraLegal=setInterval(()=>{
                        document.getElementById("HoraActuLegal").innerHTML=new Date().toLocaleTimeString('en-En');
                    },1000);
                    alto="600";
                    ancho="700";
                    array_mostrar="<div style='width:500px'>"+grabaLeg[n-1]+"</div>";
                    break;
            }
            document.getElementById("dialog-modal"+a).children[1].innerHTML=array_mostrar;
            $( "#dialog-modal"+a).dialog({height: alto,width:ancho,modal: false});
            try{document.getElementsByClassName("ui-widget-overlay")[0].outerHTML="";}catch(e){}
        }
    conteoBorrar=setInterval(() => {}, 1);
    datos="";
    document.getElementById("dniCliente").addEventListener('keyup',function(e){
        document.getElementById("cliente").value="";
        document.getElementById("correoCliente").value="";
        // document.getElementById("dnicliente")[0].children[0].innerHTML="DNI / RUC: ";
        // document.getElementsByClassName("infor_1-clien")[0].children[0].innerHTML="CLIENTE / RAZON SOCIAL";
        if(e.keyCode==13){  
        texto=document.getElementById("dniCliente").value;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if(this.response=="" || this.response==null){
                    alertify.error("NO SE ENCONTRO EL DNI DEL CLIENTE");
                    modalCli.style.display = 'block'; }
                else{
                    try{
                        console.log(this.response);
                        var data=$.parseJSON(this.response);
                        console.log(data);
                        document.getElementById("cliente").value=data["nombre_razon"]+" "+data["apellido"];
                        document.getElementById("correoCliente").value=data["correo"];
                        // if(data["personal"]=="N"){
                        //     document.getElementsByClassName("infor_1-dni")[0].children[0].innerHTML="DNI: ";
                        //     document.getElementsByClassName("infor_1-clien")[0].children[0].innerHTML="CLIENTE: ";
                        // }
                        // else{
                        //     document.getElementsByClassName("infor_1-dni")[0].children[0].innerHTML="RUC: ";
                        //     document.getElementsByClassName("infor_1-clien")[0].children[0].innerHTML="RAZON SOCIAL: ";
                        // }
                    }
                    catch(e){
                        console.log(e);
                    }
                }
            }
        };
        xmlhttp.open("POST","./subirtra.php",true);
        var data = new FormData();
        data.append("txt",texto);
        xmlhttp.send(data);
        }
    });

    setInterval(()=>{
        document.getElementById("fechaHora").value=new Date().toLocaleString();
    },1000);
    
    </script>
</body>

</html>