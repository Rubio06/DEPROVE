<?php 
    include ("../../coneccion.php");
    $cn = Db::conectar();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planes</title>
    <link rel="stylesheet" href="planes.css">
</head>
<body>

        <?php include("../../header.php") ?>
   
   <div class="contenedor">
<div class="contenedor-planes">

<!-- ---------------- Planes------------ -->
<div class="planes">
<div class="planes-clase"><label>MODO DE VENTA</label> <input type="text"id=""></div>
<div class="planes-clase"><label>TIPO</label> <input type="text"id=""></div>
<div class="planes-clase"><label>CATEGORIA</label> <input type="text"id=""></div>
<div class="planes-clase"><label>PLAN</label><input type="text"id=""></div>

<div  class="planes-clase" ><input type="button" id="planes" class="button-planes" value="INGRESAR PLANES"/></div>
</div>
<!-- -----------------titulo de planes----------- -->
<div class="contenedor-planes_titulo"><h1>REGISTRO DE PLANES</h1></div>
</div>
</div> 
<!-- ----------------tabla de planes-------------- -->

<div class="conte-tabla">
 <div  style="overflow:scroll;width: 90%;margin: auto;max-height: 450px;">
<table >
    <thead>
    <tr>
        <th class="encabezado">MODO DE VENTA</th>
        <th class="encabezado">TIPÓ</th>
        <th class="encabezado">CATEGORIA</th>
        <th class="encabezado">PLAN</th>
        <th class="encabezado">HABILITAR / DESHABILITAR</th>
    </tr>
    </thead>
     <tbody id="tbPlan" >
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
                        <h2>REGISTRO DE PLANES</h2>
                        <span class="close" id="close">&times;</span>
                    </div>
                    <div class="modal-body">
                    <div>
                        <label >INGRESAR MODO DE VENTA: </label>
                        <select id="Pventa" class="Pventa" name="Pventa">
                            <option value="PREPAGO">PREPAGO</option>
                            <option value="POSTPAGO">POSTPAGO</option>
                        </select>
                    </div>
                    <div>
                        <label >INGRESAR TIPÓ: </label>
                        <select id="Ptipo" class="Ptipo" name="Ptipo">
                        </select>
                        <button onclick="subirTipoPlan()"> + </button>
                    </div>
                    <div>
                        <label >INGRESAR CATEGORIA: </label>
                        <select id="Pcategoria" class="Pcategoria" name="Pcategoria">
                            <option value="EQUIPO">EQUIPO</option>
                            <option value="CHIP">CHIP</option>
                            <option value="SERVICIO">SERVICIO</option>
                        </select>
                    </div>
                    <div>
                        <label >INGRESAR PLAN: </label>
                        <input id="plan" type="text" /><br>
                    </div>          
                    <div id="mostActiv">
                        <label >ACTIVO / INACTIVO: </label>
                        <input type="checkbox" name="habi-desa" id="habi-desa">
                    </div>
                     <input type="button" onclick="botonPlane()"  class="button" value="GUARDAR PLANES">
                   
                    </div>

                </div>
            </div>
        </div>
        <script src="Modal.js"></script>
        <script src="registro.js"></script>
        <script>BajarTipoPlan()</script>
</body>
</html>