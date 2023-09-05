<?php
    require_once ("../../../coneccion.php");
    $cn = Db::conectar();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/estilos.css">
    <script src="https://unpkg.com/xlsx@0.16.9/dist/xlsx.full.min.js"></script>
    <script src="https://unpkg.com/file-saverjs@latest/FileSaver.min.js"></script>
    <script src="https://unpkg.com/tableexport@latest/dist/js/tableexport.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>
    <script src="https://code.jquery.com/jquery-latest.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css" rel="stylesheet">
    <link rel="stylesheet" href="base.css">
</head>
<body>
    <?php 
        include("modal.php");
        include("../header.php");
    ?>

    <div class="container">
    <br>
    <br>
        <!-- <h1 class="footer" style="background: rgb(228, 243, 54); padding: 10px; ">DOCUMENTOS</h1>
        <br> -->
        <div class="primercontenedor">
            <div>
                <button class="actualizar" id="actualizar" name="actualizar"
                    style="padding: 10px 30px 10px 30px;">ACTUALIZAR</button>
            </div>
            <div>
                <label for="input1">SEC/LINEA/DNI/CLIENTE</label>
                <br>
                <input type="text" class="input1" name="input1" id="input" style="width: 100%; font-size: 20px;">
            </div>
            <div>
                <div class="conte-file" id="conte-file">
                    <input type="file" id="excel_file" />
                </div>
            </div>
            <div>
                <button id="buscarFicha" name="buscarFicha" style="padding: 15px 30px 15px 30px;">BUSCAR FICHA</button>
            </div>
        </div>
        <br>
        <br>
        <div>
            <h2
                style="width: 60%; border:2px solid black; text-align: center; margin: auto; padding: 10px; border-radius: 5px; background: rgb(225, 237, 95);">
            COMISIONES PAGADAS NO ENCONTRADAS EN BOLETAS DE VENTA</h2>
        </div>
        <br>
        <div style="margin:auto; width: 15%;">
            <button id="abrirmodal" style="width: 100%; height: 40px; font-size: 15px; border-radius: 10px;">MOSTRAR</button>
        </div>
    </div>
    <br>
    <br>


    <div style="overflow:scroll;width: 100%;margin: auto;max-height: 450px;">
        <table id="excel_data" border="2" cellspacing="0" style="width: 98%; margin:auto;">
            <thead style="background: rgb(181, 193, 188); position: sticky;top: 0;">
                <th>DISTRIBUIDOR / DISTRIB</th>
                <th>CLIENTE</th>
                <th>TELEFONO / MSISDN</th>
                <th>PLAN TARIF</th>
                <th>TIPO PLAN / MODALID</th>
                <th>TPO OPER</th>
                <th>COMISION TOTAL / COMISION</th>
                <th>MONTO NO COMI / MOT NO COMI</th>
                <th> / TIPO COMISION 1er comi. 2da comi. 3er comi.</th>
                <th>MES PAGO</th>
                <th>OC / POLISA</th>
                <th>SEC</th>
                <th>DNI CLIENTE / DNI RUC</th>
            </thead>
            <?php
                $sql="select * from comision";
                $insertar = mysqli_query($cn,$sql);
                while($rslistar=mysqli_fetch_array($insertar)){
            ?>
            <tr>   
                <td><?php echo $rslistar["distribuidor"];?></td>
                <td><?php echo $rslistar["cliente"];?></td>
                <td><?php echo $rslistar["telefonomsisdn"];?></td>
                <td><?php echo $rslistar["plantarifa"];?></td>
                <td><?php echo $rslistar["tipoplanmodalidad"];?></td>
                <td><?php echo $rslistar["transacciontpooper"];?></td>
                <td><?php echo $rslistar["comisiontotal"];?></td>
                <td><?php echo $rslistar["octipocomision"];?></td>
                <td><?php echo $rslistar["montocomision"];?></td>
                <td><?php echo $rslistar["mespago"];?></td>
                <td><?php echo $rslistar["ocpolisa"];?></td>
                <td><?php echo $rslistar["sec"];?></td>
                <td><?php echo $rslistar["dniclienteoruc"];?></td>

            </tr>
            <?php
            }
        ?>
        </table>
    </div>
    <script>
    id = 0;
    </script>
    <script src="js/import.js"></script>
</body>
</html>