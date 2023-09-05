<?php 
require_once("../coneccion.php");
$cn = Db::conectar();
session_start();
if($_SESSION==null||!isset($_SESSION["id_moto"])){
    echo "<script>alert('Logueate para continuar');window.location.assign(\"//deproveglobal.com/login/?sig=motorizado\")</script>";
    die();
}
echo json_encode($_SESSION);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Pedido</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
<h1>Registro de Motorizado</h1>
<div style="overflow:auto;width: 90%;margin: auto;max-height:600px;margin-top:50px">
        <table border="2" cellspacing="0" align="center">
        <tr>
        <thead>
        <th colspan="7" style="position:relative;"><span style="position:absolute; left:5px">NOMBRE MOTORIZADO: <?php echo $_SESSION["nombre"] ?> </span></th>
        </thead>
        </tr>
             <tr style="position: sticky;top: 0;">
            <th>ID</th>
            <th>CLIENTE</th>
            <th>FECHA DE ENTREGA</th>
            <th>DISTRITO</th>
            <th>DESPACHO</th>
            <th>ACTIVACION</th>
            <th>AFILIADOR</th>
            </tr>
            <tbody id=cuerpotabla>
            </tbody>
        </table>
    </div>
    <div id="blur"></div>
    <div class="pedido-modal" id="modal">
            <div style="left: 0;width:100%;top: 0;position: absolute;background-color: rgb(97, 98, 98);display:flex;justify-content:center;align-items:center;">     
                <img onclick="CerrarModal()" style="position: absolute;left: 5px;" class="close" src="https://www.svgrepo.com/show/273966/close.svg" width="25px"> 
                <b id="EmpresaAMostrar" style="color:yellow;font-weight: 700;font-size:25px;">EMPRESA</b>
            </div>
            <div id="conte-sub">
                <div>NOMBRE: <b style="background: rgb(225, 124, 124);"></b><br></div>
                <div>DNI: <b style="background: rgb(225, 124, 124);"></b><br></div>
                <div>DISTRITO: <b style="background: rgb(225, 124, 124);"></b><br></div>
                <div>REF LUGAR: <b style="background: rgb(225, 124, 124);"></b> <br></div>
                <div>TELF.REF 1: <b style="background: rgb(225, 124, 124);"></b><br></div>
                <div>TELF.REF 2: <b style="background: rgb(225, 124, 124);"></b><br></div>
                <div>OBSERVACION: <b style="background: rgb(225, 124, 124);"></b><br></div>
                <hr>
                <div style="display:flex;justify-content: space-between;"><label>DELIBERY:</label><label>15.00</label></div>
                <div style="margin-top:10px; text-align:center">------------ PLAN 1 -----------</div>
                <div style="display:flex;justify-content: space-between;"><label>CHIP:</label><label>15.00</label></div>
                <div style="display:flex;justify-content: space-between;"><label>EQUIPOS:</label><label>15.00</label></div>
                <div style="display:flex;justify-content: space-between;"><label>RENTA:</label><label>15.00</label></div>
                <div style="margin-top:10px; text-align:center">------------ PLAN 2 -----------</div>
                <div style="display:flex;justify-content: space-between;"><label>CHIP:</label><label>15.00</label></div>
                <div style="display:flex;justify-content: space-between;"><label>EQUIPOS:</label><label>15.00</label></div>
                <div style="display:flex;justify-content: space-between;"><label>RENTA:</label><label>15.00</label></div>
                <div style="margin-top:10px; text-align:center">------------ PLAN 3 -----------</div>
                <div style="display:flex;justify-content: space-between;"><label>CHIP:</label><label>15.00</label></div>
                <div style="display:flex;justify-content: space-between;"><label>EQUIPOS:</label><label>15.00</label></div>
                <div style="display:flex;justify-content: space-between;"><label>RENTA:</label><label>15.00</label></div>
                <hr>
                <div style="margin-top:10px; float:left;">Pago Total</div>
                <div style="margin-top:10px; float:right;">S/.48.50</div>
            </div>
            <div class="content-botton">
                <div>
                    <div>
                        <label style="font-size:19px;font-weight:600;">SELECCIONE: </label>
                        <select id="info" style="font-weight:700;height:40px;">
                            <option value=""></option>
                            <option  class="re"value="NO RESPONDE">NO RESPONDE</option>
                            <option  class="re"value="RUTA">RUTA</option>
                            <option  class="re"value="CANCELADO">CANCELADO</option>
                            <option class="correct"value="REPROGRAMADO">REPROGRAMADO</option>
                            <option class="correct"value="ENTREGADO">ENTREGADO</option>
                            <option class="correct"value="ENTREGADO DIRECCION REPETIDA">ENTREGADO DIRECCION REPETIDA</option>
                            <option  class="coord" value="COORDINADO 9 - 11 AM">COORDINADO 9 - 11 AM</option>
                            <option  class="coord" value="COORDINADO 11 - 1 PM">COORDINADO 11 - 1 PM</option>
                            <option  class="coord" value="COORDINADO 1 - 3 PM">COORDINADO 1 - 3 PM</option>
                            <option  class="coord" value="COORDINADO 3 - 5 PM">COORDINADO 3 - 5 PM</option>
                            <option  class="coord" value="COORDINADO 5 - 6 PM">COORDINADO 5 - 6 PM</option>
                        </select>
                    </div>
                    <div style="width: 100%;display:flex;justify-content: center;margin-top:10;">
                        <input type="button" value="GUARDAR" id="btn_estado">
                    </div>
                </div>
                    <img class="chats" id="chat" src="https://www.svgrepo.com/show/1734/speaking.svg" width="80">
            </div>
        </div>
        
        <script src="modal.js"></script>
</body>
</html>