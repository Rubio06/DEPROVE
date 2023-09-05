<?php 
    require_once("../../coneccion.php");
    $cn = Db::conectar();
    $rslistar = 'select dni_ruc,nombre_razon,correo,distrito,direccion from cliente WHERE Personal="J"';
    $listar = mysqli_query($cn,$rslistar); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>REGISTRO DE CLIENTE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
</head>
<style>
*{
    font-family: Arial, Helvetica, sans-serif;
}
table{
    width: 100%;
    font-size: 20px;
}
th{
    background: rgb(181, 193, 188);
}
tr{
    height: 50px;
    font-size: 16px;
    font-weight: 600;
    text-align: center;
}
</style>
<body>
    <?php include("../../header.php") ?>
    <div style="background-color: rgb(255, 231, 123);padding: 5px 10px;width: 45%;border-radius:10px;margin-bottom: 50px;" >
       <h1 >REGISTRO DE PERSONA JURIDICA</h1>
    </div>
    <div style="overflow:scroll;width: 90%;margin: auto;max-height: 450px;">
        <table border="2" cellspacing="0" align="center">
            <tr style="position: sticky;top: 0;">
                <th>RUC</th>
                <th>RAZON SOCIAL</th>
                <th>CORREO</th>
                <th>DISTRITO</th>
                <th>DIRECCION</th>
            </tr>
            <tbody>

                <?php 
        while($rslistar=mysqli_fetch_array($listar)){
        ?>
                <tr>        
                    <td><?php echo $rslistar["dni_ruc"];?></td>
                    <td><?php echo $rslistar["nombre_razon"];?></td>
                    <td><?php echo $rslistar["correo"];?></td>
                    <td><?php echo $rslistar["distrito"];?></td>
                    <td><?php echo $rslistar["direccion"];?></td>
                 
                </tr>
                <?php 
            }
        ?>
            </tbody>
        </table>
    </div>
</body>
</html>