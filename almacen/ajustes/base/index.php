<html>
<head>
	<meta charset="utf-8" />
	<title>Convert Excel to HTML Table using JavaScript</title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
    <style>
        #tbl_exporttable_to_xls{
            width: 100%;
            text-align: center;
        }
        td,th{
            min-width: 150px;
        }
    </style>
    
 
<!-- links para exportar a excel -->
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
    <header>
        <?php include("../../header.php") ?>
    </header>

<div class="conte-titulo">
<h1>BASES</h1>
</div>

    <div class="container">
   	
               <div class="conte-file" id="conte-file"> <input type="file" id="excel_file" /></div>
                <div><button onclick="ExportToExcel('xlsx')" class="bajar"> DESCARGAR DOCUMENTO</button></div>
                <div><button onclick="VaciarTabla()" class="bajar" style="background:red;color: white;">ELIMINAR BASE DE DATOS</button></div>
    		</div>


            <!-- -------tabla------------------
         -->
         <div id="contador"></div>
            <div class="contenedor">
        <div class="conte-table" >
            <table id="tbl_exporttable_to_xls">
                <tbody id="excel_data">
                    <tr>
                        <th class="enca">id</th>
                        <th class="enca">CLIENTE</th>
                        <th class="enca">DNI</th>
                        <th class="enca">NUMERO REF</th>
                        <th class="enca">TIPIF1</th>
                        <th class="enca">TIPIF2</th>
                        <th class="enca">FECHA</th>
                        <th class="enca">H. Inicio llamada</th>
                        <th class="enca">H. fin llamada</th>
                        <th class="enca">asesor</th>
                        <th class="enca">sede</th>
                    </tr>
                    <?php
                        include ("../../coneccion.php");
                        $cn = Db::conectar();
                        $id=0;
                        $consulta = mysqli_query($cn,"select * from numerosllamadas limit 100");
                        while($x=mysqli_fetch_array($consulta)){
                            $id=$x["id"];
                    ?>
                    <tr>
                        <td><?php echo $id;?></td>
                        <td><?php echo $x["cliente"];?></td>
                        <td><?php echo $x["dni"];?></td>
                        <td><?php echo $x["referencia"];?></td>
                        <td><?php echo $x["tipif1"]; ?></td>
                        <td><?php echo $x["tipif2"]; ?></td>
                        <td><?php echo $x["fecha"]; ?></td>
                        <td><?php echo $x["inicio"]; ?></td>
                        <td><?php echo $x["fin"]; ?></td>
                        <td><?php echo $x["asesor"]; ?></td>
                        <td><?php ?></td>
                    </tr>
                    <?php 
                }
                if($id==100){
                    ?>
                    <td>---</td>
                    <td>---</td>
                    <td>---</td>
                    <td>---</td>
                    <td>---</td>
                    <td>---</td>
                    <td>---</td>
                    <td>---</td>
                    <td>---</td>
                    <td>---</td>
                    <td>---</td>
                    <?php
                $consulta = mysqli_query($cn,"select * from numerosllamadas ORDER BY id DESC limit 1");
                while($x=mysqli_fetch_array($consulta)){
                    $id=$x["id"];
                ?>
                <tr>
                    <td><?php echo $id;?></td>
                    <td><?php echo $x["cliente"];?></td>
                    <td><?php echo $x["dni"];?></td>
                    <td><?php echo $x["referencia"];?></td>
                    <td><?php echo $x["tipif1"]; ?></td>
                    <td><?php echo $x["tipif2"]; ?></td>
                    <td><?php echo $x["fecha"]; ?></td>
                    <td><?php echo $x["inicio"]; ?></td>
                    <td><?php echo $x["fin"]; ?></td>
                    <td><?php echo $x["asesor"]; ?></td>
                    <td><?php ?></td>
                </tr>
                <?php }}?>
                </tbody>

            </table>
            <?php   echo "<script> var id=".$id.";document.getElementById('contador').innerHTML = \"Hay un total de: \"+id+\" registros.\";</script>"?>
        </div>
       </div>
   
   

 <script src="Export.js"> 
</script> 
<script src="Import.js"> 
</script> 


</body>
</html>
