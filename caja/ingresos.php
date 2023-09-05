<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/modal.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>


</head>
<body>
    <?php include("../header.php") ?>
    <div class="menu">
        <h1 class="titulo">INGRESOS DE CAJA</h1>
        <button onclick="subir()" class="registrar">REGISTRAR</button>
        <br>
        <br>
        <div class="flex1">
            <p class="fecha"> <i>FECHA DE REGISTRO</i></p>
            <input class="hora" disabled type="text" id="fregistro" placeholder="fecha" value="<?php 
                    date_default_timezone_set('America/Lima');
                    $fecha_actual = date("Y-m-d");
                    echo $fecha_actual?>">
        </div>
        <br>

        <div class="concepto">
            <label for="" class="con">CONCEPTO</label>
            <select name="concepto" id="concepto" class="select-principal" onchange="ocultar()">
                <option value="LIQUIDACION">LIQUIDACION</option>
                <option value="DEPOSITO">DEPOSITOS</option>
                <option value="GASTOS">GASTOS</option>
                <!-- <option value="LIQUIDACION MOTORIZADO">LIQUIDACION MOTORIZADO</option> -->
                <option value="SUELDO">SUELDO</option>
                <option value="BONO">BONO</option>
                <option value="COMISION">COMISION</option>
                <option value="LIQUIDACION PERSONAL">LIQUIDACIONES DE PERSONAL</option>
                <option value="ADELANTO">ADELANTO</option>
            </select>
        </div>
        <br>
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
    <form class="container1" id="contenedor1" style="display:none">
        <br>
        <!--  FORMULARIO 1 -->
        <div class="form-general" id=formulario-1>

            <div class="monto">

                <div class="monto1" id="monto1">
                    <label for="" id="lbldeposito">FECHA DEPOSITO</label>
                    <input type="date" class="deposito" id="conceptofecha">
                </div>
                <br>

                <div class="monto1" id="monto1">
                    <label for="" id="lbldeposito">FECHA DE CONCEPTO</label>
                    <input type="date" class="deposito" id="conceptofecha">
                </div>
                <br>


                <div class="monto2" id="gene-monto">
                    <label for="" id="lblmonto" class="lblmonto">MONTO</label>
                    <input type="text" class="montoform" id="montoform" autocomplete="off">
                </div>
                <br>

                <div class="monto3" id="gene-empresa">
                    <label for="" class="emp">EMPRESA</label>

                    <select name="" id="empresa">
                        <option value=""></option>
                        <option value="DEPROVE">DEPROVE</option>
                        <option value="KOMUNICATE">KOMUNICATE</option>
                    </select>

                </div>
                <br>


                <div class="monto3" id="referencia">
                    <label class="refe" for="">REFERENCIA</label>
                    <input type="text" id="ref">
                </div>
                <br>
                <div class="monto3" id="destino">
                    <label for="" class="des">CAJA DESTINO</label>
                    <input type="text" id="cjdestino">
                </div>
                <br>



            </div>
            <br>

        </div class="areaobs">



        <div class="observaciones" id="observaciones2">
            <label for="" id="observa"><i><b>OBSERVACION</b></i></label>
            <br>
            <br>

            <div class="areageneral">
                <label for="" id="titulo-observa"><i><b>OBSERVACION</b></i></label>

                <textarea id="observaarea" name="" cols="55" rows="4" class="area"></textarea>
            </div>

        </div>

        <div>

            <br>

            <div class="form1" id="form1">


                <div class="radio" id="comprobante">
                    <label for="" class="comprobante">COMPROBANTE DE PAGO</label>
                </div>

                <br>


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

                    <input class="doc" type="text" size="" id="doc1" disabled="true">
                    <input class="doc" type="text" size="" id="doc2" disabled="true">
                </div>

                <br>

                <div class="separacion3" id="sep4">
                    <label for="">PROVEEDOR</label id="lbproveedor">
                    <input type="text" id="proveedor" disabled="true">
                </div class="separacion3">
                <br>
                <div id="sep5">
                    <label for="" class="suministro" id="">#SUMINISTRO/LINEA/RUC/CUENTA</label>
                    <br>
                    <input type="text" id="suministro" disabled="true">
                </div>

                <br>
                <div class="separacion3" id="sep6">
                    <label for="">FECHA DE FACTURA</label id="lbfactura">
                    <input type="date" id="fechafactura" class="fech-factura" disabled="true">
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



            <!-- FORMULARIO -->
            <div id="trabajadores" class="trabaja">
                <div>
                    <label for="" class="labeltrajador">TRABAJADORES</label>
                </div>
                <br>

                <div class="sep">
                    <label for="">NUMERO DE AUTORIZACION</label>
                    <input type="text" id="nautorizacion" id="nautorizacion">
                </div>

                <br>
                <div class="sep">
                    <label for="">TIPO</label>
                    <select name="" id="tipotrabajador">
                        <option value="" selected></option>
                        <option value="TIPO1">TIPO1</option>
                        <option value="TIPO2">TIPO1</option>

                    </select>
                </div>
                <br>

                <div class="sep">
                    <label for="">PERIODO</label>
                    <select name="" id="periodotrabajador">
                        <option value="" selected></option>
                        <option value="PERIODO1">PERIODO1</option>
                        <option value="PERIODO2">PERIODO1</option>

                    </select>
                </div>
                <br>

                <div class="sep">
                    <label for="">TRABAJADOR</label>

                    <input type="text" id="trabajador" name="trabajador">
                    <!-- <select name="" id="trabajador">
                        <option value="" selected></option>
                        <option value="TRABAJADOR1">TRABAJADOR1</option>
                        <option value="TRABAJADOR2">TRABAJADOR2</option>

                    </select> -->
                </div>
                <br>

                <div class="sep1">
                    <div>
                        <select name="" id="opmonto" class="opciones">
                            <option value="" selected></option>
                            <option value="MONTO1">MONTO1</option>
                            <option value="MONTO2">MONTO2</option>

                        </select>
                        <label for="" class="opciones">MONTO</label>
                        <input class="opciones" type="text" id="montotrabajador">
                    </div>
                    <br>
                </div>

                <div id="observaciones">
                    <label for="">LISTA DE PAGOS</label>
                    <textarea name="" id="observacionarea" cols="48" rows="3" class="divobserva" value="NOMBRE"></textarea>
                </div>




            </div>

            <!-- VENTANA MODAL -->

            <div class="form2" id="form3">

                <div class="radio" id="rb">
                    <label for="" id="lbldeposito" class="depost">DEPOSITO</label>
                </div>
                <br>


                <div class="fecha-cta" id="fecha-cta">
                    <div class="fecha-confirm" id="fecha-confirm">
                        <label for="" id="lblfechacon">FECHA CONFIRMACION CTA. EMPRESA</label>
                        <br>
                        <br>
                        <input type="date" placeholder="fecha" value="" id="fechaconfirmacion" class="deposito">
                    </div>
                    <br>
                    <br>


                    <div class="ajuste" id="ajuste">
                        <label for="" id="lblizipay">AJUSTE IZIPAY</label>
                        <br>
                        <br>
                        <input type="button" id="almacen" name="ajuste" value="Ajuste" class="ajuste-boton">

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
                            <input type="text" id="inputoperacion" disabled="false">
                        </div>
                        <br>

                        <div class="operacion2" id="contenedor-ope">
                            <label for="" id="lblbanco">BANCO</label>
                            <select name="" id="selectbanco" disabled="true">
                                <option value="">SELECCIONE...</option>
                                <option value="INTERBANK">Interbank</option>
                                <option value="BBVVA">BBVVA</option>
                                <option value="BCP">BCP</option>
                                <option value="Santander">Santander</option>
                                <option value="Mi banco">Mi Banco</option>
                            </select>
                        </div>
                        <br>

                        <div class="operacion2">
                            <label for="" class="voucher" id="voucher">FECHA DE VAUCHER</label>
                            <input type="date" id="fechavoucher" disabled="true">
                        </div>

                        <br>
                        <br>
                        <div class="relojero" id="ope-hora">
                            <label for="timeClock" class="lblhora">HORA VAUCHER</label id="hora">
                            <input type="time" value="" id="horavoucher" class="horainput" disabled="true">
                            <img src="img/reloj.png" alt="" class="reloj">


                        </div>
                        <br>

                        <div class="operacion3" id="motorizado">
                            <label for="">MOTORIZADO</label id="hora">
                            <select name="" id="selectmotorizado" disabled="true">
                                <option value="" selected></option>
                                <option value="Carlos">CARLOS</option>
                                <option value="Roberto">ROBERTO</option>

                            </select>

                        </div>
                    </div>

                </div>

            </div>


        </div>

    </form>

    <style>
    #areatxt {
        width: 100%;
        min-width: 900px;
        max-width: 900px;

    }
    </style>

    <br>



    <div class="observ-3" id="observaciones5">
        <label for="" id="lblobservaciones"><i><b>OBSERVACION</b></i></label>
        <br>
        <textarea name="" cols="48" rows="3" id="areatxt"></textarea>
    </div>

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
    <script src="js/main.js"></script>

</body>


</html>