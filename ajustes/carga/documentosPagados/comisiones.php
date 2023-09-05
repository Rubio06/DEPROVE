<?php
    require_once ("../coneccion.php");
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
    <?php include("modal.php")?>
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
                <input type="text" class="input1" name="input1" id="input1" style="width: 100%; font-size: 20px;">
            </div>
            <div>
                <div class="conte-file" id="conte-file">
                    <input type="file" id="excel_file2" />
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
            COMISIONES PAGADAS NO ENCONTRADAS EN EL SISTEMA</h2>
        </div>
        <br>
        <div style="margin:auto; width: 15%;">
            <button id="abrirmodal" style="width: 100%; height: 40px; font-size: 15px; border-radius: 10px;">MOSTRAR</button>
        </div>
    </div>
    <br>
    <br>


    <div style="overflow:scroll;width: 90%;margin: auto;max-height: 450px;">
        <table id="excel_data" border="2" cellspacing="0" style="width: 98%; margin:auto;">
            <thead style="background: rgb(181, 193, 188);">
                <th>NUMERO DE COMISION</th>
                <th>DISTRIBUIDOR</th>
                <th>CLIENTE</th>
                <th>TELEFONO</th>
                <th>CF</th>
                <th>TIPO PLAN</th>
                <th>TRANSACCION</th>
                <th>COMISION TOTAL</th>
                <th>OC</th>
                <th>FECHA CARGA</th>
                <th>SEC</th>
                <th>DNI CLIENTE</th>
            </thead>
            <?php
                $sql="select * from comisiones";
                $insertar = mysqli_query($cn,$sql);
                while($rslistar=mysqli_fetch_array($insertar)){
            ?>
            <tr>                
                <td><?php echo $rslistar["numerocomision"];?></td>
                <td><?php echo $rslistar["distribuidor"];?></td>
                <td><?php echo $rslistar["cliente"];?></td>
                <td><?php echo $rslistar["telefono"];?></td>
                <td><?php echo $rslistar["cf"];?></td>
                <td><?php echo $rslistar["tipoplan"];?></td>
                <td><?php echo $rslistar["transaccion"];?></td>
                <td><?php echo $rslistar["comisiontotal"];?></td>
                <td><?php echo $rslistar["oc"];?></td>
                <td><?php echo $rslistar["fechacarga"];?></td>
                <td><?php echo $rslistar["sec"];?></td>
                <td><?php echo $rslistar["dnicliente"];?></td>
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