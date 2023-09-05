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
    <title>PESO DE VENTA</title>
    <link rel="stylesheet" href="../planes.css">
</head>
<body>
    <header>
        <?php include("../../../header.php") ?>
    </header>
   <div class="contenedor">
<div class="contenedor-planes">

<!-- ---------------- Planes------------ -->
<div class="planes">
<div class="planes-clase"><label>PLAN</label> <input type="text"id=""></div>
<div class="planes-clase"><label>TECNICA</label> <input type="text"id=""></div>
<div class="planes-clase"><label>DESDE</label> <input type="text"id=""></div>
<div class="planes-clase"><label>HASTA</label><input type="text"id=""></div>

<div  class="planes-clase" ><input type="button" id="planes" class="button-planes" value="INGRESAR PLANES"/></div>



</div>
<!-- -----------------titulo de planes----------- -->
<div class="contenedor-planes_titulo"><h1>REGISTRO TECNICA DE MARKETING</h1></div>
</div>
</div> 
<!-- ----------------tabla de planes-------------- -->

<div class="conte-tabla">
 <div  style="overflow:scroll;width: 90%;margin: auto;max-height: 450px;">
<table >
    <thead>
    <tr>
        <th class="encabezado">PLAN</th>
        <th class="encabezado">TECNICA DE MARKETING</th>
        <th class="encabezado">DESDE</th>
        <th class="encabezado">HASTA</th>
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
                        <h2>TECNICA</h2>
                        <span class="close" id="close">&times;</span>
                    </div>
                    <div class="modal-body">
                       
                    <label >INGRESAR PLAN: </label>
                
                    <select id="plan" class="Pventa" name="Pventa">
                        <?php $resultado = mysqli_query($cn,"SELECT concat(tipo, ' ', plan) as plan,id from planes order by plan;");
                            while($mostrar = mysqli_fetch_array($resultado)){ ?>
                            <option value="<?php echo $mostrar['id']; ?>"> <?php echo $mostrar['plan']; ?></option>
                            <?php } ?>
                    </select>
                    <br>
 
                    <label >INGRESAR TECNICA: </label><input  id="tecnica" type="text" /><br>
                    <label >DESDE </label><input id="Tfechadesde" type="date" /><br>
                    <label >HASTA </label><input id="Tfechahasta" type="date" /><br>
                   
                    <br>
                        
                     
                     <input type="button" onclick="GrabarTec()"  class="button" value="GUARDAR PLANES">
                   
                   
                   
                    </div>

                </div>
            </div>
        </div>

        <script src="../Modal.js"></script>
        <script src="registro.js"></script>
</body>
</html>