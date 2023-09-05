<?php 
    include ("../../coneccion.php");
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
    <title>Planes</title>
    <link rel="stylesheet" href="planes.css">
</head>
<body>
    <header>
        <?php include("../../header.php") ?>
    </header>
   <div class="contenedor">
<div class="contenedor-planes">

<!-- ---------------- Planes------------ -->
<div class="planes">
<div class="planes-clase"><input type="checkbox"><label>MODO DE VENTA</label> <input type="text"id=""></div>
<div class="planes-clase"><input type="checkbox"><label>TIPO</label> <input type="text"id=""></div>
<div class="planes-clase"><input type="checkbox"><label>CATEGORIA</label> <input type="text"id=""></div>
<div class="planes-clase"><input type="checkbox"><label>PLAN</label><input type="text"id=""></div>

<div  class="planes-clase" ><input type="button" id="planes" class="button-planes" value="INGRESAR PLANES"/></div>



</div>
<!-- -----------------titulo de planes----------- -->
<div class="contenedor-planes_titulo"><h1>REGISTRO DE PLANES</h1></div>
</div>
</div> 
<!-- ----------------tabla de planes-------------- -->

<div class="conte-tabla">
 <div class="tabla" id="ta">
<table >
    <thead>
    <tr>
        <th class="encabezado">MODO DE VENTA</th>
        <th class="encabezado">TIPÓ</th>
        <th class="encabezado">CATEGORIA</th>
        <th class="encabezado">PLAN</th>
        <th class="encabezado">PESO DE VENTA CALL CENTER</th>
        <th class="encabezado">CF CALL</th>
        <th class="encabezado">PESO VENTA TIENDA</th>
        <th class="encabezado">CF TIENDA</th>
        <th class="encabezado">PESO VENTA COORD.</th>
        <th class="encabezado">CF COORD.</th>
        <th class="encabezado">PESO VENTA JEFE DE OPERACIONES</th>
        <th class="encabezado">CF JO</th>
        <th class="encabezado">HABILITAR / DESHABILITAR</th>
    </tr>
    </thead>
    <!-- <tbody id="tbPlan" > -->
    <tbody >

    <?php 
        while($rslistar=mysqli_fetch_array($listar)){

        ?>

        <tr>
            <td><?php echo $rslistar["monto"];?></td>
            <td><?php echo $rslistar["tipo"];?></td>
            <td><?php echo $rslistar["categoria"];?></td>
            <td><?php echo $rslistar["plan"];?></td>
            <td><?php echo $rslistar["peso_tienda"];?></td>
            <td><?php echo $rslistar["call_venta"];?></td>
            <td><?php echo $rslistar["peso_tienda"];?></td>
            <td><?php echo $rslistar["tienda"];?></td>
            <td><?php echo $rslistar["venta_coord"];?></td>
            <td><?php echo $rslistar["cf_coord"];?></td>
            <td><?php echo $rslistar["operaciones"];?></td>
            <td><?php echo $rslistar["cf_jo"];?></td>
            <td><?php echo $rslistar["ha_desa"];?></td>
    
        </tr>

        <?php 
            }
        ?>
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
                       
                    <label >INGRESAR MODO DE VENTA: </label><select id="Pventa" class="Pventa" name="Pventa">
                            <option value=""></option>
                            <option value="PREPAGO">PREPAGO</option>
                            <option value="POSTPAGO">POSTPAGO</option>
                        </select>
                    
                    <br>
                    <label >INGRESAR TIPÓ: </label><select id="Ptipo" class="Ptipo" name="Ptipo">
                            <option value=""></option>
                            <option value="PORTABILIDAD">PORTABILIDAD</option>
                            <option value="RENOVACION">RENOVACION</option>
                            <option value="REPOSICION">REPOSICION</option>
                            <option value="ALTA">ALTA</option>
                            <option value="MIGRACION">MIGRACION</option>
                            <option value="OLO">OLO</option>
                            <option value="HFC">HFC</option>
                            <option value="TFI">TFI</option>
                            <option value="IFI">IFI</option>
                          
                        </select><br>
                
                    <label >INGRESAR CATEGORIA: </label>
                    
                    <select id="Pcategoria" class="Pcategoria" name="Pcategoria">
                            <option value=""></option>
                            <option value="EQUIPO">EQUIPO</option>
                            <option value="CHIP">CHIP</option>
                            <option value="SERVICIO">SERVICIO</option>
                        </select>

                    <br>
                    
                    <label >INGRESAR PLAN: </label><input id="plan" type="text" /><br>
                    <label >INGRESAR PESO DE VENTA CALL CENTER: </label><input id="peso-center" type="text" /><br>
                    <label >INGRESAR CF CALL: </label><input id="call" type="text" /><br>
                    <label >INGRESAR PESO VENTA TIENDA: </label><input id="peso-tienda" type="text" /><br>
                    <label >INGRESAR CF TIENDA: </label><input id="tienda" type="text" /><br>
                    <label >INGRESAR PESO VENTA COORD.: </label><input id="peso-coord" type="text" /><br>
                    <label >INGRESAR CF COORD.: </label><input id="coord" type="text" /><br>
                    <label >INGRESAR PESO VENTA JEFE DE OPERACIONES: </label><input id="operaciones" type="text" /><br>
                    <label >INGRESAR CF JO: </label><input id="cf-jo" type="text" /><br>
                    <label >ACTIVO / INACTIVO: </label>
                    <select id="habi-desa" class="habi-desa" name="habi-desa">
                            <option value=""></option>
                            <option value="ACTIVO">ACTIVO</option>
                            <option value="INACTIVO">INACTIVO</option>
                           
                        </select>
                    <br>
                        
                     
                     <input type="button" onclick="botonPlane()"  class="button" value="GUARDAR PLANES">
                   
                   
                   
                    </div>

                </div>
            </div>
        </div>

        <script src="Modal.js"></script>
        <script src="registro.js"></script>
</body>
</html>