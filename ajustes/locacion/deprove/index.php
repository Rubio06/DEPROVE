<?php 
    include ("../../../coneccion.php");
    $cn = Db::conectar();
    $rslistar = "select * from planes;";
    $listar = mysqli_query($cn,$rslistar);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTRO DE LOCACION</title>
    <link rel="stylesheet" href="locacion.css">
</head>
<body>
    <?php include("../../../header.php") ?>
   <div class="contenedor">
<div class="contenedor-planes">


         <div class="planes">
         <div class="planes-clase"><label>DIRECCION</label> <input type="text"id=""></div>
         <div class="planes-clase"><label>NUMERO</label> <input type="text"id=""></div>
         <div class="planes-clase"><label>SERIE</label> <input type="text"id=""></div>


    <div  class="planes-clase" ><input type="button" id="planes" class="button-planes" value="INGRESAR LOCACION"/></div>



    </div>

    <div class="contenedor-planes_titulo"><h1>REGISTRO DE LOCACION DEPROVE</h1></div>
</div>
</div> 


<div class="conte-tabla">
 <div  style="overflow:scroll;width: 90%;margin: auto;max-height: 450px;">
<table >
    <thead>
    <tr>
        <th class="encabezado">SERIE</th>
        <th class="encabezado">RAZON SOCIAL</th>
        <th class="encabezado">RUC</th>
        <th class="encabezado">DIRECCION</th>
        <th class="encabezado">DISTRITO</th>
        <th class="encabezado">PAIS</th>
        <th class="encabezado">DEPARTEMENTO</th>
        <th class="encabezado">CIUDAD</th>
        <th class="encabezado">NOMB. LOCACION</th>
        <th class="encabezado">DIRECCION LOCACION</th>
        <th class="encabezado">NUMERO 1</th>
        <th class="encabezado">NUMERO 2</th>
        <th class="encabezado">NUMERO 3</th>
        <th class="encabezado">PERSONA</th>
       <th class="encabezado">N° DE AUTORIZACIÓN</th>
       <th class="encabezado">N° DE REGISTRO</th>
       <th class="encabezado">ANULACION</th>
       <th class="encabezado">COMPRAS</th>
       <th class="encabezado">CAJA</th>
       <th class="encabezado">DESCUENTOS</th>
       <th class="encabezado">HOST</th>
       <th class="encabezado">CORREO</th>
       <th class="encabezado">CONTRASEÑA</th>
       <th class="encabezado">U. Nro. BOLETA</th>
       <th class="encabezado">U. Nro. FACTURA</th>
       <th class="encabezado">U. Nro. TICKET</th>
       <th class="encabezado">U. Nro. CREDITO</th>
       <th class="encabezado">U. Nro. DEBITO</th>
       <th class="encabezado">T.U</th>
    </tr>
    </thead>
     <tbody id="tbTec" >
    <tbody>
</tbody>
</table>
</div>
</div>
<!-- -----------------------------Modal de Registro de Planes-------------------- -->
<div id="miModal" class="modal">
            <div class="flex" id="flex">
                <div class="contenido-modal">
                    <div class="modal-header flex">
                        <h2>LOCACION</h2>
                        <span class="close" id="close">&times;</span>
                    </div>
                    <div class="modal-body">
                    <input id="tipo" type="button" value="DEPROVE"/>
                    <h3>DATOS GENERALES :</h3>
                        <label >SERIE :</label><input id="serie" type="text" /><br>
                       <label >RAZON SOCIAL :</label><input  id="razon" type="text" /><br>
                        <label >RUC :</label><input  id="rucdev" type="text" /><br>
                        <label >DIRECCION :</label><input  id="direccion" type="text" /><br>
                        <label> DISTRITO: </label><input id="distrito" type="text"/></br>
                        <label> PAIS :</label><input id="pais" type="text"/></br>
                        <label> DEPARTAMENTO :</label><input id="departamento" type="text"/></br>
                        <label> CIUDAD :</label><input id="ciudad" type="text"/></br>
                        <label>NOMB. LOCACION :</label><input type="text" id="nom_locacion"/></br>
                        <label >DIRECCION LOCACION:</label><input  id="direc_locacion" type="text" /><br>
                        <label >NUMERO 1: </label><input  id="numero" type="number" /><br>
                        <label >NUMERO 2: </label><input  id="numero2" type="number2" /><br>
                        <label >NUMERO 3: </label><input  id="numero3" type="number3" /><br>
                        <label>PERSONA DE </label><input id = "persona" type="text"></br>
                        <label >N° DE AUTORIZACIÓN: </label><input  id="num_auto" type="text"/><br>
                        <label >N° DE REGISTRO: </label><input  id="num_reg" type="text"/><br>
                    <h3>CLAVES :</h3>
                        <label >ANULACION: </label><input  id="anulacion" type="number" /><br>
                        <label >COMPRAS:</label><input  id="compras" type="number" /><br>
                        <label >CAJA :</label><input  id="caja" type="number" /><br>
                        <label >DESCUENTOS :</label><input  id="descuentos" type="number" /><br>  
                    <h3>CONFIGURACION DE CORREO</h3>
                        <label >HOST :</label><input id="host" type="text"/></br>
                        <label >CORREO :</label><input id="correo" type="mail"/></br>
                        <label >CONTRASEÑA :</label><input id="contraseña" type="password"/></br>
                    <h3>FACTURACIÓN</h3>  
                       <label> U. Nro. BOLETA :</label><input  id="boleta"tye="number"/></br>
                       <label> U. Nro. FACTURA :</label><input  id="factura"tye="number"/></br>
                       <label> U. Nro. TICKET :</label><input  id="ticket"tye="number"/></br>
                       <label> U. Nro. CREDITO :</label><input  id="credito"tye="number"/></br>
                       <label> U. Nro. DEBITO :</label><input  id="debito"tye="number"/></br>
                       <input type="radio" id="tu" value="INFORMACION"><label>T.U</label></br>     
                         <input type="button" onclick="GrabarLoca()"  class="button" value="GUARDAR LOCACION">

                    </div>

                </div>
            </div>
        </div>

        <script src="Modal.js"></script>
        <script src="registro.js"></script>
</body>
</html>