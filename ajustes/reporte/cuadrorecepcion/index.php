

<?php
    include("../../../coneccion.php");

    $cn =  Db::conectar();
    

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

    <div class="container">
        <br>
        <h1 style="background: rgb(224, 215, 16); padding: 20px 20px; width: 40%; text-align: center;">CUADRO DE
            RECEPCION</h1>
        <br>
        <br>

        <style>
        input {
            font-size: 18px;
            width: 250px;
        }

        button {
            width: 200px;
            padding: 5px 5px;
        }
        </style>
        <div style="display: flex; justify-content: space-between; width: 70%; font-size: 18px; align-items: center; margin:auto;">
            <div>
                <label for="desde">DESDE</label>
                <input type="date" id="desde" name="desde">

            </div>
            <div>
                <label for="hasta">HASTA</label>
                <input type="date" id="hasta" name="hasta">
            </div>

            <div>
                <button class="btn-buscar">BUSCAR</button>
            </div>
        </div>
        <br>
        <br>
        <div style="overflow:scroll;width: 100%;margin: auto;max-height: 550px;">
            <table cellspacing="0" cellpading="2">
                <thead style="position: sticky; top: 0;">
                    <tr>
                        <th colspan="49" style="font-size: 35px; padding: 35px 35px; background: rgb(140, 187, 243);">
                            EAYSI SALES</th>
                        <th colspan="16" style="font-size: 35px; padding: 35px 35px; background: rgb(178, 241, 134);">
                            SUPERVISORES</th>
                        <th colspan="13" style="font-size: 35px; padding: 35px 35px; background: rgb(151, 242, 205);">
                            SEGUIMIENTO (ADMINISTRACION)</th>
                        <th colspan="7" style="font-size: 35px; padding: 35px 35px; background: rgb(209, 145, 237);">
                            DOCUMENTOS PAGADOS (LINEA / NRO A PORTAR)</th>
                        <th colspan="11" style="font-size: 35px; padding: 35px 35px; background: rgb(153, 244, 50);">
                            REPORTE DE COMISION 1ER COMISION</th>
                        <th colspan="11" style="font-size: 35px; padding: 35px 35px; background: rgb(237, 176, 145);">
                            REPORTE DE COMISION 2DA COMISION</th>
                        <th colspan="11" style="font-size: 35px; padding: 35px 35px; background: rgb(237, 202, 145);">
                            REPORTE DE COMISION 3ER COMISION</th>
                        <th colspan="6" style="font-size: 35px; padding: 35px 35px; background: rgb(237, 145, 173);">
                            PENALIDAD 1</th>
                        <th colspan="6" style="font-size: 35px; padding: 35px 35px; background: rgb(145, 167, 237);">
                            PENALIDAD 2</th>
                        <th colspan="6" style="font-size: 35px; padding: 35px 35px; background: rgb(220, 237, 145);">
                            PENALIDAD 3</th>
                        <th colspan="8" style="font-size: 35px; padding: 35px 35px; background: rgb(145, 237, 184);">
                            AJUSTES</th>
                    </tr>
                    <tr>
                        <!-- CUADRO DE RECEPCION -->
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">ID</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">FICHA</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">EMPRESA</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">#PLAN</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">SEC</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">SEDE</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">LOCATION</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">FECHA DE REGISTRO</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">FECHA ALMACEN CALL</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">COORDINADOR</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">VENDEDOR</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">MODALIDAD</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">TIPO</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">CATEGORIA</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">PLAN</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">PESO VENTA</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">TELEFONO REF 1</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">TELEFONO REF 2</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">LINEA / NRO A PORTAR
                        </th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">MODELO EQUIPO</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">MODELO CHIP</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">ICCID</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">IMEI</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">RENTA</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">CARGO FIJO</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">PRECIO EQ.</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">PRECIO CH.</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">PR. SISAC EQ.</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">PR. SISAC CH.</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">CUOTA</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">#CUOTAS</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">DELIVERY</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">ASUME ASES</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">ASUME MOTORIZADO</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">ASUME COORDINADOR</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">ASUME EMPRESA</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">DNI / RUC</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">CLIENTE / RAZON SOCIAL
                        </th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">CORREO</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">OBSERVACION</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">MOTORIZADO</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">DISTRITO</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">REFERENCIA</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">COORDENADAS</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">IZIPAY</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">EFECTIVO</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">VALORIZACION</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">REDES SOCIALES / BASE
                        </th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(140, 187, 243)">RUTA LARGA / RUTA CORTA
                        </th>

                        <!-- /////////////SUPERVISORES//////////////////-->

                        <th style="padding: 10px 50px 10px 50px; background: rgb(178, 241, 134)">USUARIO AFILIADOR</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(178, 241, 134)">TIP. AFILIADOR</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(178, 241, 134)">FECHA DE AFILIACION
                            (AUTOMATICO)</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(178, 241, 134)">USUARIO ALMACEN CALL
                        </th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(178, 241, 134)">TIP. ALMACEN CA</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(178, 241, 134)">USUARIO DESPACHO</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(178, 241, 134)">TIP. DESPACHO</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(178, 241, 134)">HORA DE DESPACHO
                            (MANUAL)</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(178, 241, 134)">USUARIO VALIDACION</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(178, 241, 134)">TIP. VALIDACION</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(178, 241, 134)">HORA DE VALIDACION
                            (AUTOMATICO)</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(178, 241, 134)">USUARIO ACTIVACION</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(178, 241, 134)">TIP. ACTIVACION</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(178, 241, 134)">HORA DE ACTIVACION
                            (MANUAL)</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(178, 241, 134)">USUARIO VENTA LIBRE
                        </th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(178, 241, 134)">TIP. VENTA LIBRE</th>

                        <!-- /////////////SEGUIMIENTO(ADMINISTRACION)//////////////////-->

                        <th style="padding: 10px 50px 10px 50px; background: rgb(151, 242, 205)">OBSERVACION 1</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(151, 242, 205)">FEC. OBS 1 (AUTOMATICO)
                        </th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(151, 242, 205)">OBSERACION 2</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(151, 242, 205)">FEC. OBS 2 (AUTOMATICO)
                        </th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(151, 242, 205)">OBSERVACION 3</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(151, 242, 205)">FEC. OBS 3 (AUTOMATICO)
                        </th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(151, 242, 205)">OBSERVACION 4</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(151, 242, 205)">FEC. OBS 4 (AUTOMATICO)
                        </th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(151, 242, 205)">USUARIO VALIDACION</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(151, 242, 205)">OBSERVACION 5</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(151, 242, 205)">FEC. OBS 5 (AUTOMATICO)
                        </th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(151, 242, 205)">OBSERVACION 6</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(151, 242, 205)">FEC. OBS 6 (AUTOMATICO)
                        </th>

                        <!-- /////////////DOCUMENTOS PAGADOS POR LINEA//////////////////-->
                        <th style="padding: 10px 50px 10px 50px; background: rgb(209, 145, 237)">SEC</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(209, 145, 237)">CLIENTE</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(209, 145, 237)">LINEA</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(209, 145, 237)">IMPORTE</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(209, 145, 237)">INICIAL</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(209, 145, 237)">FECHA</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(209, 145, 237)">EMPRESA</th>


                        <!-- /////////////REPORTE DE COMISION 1ER COMISION//////////////////-->
                        <th style="padding: 10px 50px 10px 50px; background: rgb(226, 237, 145)">CLIENTE</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(226, 237, 145)">TELEFONO</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(226, 237, 145)">PLAN TARIF</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(226, 237, 145)">TIPO OPER</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(226, 237, 145)">COMISION TOTAL</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(226, 237, 145)">MONTO NO COMI</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(226, 237, 145)">MES PAGO</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(226, 237, 145)">OC</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(226, 237, 145)">SEC</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(226, 237, 145)">DNI / RUC</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(226, 237, 145)">DISTRIBUIDOR</th>

                        <!-- /////////////REPORTE DE COMISION 2DA COMISION//////////////////-->
                        <th style="padding: 10px 50px 10px 50px; background: rgb(237, 176, 145)">CLIENTE</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(237, 176, 145)">TELEFONO</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(237, 176, 145)">PLAN TARIF</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(237, 176, 145)">TIPO OPER</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(237, 176, 145)">COMISION TOTAL</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(237, 176, 145)">MONTO NO COMI</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(237, 176, 145)">MES PAGO</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(237, 176, 145)">OC</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(237, 176, 145)">SEC</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(237, 176, 145)">DNI / RUC</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(237, 176, 145)">DISTRIBUIDOR</th>

                        <!-- /////////////REPORTE DE COMISION 3ER COMISION//////////////////-->
                        <th style="padding: 10px 50px 10px 50px; background: rgb(237, 202, 145)">CLIENTE</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(237, 202, 145)">TELEFONO</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(237, 202, 145)">PLAN TARIF</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(237, 202, 145)">TIPO OPER</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(237, 202, 145)">COMISION TOTAL</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(237, 202, 145)">MONTO NO COMI</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(237, 202, 145)">MES PAGO</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(237, 202, 145)">OC</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(237, 202, 145)">SEC</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(237, 202, 145)">DNI / RUC</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(237, 202, 145)">DISTRIBUIDOR</th>

                        <!-- /////////////PENALIDAD 1//////////////////-->
                        <th style="padding: 10px 50px 10px 50px; background: rgb(237, 145, 173)">DISTRIBUIDOR</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(237, 145, 173)">NRO DOCUMENTO</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(237, 145, 173)">FECHA DE DESACTIVACION
                        </th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(237, 145, 173)">LINEA DESACTIVADA</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(237, 145, 173)">NOMBRE CLIENTE</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(237, 145, 173)">DESCRIPCION DE
                            PENALIDAD</th>

                        <!-- /////////////PENALIDAD 3//////////////////-->
                        <th style="padding: 10px 50px 10px 50px; background: rgb(145, 167, 237)">DISTRIBUIDOR</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(145, 167, 237)">NRO DOCUMENTO</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(145, 167, 237)">FECHA DE DESACTIVACION
                        </th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(145, 167, 237)">LINEA DESACTIVADA</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(145, 167, 237)">NOMBRE CLIENTE</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(145, 167, 237)">DESCRIPCION DE
                            PENALIDAD</th>

                        <!-- /////////////PENALIDAD 3//////////////////-->
                        <th style="padding: 10px 50px 10px 50px; background: rgb(220, 237, 145)">DISTRIBUIDOR</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(220, 237, 145)">NRO DOCUMENTO</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(220, 237, 145)">FECHA DE DESACTIVACION
                        </th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(220, 237, 145)">LINEA DESACTIVADA</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(220, 237, 145)">NOMBRE CLIENTE</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(220, 237, 145)">DESCRIPCION DE
                            PENALIDAD</th>


                        <!-- /////////////AJUSTES//////////////////-->
                        <th style="padding: 10px 50px 10px 50px; background: rgb(145, 237, 184)">TIPO DE AJUSTE</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(145, 237, 184)">FECHA 1ER PAGO</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(145, 237, 184)">MONTO DE AJUSTE 1ER
                            PAGO</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(145, 237, 184)">FECHA 2DO PAGO</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(145, 237, 184)">MONTO 2DO PAGO</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(145, 237, 184)">FECHA 3ER PAGO</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(145, 237, 184)">MONTO 3ER PAGO</th>
                        <th style="padding: 10px 50px 10px 50px; background: rgb(145, 237, 184)">ESTADO DE LA DEUDA</th>

                    </tr>
                </thead>
                <tbody>

                    <?php
                        $sql="select * from pedido where tipfDes = 'ENTREGADO' AND tipActi = 'ACTIVADO';";
                        $insertar = mysqli_query($cn,$sql);
                        while($rslistar=mysqli_fetch_array($insertar)){
        
                    ?>
                    <tr>
                        <td><?php echo $rslistar['id'];?></td>
                        <td>HOLA COMO ESTAS</td>
                        <td><?php echo $rslistar['empresa'];?></td>
                        <td>HOLA COMO ESTAS</td>
                        <td><?php echo $rslistar['sec'];?></td>
                        <td>HOLA COMO ESTAS</td>
                        <td>HOLA COMO ESTAS</td>
                        <td><?php echo $rslistar['fecha'];?></td>
                        <td><?php echo $rslistar['fechapactada'];?></td>
                        <td>HOLA COMO ESTAS</td>
                        <td>HOLA COMO ESTAS</td>
                        <td>HOLA COMO ESTAS</td>
                        <td>HOLA COMO ESTAS</td>
                        <td>HOLA COMO ESTAS</td>
                        <td>HOLA COMO ESTAS</td>
                        <td>HOLA COMO ESTAS</td>
                        <td>HOLA COMO ESTAS</td>
                        <td>HOLA COMO ESTAS</td>
                        <td>HOLA COMO ESTAS</td>
                        <td>HOLA COMO ESTAS</td>
                        <td>HOLA COMO ESTAS</td>
                        <td>HOLA COMO ESTAS</td>
                        <td>HOLA COMO ESTAS</td>
                        <td>HOLA COMO ESTAS</td>
                        <td>HOLA COMO ESTAS</td>
                        <td>HOLA COMO ESTAS</td>
                        <td>HOLA COMO ESTAS</td>
                        <td>HOLA COMO ESTAS</td>
                        <td>HOLA COMO ESTAS</td>
                        <td>HOLA COMO ESTAS</td>
                        <td>HOLA COMO ESTAS</td>
                        <td>HOLA COMO ESTAS</td>
                        <td>HOLA COMO ESTAS</td>
                        <td>HOLA COMO ESTAS</td>
                        <td>HOLA COMO ESTAS</td>
                        <td>HOLA COMO ESTAS</td>
                        <td>HOLA COMO ESTAS</td>
                        <td>HOLA COMO ESTAS</td>
                        <td>HOLA COMO ESTAS</td>
                        <td>HOLA COMO ESTAS</td>
                        <td>HOLA COMO ESTAS</td>
                        <td><?php echo $rslistar['distrito'];?></td>
                        <td>HOLA COMO ESTAS</td>
                        <td>HOLA COMO ESTAS</td>
                        <td>HOLA COMO ESTAS</td>
                        <td>HOLA COMO ESTAS</td>
                        <td>HOLA COMO ESTAS</td>
                        <td>HOLA COMO ESTAS</td>
                        <td>HOLA COMO ESTAS</td>
                    </tr>

                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>