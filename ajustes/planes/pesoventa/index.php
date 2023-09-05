<?php 
    include ("../../../coneccion.php");
    $cn = Db::conectar();
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
    <?php include("../../../header.php") ?>
    <div class="contenedor">
        <div class="contenedor-planes">
            <!-- ---------------- Planes------------ -->
            <div class="planes">
                <div class="planes-clase">
                    <label>PLAN</label> 
                    <input type="text"id="">
                </div>
                <div class="planes-clase">
                    <label>PESO VENTA</label>
                     <input type="text"id="">
                    </div>
                <div class="planes-clase">
                    <label>MES</label> 
                    <input type="month"id="">
                </div>
                <div  class="planes-clase" >
                    <input type="button" id="planes" class="button-planes" value="INGRESAR PLANES"/>
                </div>
            </div>
            <!-- -----------------titulo de planes----------- -->
            <div class="contenedor-planes_titulo"><h1>REGISTRO DE PESO VENTA</h1></div>
        </div>
    </div> 
    <!-- ----------------tabla de planes-------------- -->

    <div class="conte-tabla">
        <div style="overflow:auto;width: 90%;margin: auto;height: 450px;border:1px solid rgb(127, 240, 170);border-radius:15px;">
            <table>
                <thead style="position: sticky;top: 0;background: rgb(127, 240, 170);">
                    <tr>
                        <th rowspan=2>PLAN</th>
                        <th rowspan=2>CATEGORIA</th>
                        <th rowspan=2>PLAN</th>
                        <th colspan=2>PESO VENTA</th>
                        <th rowspan=2>MES</th>
                    </tr>
                    <tr>
                        <th style="border-top: 1px solid white;">ASESOR</th>
                        <th style="border-left: 1px solid white;">TIENDA</th>
                    </tr>
                </thead>
                <tbody id="tbPeso" >
                </tbody>
            </table>
        </div>
    </div>
    <!-- -----------------------------Modal de Registro de Planes-------------------- -->
    <div id="miModal" class="modal">
        <div class="flex" id="flex">
            <div class="contenido-modal">
                <div class="modal-header flex">
                    <h2>PESO DE VENTA</h2>
                    <span class="close" id="close">&times;</span>
                </div>
                <div class="modal-body">
                    <div>
                        <label >INGRESAR PLAN: </label>
                        <select id="plan" class="Pventa" name="Pventa">
                            <?php $resultado = mysqli_query($cn,"SELECT concat(categoria, ' ', plan) as plan,nombre,planes.id from planes inner join tipoPlan on planes.tipo=tipoPlan.id order by nombre,plan;");
                            $ante="";
                            while($mostrar = mysqli_fetch_array($resultado)){ 
                                if($ante!=$mostrar['nombre']){
                                    $ante=$mostrar['nombre'];
                                    echo "<option disabled>".$mostrar['nombre']."</option>";
                                }
                                ?>
                                <!-- <option value="<?php //echo $mostrar['id']; ?>"> <?php //echo $mostrar['plan']; ?></option> -->
                                <option value="<?php echo $mostrar['id']; ?>"> <?php echo $mostrar['plan']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div>
                        <label >INGRESAR PESO VENTA ASESOR: </label>
                        <input id="pesoVenta" type="number" min="1" step="any" />
                    </div>
                    <div>
                        <label >INGRESAR PESO VENTA TIENDA: </label>
                        <input id="pesoVentaTienda" type="number" min="1" step="any" />
                    </div>
                    <div>
                        <label >Mes:</label>
                        <input  id="mes" type="month" value="<?php echo date("Y-m");?>" />
                    </div>
                    
                    <br> 
                        <input type="button" onclick="Grabar()"  class="button" value="GUARDAR PLANES">
                </div>
            </div>
        </div>
    </div>
    <script>
        mesActu=<?php echo date("Y-m");?>;
    </script>
    <script src="../Modal.js"></script>
    <script src="registro.js"></script>
</body>
</html>