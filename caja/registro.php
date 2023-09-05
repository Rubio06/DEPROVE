<?php
    include ("../coneccion.php");
    $cn = Db::conectar();

$nombreusuario="";
$fechaRegistro="";
$concepto="";
$monto="";
$empresa="";
$cajadestino="";
$motorizado="";
$referencia="";
$nautorizacion="";
$autorizacion="";
$tipoTra="";
$periodo="";
$trabajador="";
$dnitrabajador="";
$fechaconcep="";
$documento="";
$serie="";
$numero="";
$numerooperacion="";
$provedor="";
$slrc="";

$fechafactura="";
$direccion="";
$observacioncompro="";
$izipay="";
$banco="";
$fechavoucher="";
$horavoucher="";
$fechaconfirmacion="";
$deposito="";
$observacion="";

$dnicliente="";
$nombrecliente="";
$fechaconcepto="";
$numtelefono="";
$vendedor="";

$tipo="";
if(isset($_POST["id_editar"])){
    echo "<script>idaEditar=".$_POST["id_editar"]."</script>";
    $op=mysqli_fetch_assoc(mysqli_query($cn,"select * from formulario where id=".$_POST["id_editar"]));
    if(substr($op["tipoIE"],0,3)=="ING"){
        $tipo="INGRESO";
    }
    else{
        $tipo="EGRESO";
    }
    $nombreusuario=$op["nombreusuario"];
    $fechaRegistro=$op["fecharegistro"];
    $concepto=$op["concepto"];
    $monto=$op["monto"];
    $empresa=$op["empresa"];
    $cajadestino=$op["cajadestino"];
    $motorizado=$op["motorizado"];
    $referencia=$op["referencia"];
    $nautorizacion=$op["nautorizacion"];
    $autorizacion=$op["autorizacion"];
    $tipoTra=$op["tipo"];
    $periodo=$op["periodo"];
    $trabajador=$op["trabajador"];
    $dnitrabajador=$op["dnitrabajador"];
    $fechaconcep=$op["fechaconcep"];
    $documento=$op["documento"];
    $serie=$op["serie"];
    $numero=$op["numero"];
    $numerooperacion=$op["numerooperacion"];
    $provedor=$op["provedor"];
    $slrc=$op["slrc"];
    $conceptofecha = $op["conceptofecha"];
    $fechafactura=$op["fechafactura"];
    $direccion=$op["direccion"];
    $observacioncompro=$op["observacioncompro"];
    $izipay=$op["izipay"];
    $banco=$op["banco"];
    $fechavoucher=$op["fechavoucher"];
    $horavoucher=$op["horavoucher"];
    $fechaconfirmacion=$op["fechaconfirmacion"];
    $deposito=$op["deposito"];
    $observacion=$op["observacion"];
    
    $dnicliente=$op["dnicliente"];
    $nombrecliente=$op["nombrecliente"];
    $fechaconcepto=$op["fechaconcepto"];
    $numtelefono=$op["numtelefono"];
    $vendedor=$op["vendedor"];
}

