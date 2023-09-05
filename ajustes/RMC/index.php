<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro modalidad de cuota</title>
    <link rel="stylesheet" href="estilo.css">
    <style>
        td{
            font-size:28px;
            text-align:center;
            padding: 5px 15px;
        }
        th{
            font-size:32px;
            text-align:center;
            padding: 5px 15px;
        }
    </style>
</head>
<body> 
    <?php include_once("../../header.php"); ?>
<h1  style="font-size:48px; text-align:center;">REGISTRAR MODALIAD CUOTA</h1>
<input type="button" id="registro" value="INGRESAR CAMPOS"/>

<table>
<thead >
<tr>
 <th>FECHA</th>
 <th>MODALIDAD</th>
 <th>CANTIDAD</th>
</tr>
</thead>
<tbody>

<?php
    $ante="";
    require_once("../../coneccion.php");
    $rs=mysqli_query(Db::conectar(),"SELECT * from cuotaModalidad order by fecha asc");
    $modalidades=["P"=>"Part-time","M"=>"Mini Full","F"=>"Full time"];
    $rand="";
    $meses=["","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
    while($x=mysqli_fetch_array($rs)){
        $count=mysqli_fetch_array(mysqli_query(Db::conectar(),"SELECT count(*) as num from cuotaModalidad where fecha='".$x["fecha"]."'"));
        echo "<tr>";
        if($ante!=$x["fecha"]){
            $Mes= (int) substr($x["fecha"],5,2);
            $rand="style='background:rgb(".rand(50,255).",".rand(50,255).",".rand(50,150).");'";
            echo "<td ".$rand."  rowspan=".$count["num"].">".$meses[$Mes]." del ".substr($x["fecha"],0,4)."</td>";
            echo "<td ".$rand." >".$modalidades[$x["modalidad"]]."</td>";
            echo "<td ".$rand." >".$x["cantidad"]."</td></tr>";
        }
        if($ante==$x["fecha"]){
            echo "<td ".$rand.">".$modalidades[$x["modalidad"]]."</td>";
            echo "<td ".$rand.">".$x["cantidad"]."</td>";
        }
        echo "</tr>";
        $ante=$x["fecha"];
    }
?>
</tbody>    
</table>


<!-- MODAL DE REGISTRO -->

  <!-- MODAL SEDE -->
  <div id="miModalre" class="modal">
            <div class="flex" id="flexre">
                <div class="contenido-modal">
                    <div class="modal-header flex">
                        <h2>INGRESAR</h2>
                        <span class="close" id="closere">&times;</span>
                    </div>
                    <div class="modal-body">

                    <label >FECHA :</label>
                    <input type="month" id="Fecha"/>
                    <br>
                    <label >PAR-TIME :</label>
                    <input type="number" id="Par"/>
                    <br>
                    <label >MINI-FULL :</label>
                    <input type="number" id="Mini"/>
                 
                    <br>
                    <label >FULL-TIME :</label>
                    <input type="number" id="Full"/>
                    <br>

                     <input type="button" onclick="subirbotonCuota()"  class="button" value="GUARDAR">

                    </div>

                </div>
            </div>
        </div>
</body>
</html>
    <script src="./main.js"></script>