if(isset($_POST["tipo"])){
    $tipo=$_POST["tipo"];
}
if($tipo==""){
    die();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="css/modalbanco.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>


</head>


<body>
    <header>
        <?php include("../header.php") ?>
        <?php include("modal.php")?>
    </header>
    <div class="menu">
        <h1 class="titulo"> <span id="tipo"><?php echo ($tipo);?></span> DE CAJA</h1>


        <?php
            if(isset($_POST["id_editar"])){
             $funcion="Edicion";
             $btn="EDITAR";
            }
            else{
                $funcion="";
                $btn="REGISTRAR";
            }
        ?>
        <button onclick="subir<?php echo $funcion; ?>()" class="registrar"><?php echo $btn; ?></button>
        <br>
        <br>
        <br>
        <div class="flex1">
            <p class="fecha"> <i>FECHA DE REGISTRO</i></p>

            <input class="hora" disabled type="text" id="fregistro" placeholder="fecha" value="<?php 
            if($fechaRegistro==""){
                date_default_timezone_set('America/Lima');
                $fecha_actual = date("Y-m-d");
                echo $fecha_actual;
            }
            else{
                echo $fechaRegistro;
            }
            ?>">
        </div>
        <br>
        <br>




        <div class="concepto">
            <label for="" class="con">CONCEPTO</label>
            <select name="concepto" id="concepto" class="select-principal" onchange="ocultar()">
                <?php
            if($tipo=="EGRESO"){
            ?>
                <option <?php if($concepto=="LIQUIDACION"){echo "selected";} ?> value="LIQUIDACION">LIQUIDACION</option>
                <option <?php if($concepto=="DEPOSITO"){echo "selected";} ?> value="DEPOSITO">DEPOSITOS</option>
                <option <?php if($concepto=="GASTOS"){echo "selected";} ?> value="GASTOS">GASTOS</option>
                <option <?php if($concepto=="SUELDO"){echo "selected";} ?> value="SUELDO">SUELDO</option>
                <option <?php if($concepto=="BONO"){echo "selected";} ?> value="BONO">BONO</option>
                <option <?php if($concepto=="COMISION"){echo "selected";} ?> value="COMISION">COMISION</option>
                <option <?php if($concepto=="LIQUIDACION PERSONAL"){echo "selected";} ?> value="LIQUIDACION PERSONAL">
                    LIQUIDACIONES DE PERSONAL</option>
                <option <?php if($concepto=="ADELANTO"){echo "selected";} ?> value="ADELANTO">ADELANTO</option>
                <?php
            } else{
                ?>
                <option <?php if($concepto=="LIQUIDACION"){echo "selected";} ?> value="LIQUIDACION">LIQUIDACION</option>
                <option <?php if($concepto=="LIQUIDACION MOTORIZADO"){echo "selected";} ?>
                    value="LIQUIDACION MOTORIZADO">LIQUIDACION MOTORIZADO</option>
                <option <?php if($concepto=="RECARGA"){echo "selected";} ?> value="RECARGA">RECARGA</option>
                <option <?php if($concepto=="FULL CARGO"){echo "selected";} ?> value="FULL RECARGA">FULL RECARGA
                </option>
                <option <?php if($concepto=="SEPARACION DE EQUIPOS"){echo "selected";} ?> value="SEPARACION DE EQUIPOS">
                    SEPARACION DE EQUIPO</option>
                <option <?php if($concepto=="OTROS INGRESOS"){echo "selected";} ?> value="OTROS INGRESOS">OTROS INGRESOS
                </option>
                <!-- <option value="ADELANTO">ADELANTO</option> -->
                <?php
            }
            ?>
            </select>
        </div>

        <br>

        <div class="operacion3" id="motorizado">
            <!-- 
            <label for="">SOLO ACTIVOS</label>

            <input type="checkbox"> -->


            <label for="">MOTORIZADO</label id="hora">
            <select name="" id="selectmotorizado" style="margin-left: 32px; width: 320px;">

                <option value="" selected></option>
                <?php
                    $query = "select nombre,apellido from trabajador where idcargo=1;";
                    $resultado = mysqli_query($cn,$query);

                    while($mostrar = mysqli_fetch_assoc($resultado)){
                ?>
                <option <?php if($motorizado=="motorizado"){echo "selected";} ?>
                    value="<?php echo $mostrar['nombre']; ?>">
                    <?php echo $mostrar['nombre']." ".$mostrar['apellido']?></option>

                <?php
    
                    }
                ?>
            </select>


        </div>

        <br>

        <div class="empresainicio" id="empresainicio">

            <label for="" id="empresaini">EMPRESA</label>

            <select name="gene-empresa" id="empresa" style="width: 300px; margin-left: 85px;">
                <option value="" selected></option>
                <?php 
                $query = "select empresa FROM trabajador where empresa!='' GROUP BY empresa;";
                $resultado = mysqli_query($cn,$query);
                while($mostrar = mysqli_fetch_assoc($resultado)){
                    if($mostrar['empresa']==$empresa){$s="selected";}else{$s="";}
                ?>
                <option value="<?php echo $mostrar['empresa']. ' " '. $s; ?>><?php echo $mostrar['empresa']; ?></option>
                <?php
                }
                ?>

            </select>

        <!-- //DNI TRABAJADOR -->
        <div>
            <input type=" text" id="dnitrabajador" class="dnitrabajador">
        </div>



        <style>
        #nombreusuario {
            display: none;
        }
        </style>




        <div id="nombreusuario">
            <label for="">Nombre usuario</label>
            <input type="text" id="">
        </div>
    </div>

    <form class="container1" id="contenedor1" style="display:none" onsubmit="return false;">
        <!-- <div class="container1" id="contenedor1" style="display:none"> -->



        <br>


        <!--  FORMULARIO 1 -->

        <div class="form-general" id=formulario-1>

            <div class="monto" id="primerformulario">
                <div class="otromonto">
                    <div class="fechaventa" id="monto1">
                        <label for="" id="lbldeposito">FECHA DEPOSITO</label>
                        <input type="date" class="deposito" id="conceptofecha" value="<?php echo $conceptofecha ?>">
                    </div>
                    <br>


                    <div>

                        <div class="monto1" id="monto1">
                            <label for="" id="cambioconcepto">FECHA CONCEPTO</label>
                            <input type="date" class="deposito" id="fechaconcep" value="<?php echo $fechaconcep ?>">
                        </div>
                        <br>


                        <div class="monto2" id="gene-monto">
                            <label for="" id="lblmonto" class="lblmonto">MONTO</label>
                            <input type="text" class="montoform" id="montoform" autocomplete="off"
                                value="<?php echo $monto?>">
                        </div>
                        <br>

                        <div class="monto3" id="referencia">
                            <label class="refe" for="">REFERENCIA</label>
                            <input type="text" id="ref" value="<?php echo $referencia ?>">
                        </div>
                        <br>


                        <div class="monto3" style="padding-right: 80px">
                            <label class="refe" for="">AUTORIZACION</label>
                            <input type="text" id="autorizacion" value="<?php echo $autorizacion ?>">
                        </div>
                        <br>
                        <div class="monto3" id="destino">
                            <label for="" class="des">CAJA DESTINO</label>

                            <select id="cjdestino" class="montoform">
                                <option value=""></option>
                                <?php 
                                    $sql = "SELECT tipocaja FROM tipocaja;";
                                    $resultado = mysqli_query($cn,$sql);
                                    while($mostrar = mysqli_fetch_assoc($resultado)){
                                        if($mostrar['tipocaja']==$cajadestino){$s="selected";}else{$s="";}
                                ?>
                                <option value="<?php echo $mostrar['tipocaja'] .'"'.  $s; ?>> <?php echo $mostrar['tipocaja']; ?>
                                </option>

                                <?php
                                    }  
                                ?>

                            </select>

                            <!-- OTROS INGRESOS -->

                            <!-- <input type=" text" class="montoform" id="cjdestino"> -->
                        </div>
                        <br>

                    </div>
                    <br>
                </div>
            </div>


            <br>

        </div class="areaobs">



        <div>

            <br>

            <div class="form1" id="form1">


                <div class="radio" id="comprobante">
                    <label for="" class="comprobante">COMPROBANTE DE PAGO</label>
                </div>

                <br>

                <div class="compago">

                    <div class="operacion2" id="op2">
                        <div class="docum" id="">
                            <input type="checkbox" onclick="selectcheck()" id="factura" value="FACTURA" name="doc"
                                class="rb1">
                            <label for="" id="lblfactura">FACTURA</label>

                            <input type="checkbox" onclick="selectcheck()" id="boleta" value="BOLETA" name="doc"
                                class="rb2">
                            <label for="" id="lblboleta">BOLETA</label>

                        </div>
                    </div>


                    <br>

                    <div class="serie-numero" id="serie-numero">
                        <label for="" class="serie">SERIE</label>
                        <label for="">NÚMERO</label>

                    </div>

                    <div class="separacion3" id="sep3">
                        <label class="doc" for="">NRO. DOC</label id="lbdoc">

                        <input class="doc" type="text" size="" id="doc1" disabled="true" value="<?php echo $serie ?>">
                        <input class="doc" type="text" size="" id="doc2" disabled="true" value="<?php echo $numero ?>">
                    </div>

                    <br>

                    <div class="separacion3" id="sep4">
                        <label for="">PROVEEDOR</label id="lbproveedor">
                        <input type="text" id="proveedor" disabled="true" value="<?php echo $provedor ?>">
                    </div class="separacion3">
                    <br>
                    <div id="sep5">
                        <label for="" class="suministro" id="">#SUMINISTRO/LINEA/RUC/CUENTA</label>
                        <br>
                        <input type="text" id="suministro" disabled="true" value="">
                    </div>

                    <br>
                    <div class="separacion3" id="sep6">
                        <label for="">FECHA DE FACTURA</label id="lbfactura">
                        <input type="date" id="fechafactura" class="fech-factura" disabled="true"
                            value="<?php echo $fechafactura?>">
                    </div>

                    <br>
                    <div class="separacion3" id="sep7">
                        <label for="" id="lbldireccion">DIRECCION</label>
                        <input type="text" id="textdireccion" disabled="true">
                    </div>

                    <br>

                    <div class="" id="">
                        <label for="" id="lblobser">LISTA DE PAGOS</label>
                        <textarea name="" cols="30" rows="3" id="observacioncomprobante" disabled="true"></textarea>
                    </div>

                    <br>
                </div>
            </div>





            <!-- FORMULARIO -->
            <div id="trabajadores" class="trabaja">
                <div>
                    <label for="" class="labeltrajador">TRABAJADORES</label>
                </div>
                <br>

                <div class="sep">
                    <label for="">NUMERO DE AUTORIZACION</label>
                    <input type="text" id="nautorizacion" id="nautorizacion" value="<?php echo $nautorizacion?>">
                </div>

                <br>
                <div class="sep2">
                    <label for="">TIPO</label>
                    <select name="" id="tipotrabajador" style="width: 250px; margin-left: 75px;">
                        <option value=""></option>

                        <?php 
                            $sql = "SELECT tipo FROM tipo;";
                            $resultado = mysqli_query($cn,$sql);
                            while($mostrar = mysqli_fetch_assoc($resultado)){
                                if($mostrar['tipo']==$cajadestino){$s="selected";}else{$s="";}

                        ?>
                        <option value="<?php echo $mostrar['tipo'] . '"'. $s; ?>"><?php echo $mostrar['tipo']; ?>
                        </option>

                        <?php
                        }  
                        ?>

                    </select>
                    <button style="width: 55px; margin-left: 26px;" id="modal-tipo">+</button>
                </div>
                <br>

                <div class="sep3">
                    <label for="">PERIODO</label>
                    <select name="" id="periodotrabajador" style="width: 250px; margin-left: 75px;">

                        <option value=""></option>

                        <?php 
                            $sql = "SELECT periodo FROM periodo;";
                            $resultado = mysqli_query($cn,$sql);
                            while($mostrar = mysqli_fetch_assoc($resultado)){
                        ?>
                        <option value="<?php echo $mostrar['periodo']; ?>"><?php echo $mostrar['periodo']; ?></option>

                        <?php
                        }  
                        ?>

                    </select>

                    <button style="width: 55px; margin-left: 26px;" id="modal-periodo">+</button>

                </div>
                <br>

                <div class="sep">
                    <label for="">TRABAJADOR</label>

                    <input type="text" id="trabajador" oninput="BuscarTra()" name="trabajador"
                        value="<?php echo $trabajador?>">
                    <!-- <select name="" id="trabajador">
                        <option value="" selected></option>
                        <option value="TRABAJADOR1">TRABAJADOR1</option>
                        <option value="TRABAJADOR2">TRABAJADOR2</option>

                    </select> -->
                </div>
                <br>

                <div class="sep1">
                    <div>


                        <select name="opmonto" id="opmonto" class="opmonto">
                        </select>


                        <label for="" class="opciones">MONTO</label>
                        <input class="opciones" type="number" id="montotrabajador">
                    </div>
                    <br>
                </div>

                <div id="observaciones">


                    <button style="padding: 10px;" onclick="AgregarDato(); return false;">AGREGAR</button>
                    <label for="" style="margin-left: 40px;">MONTO TOTAL</label>
                    <input type="text" style="width: 30%;" id="montototal" name="montototal">




                    <br>
                    <br>

                    <label for="" style="margin-left: 110px;">LISTA DE PAGOS</label>

                    <BR>
                    </BR>

                    <style>
                    TD,
                    TH {
                        padding: 10px 20px 20px 30px;

                    }
                    </style>

                    <div style="overflow:scroll; width: 100%; margin: auto;max-height: 250px;">

                        <table border="2" celllpading="10" cellspacing="0">
                            <thead>
                                <TR style="position: sticky; top: 0;" celllpading="10">
                                    <TH style="text-align:center;width:10%; background: rgb(184, 182, 175);"
                                        class="id_">#</TH>
                                    <TH style="text-align:center;width:40%; background: rgb(184, 182, 175);"
                                        class="nombre_">NOMBRE</TH>
                                    <TH style="text-align:center;width:40%; background: rgb(184, 182, 175);"
                                        class="empresa_">EMPRESA</TD>
                                    <TH style="text-align:center;width:15%; background: rgb(184, 182, 175);"
                                        class="monto_">MONTO</TH>
                                </TR>


                            </thead>

                            <tbody id="tablaempresa">

                            </tbody>

                            <!-- <TR>
                            <TD style="text-align:center;width:10%;" class="id_">1</TD>
                            <TD style="text-align:center;width:40%;" class="nombre_"></TD>
                            <TD style="text-align:center;width:40%;" class="empresa_">SOLIN</TD>
                            <TD style="text-align:center;width:15%;" class="monto_">1000</TD>
                        </TR> -->

                        </table>

                    </div>

                    <!-- <textarea name="" id="observacionarea" cols="48" rows="3" class="divobserva" value="NOMBRE"></textarea> -->
                </div>




            </div>


            <div class="form2" id="form3">

                <div class="radio" id="rb">
                    <label for="" id="lbldeposito" class="depost">DEPOSITO</label>
                </div>
                <br>


                <div class="fecha-cta" id="fecha-cta">
                    <div class="fecha-confirm" id="fecha-confirm">
                        <label for="" id="lblfechacon" sytle="font-weight:bold;">FECHA CONFIRMACION CTA. EMPRESA</label>
                        <br>
                        <br>
                        <input type="date" placeholder="fecha" value="<?php echo $fechaconfirmacion;?>"
                            id="fechaconfirmacion" class="deposito">
                    </div>
                    <br>
                    <br>


                    <div class="ajuste" id="ajuste">
                        <label for="" id="lblizipay">AJUSTE IZIPAY</label>
                        <br>
                        <br>
                        <input type="button" id="ajusteIzi" name="ajuste" value="Ajuste" class="ajuste-boton">

                    </div>
                </div>



                <br>

                <div class="empresa-terceros" id="con">
                    <input type="checkbox" name="operacion" id="deposito" onclick="seleccionEmpresa()">
                    <label for="" id="lblempresa">CTA DE EMPRESA</label>
                    <input type="checkbox" name="operacion" id="cuentaterceros" onclick="seleccionEmpresa()">
                    <label for="" id="lblterceros">CTA DE TERCEROS</label>
                </div>

                <!-- grid 2 -->
                <div class="form-anidado" id="anidado">
                    <br>
                    <br>
                    <div class="operaciones">
                        <div class="operacion1" id="operacion-op">
                            <label for="" id="numero-operacion">NUMERO DE OPERACION</label>
                            <input type="text" id="inputoperacion" disabled="false"
                                value="<?php echo $numerooperacion ?>">
                        </div>
                        <br>
                        <div class="operacion7" id="contenedor-ope">
                            <label for="" id="lblbanco">BANCO</label>

                            <select name="" id="selectbanco" disabled="true">

                                <option></option>
                                <?php
                                    $query = "select banco from banco order by banco;";
                                    $resultado = mysqli_query($cn,$query);
                                    $s="";
                                    while($mostrar = mysqli_fetch_assoc($resultado)){
                                        if($mostrar['banco']==$banco){$s="selected";}else{$s="";} ?>
                                <option value="<?php echo $mostrar['banco'].'"'.$s; ?>><?php echo $mostrar['banco']?></option>
                                <?php
                                    }
                                ?>

                            </select>


                            <div class=" ajuste" id="ajuste">


                                    <input type="button" id="modal-banco" name="ajuste" value="+" class="ajuste-boton"
                                        style="font-size:20px" disabled="true">

                        </div>



                    </div>


                    <br>

                    <div class="operacion2">
                        <label for="" class="voucher" id="voucher">FECHA DE VAUCHER</label>
                        <input type="date" id="fechavoucher" disabled="true" value="<?php echo $fechavoucher ?>">
                    </div>

                    <br>
                    <br>
                    <div class="relojero" id="ope-hora">
                        <label for="timeClock" class="lblhora">HORA VAUCHER</label id="hora">
                        <input type="time" value="<?php echo $horavoucher ?>" id="horavoucher" class="horainput"
                            disabled="true">
                        <!-- <img src="img/reloj.png" alt="" class="reloj"> -->


                    </div>
                    <br>


                    <!-- <div class="operacion3" id="motorizado">

                            <label for="">SOLO ACTIVOS</label>

                            <input type="checkbox">
                            </BR>
                            </BR>

                            <label for="">MOTORIZADO</label id="hora">
                            <select name="" id="selectmotorizado" disabled="true">
                                <?php
                                    // $query = "select nombre,apellido from trabajador where idcargo=1;";
                                    // $resultado = mysqli_query($cn,$query);

                                    // while($mostrar = mysqli_fetch_assoc($resultado)){
                                ?>
    
                                ?>
                            </select>


                        </div> -->




                </div>

            </div>

        </div>

        <div class="recarga" id="recarga">
            <div class="datosrecarga">
                <label for="">DNI CLIENTE</label>
                <input type="text" class="dnicliente" name="dnicliente" id="dnicliente"
                    value="<?php echo $dnicliente ?>">
            </div>
            <br>

            <div class="datosrecarga">
                <label for="">NOMBRE CLIENTE</label>
                <input type="text" class="nombrecliente" name="nombrecliente" id="nombrecliente"
                    value="<?php echo $nombrecliente ?>">
            </div class="datosrecarga">
            <br>


            <!-- <div class="monto3" id="referencia">
                    <label class="refe" for="">REFERENCIA</label>
                    <input type="text" id="ref">
                </div> -->
            <div class="datosrecarga">
                <label for="">FECHA DE CONCEPTO</label>
                <input type="date" class="fechaconcepto" name="fechaconcepto" id="fechaconcepto"
                    value="<?php echo $fechaconcep ?>">
            </div>
            <br>
            <div class="datosrecarga">
                <label for="">NRO. TELEFONO</label>
                <input type="text" class="numtelefono" name="numtelefono" id="numtelefono"
                    value="<?php echo $numtelefono ?>">
            </div>
            <br>

            <div class="datosrecarga">
                <label for="">DNI / VENDEDOR</label>
                <input type="text" class="dnivendedor" value="<?php echo $vendedor; ?>" name="dnivendedor"
                    id="dnivendedor" oninput="BuscarCliente()">
            </div>
            <br>

            <div class="datosrecarga">
                <input type="text" class="vendedor" name="vendedor" id="vendedor"
                    style="width: 350px; margin-left: 50px;">
            </div>

            <!-- <div>
                    <label for="">OBSERVACION</label>
                    <textarea id="areavendedor" name="" cols="55" rows="4" class="area"></textarea>
                </div> -->


        </div>
        <div class="observaciones" id="observaciones2">

            <div class="areageneral">
                <label for="" id="titulo-observa"><i><b>OBSERVACION</b></i></label>

                <textarea id="observaarea" name="" cols="55" rows="4"
                    class="area"><?php echo $observacion; ?></textarea>
            </div>
        </div>


        </div>


        <br>
        <br>



        <!-- </div> -->
    </form>

    <!-- -----modal almacen---- -->

    <style>
    .button {
        margin: auto;
        padding: 5px;
    }

    .modelo {

        display: grid;
        grid-template-columns: 1fr 1fr;
    }

    .bott {
        background-color: red;
        color: rgb(255, 231, 123);
        padding: 10px 10px;
        border: 0px solid black;
        border-radius: 5px;
        font-size: 17px;
        font-weight: bold;
    }

    .but {
        margin: auto;
        width: 27%;
    }
    </style>

    <div id="miModal" class="modal">
        <div class="flex" id="flex">
            <div class="contenido-modal" id="modalenviar">
                <div class="modal-header flex">
                    <h2>AJUSTE IZIPAY</h2>
                    <span class="close" id="close">&times;</span>
                </div>
                <br>

                <div align="center" border="2" class="modal-abajo">

                    <div class="modelo">
                        <label>MONTO DE VAUCHER</label><input class="modal-body" id="montoVoucher" type="text" /><br>
                    </div>
                    <br>

                    <div class="modelo">
                        <label>% IZIPAY</label><input class="modal-body" id="porcentIzi" type="text" /><br>
                    </div>
                    <br>

                    <div class="modelo">
                        <label>MONTO INGRESADO AL BANCO</label><input class="modal-body" id="montoBanco"
                            oninput="calcular()" type="text" /><br>
                    </div>


                </div>
                <br>


                <div class="but">
                    <input type="button" onclick="subir()" id="modalbutton" class="bott" value="GUARDAR" align="center">
                </div>

            </div>
        </div>
    </div>

    <!-- <input type="button" id="almacen1" name="ajuste" class="ajuste-boton1"> -->

    <!-- modal 2 -->

    <div id="miModal1" class="modal">
        <div class="flex" id="flex1">
            <div class="contenido-modal" id="modalenviar1">
                <div class="modal-header flex">
                    <h2>BANCO</h2>
                    <span class="close" id="close1">&times;</span>
                </div>
                <br>

                <div align="center" border="2" class="modal-abajo">

                    <div class="modelo">
                        <label>INGRESAR BANCO</label><input class="modal-body" id="subirbanco" type="text"
                            autocomplete="off" /><br>
                    </div>
                    <br>
                </div>
                <br>

                <div class="but">
                    <input type="button" id="Ingresarbanco" class="bott" value="GUARDAR">
                </div>

            </div>
        </div>
    </div>

    <!-- MODAL PERIODO Y MODAL TIPO -->



    <script src="js/main.js"></script>

    <script>
    id = 0;
    montot = 0;
    arraydatos = [];


    document.getElementById("Ingresarbanco").addEventListener("click", () => {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("selectbanco").innerHTML = this.response;
                document.getElementById('miModal1').style.display = 'none';
                document.getElementById("subirbanco").value = "";
            }
        };

        xmlhttp.open("POST", "./buscar.php", true);
        data = new FormData();

        data.append("banco", document.getElementById("subirbanco").value)
        data.append("op", "subirbanco")

        xmlhttp.send(data);

    });
    /////


    //TIPO
    document.getElementById("Ingresartipo").addEventListener("click", () => {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("tipotrabajador").innerHTML = this.response;
                document.getElementById('miModal3').style.display = 'none';
                document.getElementById("SubirTipo").value = "";
            }
        };

        xmlhttp.open("POST", "./buscar.php", true);
        data = new FormData();

        data.append("tipo", document.getElementById("SubirTipo").value)
        data.append("op", "SubirTipo")

        xmlhttp.send(data);
    });


    // PERIODO

    document.getElementById("Ingresarperiodo").addEventListener("click", () => {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("periodotrabajador").innerHTML = this.response;
                document.getElementById('miModal2').style.display = 'none';
                document.getElementById("SubirPeriodo").value = "";
            }
        };

        xmlhttp.open("POST", "./buscar.php", true);
        data = new FormData();

        data.append("periodo", document.getElementById("SubirPeriodo").value)
        data.append("op", "SubirPeriodo")

        xmlhttp.send(data);
    });


    /////////

    const BuscarTra = () => {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("opmonto").innerHTML = this.response;
            }
        };

        xmlhttp.open("POST", "./buscar.php", true);
        data = new FormData();

        data.append("busqueda", document.getElementById("trabajador").value)
        data.append("op", "trabajador")

        xmlhttp.send(data);
    }

    carcar = setTimeout(() => {}, 0);
    const BuscarCliente = () => {
        clearInterval(carcar);
        carcar = setTimeout(() => {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.response);
                    if (this.response == "No") {
                        alerta.mal("No es un asesor");
                    } else {
                        document.getElementById("vendedor").value = this.response;
                    }
                }
            };

            xmlhttp.open("POST", "./buscar.php", true);
            data = new FormData();

            data.append("busqueda", document.getElementById("dnivendedor").value)
            data.append("op", "dnivendedor")

            xmlhttp.send(data);
        }, 500);
    }



    const BajarRegistro = () => {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("opmonto").innerHTML = this.response;
            }
        };

        xmlhttp.open("POST", "./buscar.php", true);
        data = new FormData();

        data.append("busqueda", document.getElementById("trabajador").value)
        data.append("op", "trabajador")

        xmlhttp.send(data);
    }

    const BorrarDato = (elemento) => {
        padre = elemento.parentNode.children;
        montot = montot - parseFloat(elemento.children[3].innerText.substr(3, elemento.children[3].innerHTML
            .length));
        document.getElementById("montototal").value = montot;
        for (i = 0; i < padre.length; i++) {
            if (padre[i] == elemento) {
                acti = 1;
                arraydatos.splice(i, 1);
            }
            if (acti != -1) {
                padre[i].children[0].innerHTML = parseFloat(padre[i].children[0].innerHTML) - 1;
            }
        }
        id--;
        elemento.outerHTML = "";
    }

    const AgregarDato = () => {
        montotrabajador = document.getElementById("montotrabajador");
        opmonto = document.getElementById("opmonto");
        trabajador = document.getElementById("trabajador");
        montototal = document.getElementById("montototal");
        tablaempresa = document.getElementById("tablaempresa");
        montototal.disabled = true;
        if (montotrabajador.value != "" && montotrabajador.value != null && opmonto.value != "" && opmonto !=
            null) {
            preciotra = parseFloat(montotrabajador.value).toFixed(2);
            id++;
            data = JSON.parse(document.getElementById("opmonto").value);
            tr = document.createElement("tr");
            tr.setAttribute("ondblclick", "BorrarDato(this)");
            tr.innerHTML += ("<td>" + id + "</td>");
            tr.innerHTML += ("<td>" + data[1] + "</td>");
            tr.innerHTML += ("<td>" + data[2] + "</td>");
            tr.innerHTML += ("<td> S/." + preciotra + "</td>");
            arraydatos.push([data[0], preciotra, data[1], data[2]]);
            montot += parseFloat(preciotra);
            montototal.value = montot;
            tablaempresa.append(tr);
            montotrabajador.value = "";
            opmonto.innerHTML = "";
            trabajador.value = "";
        } else {
            alerta.bien("Falta llenar los campos")

        }
        return false;
    }

    setInterval(() => {

    }, interval);
    </script>

</body>

</html>