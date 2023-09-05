
<?php 
    include ("../coneccion.php");
    $cn = db::conectar();


    $serie = $_POST['serie'];
    $numero = $_POST['numero'];
    $empresa = $_POST['empresa'];
    $fechaemision = $_POST['fechaemision'];
    $nombredni = $_POST['nombredni'];
    $codigoficha = $_POST['codigoficha'];
    $clienters = $_POST['clienters'];
    $rucdni = $_POST['rucdni'];
    $codigounico = $_POST['codigounico'];
    $direccion = $_POST['direccion'];
    $textproducto = $_POST['textproducto'];
    $contadoefectivo = $_POST['contadoefectivo'];
    $dias = $_POST['dias'];
    $pago = $_POST['pago'];

    // $cantidad = $_POST['cantidad'];
    // $precio = $_POST['precio'];
    // $valorNeto = $_POST['valorNeto'];
    // $igv = $_POST['igv'];
    // $total = $_POST['total'];
    // $estado = $_POST['estado'];


    $sql = "INSERT INTO `productos`(`serie`, `numero`, `empresa`, `fechaemision`, `nombredni`, `codigoficha`, `clienters`, `rucdni`, `codigounico`, `direccion`, `textproducto`, `contadoefectivo`, `dias`, `pago`) 
    VALUES ('$serie','$numero','$empresa','$fechaemision','$nombredni','$codigoficha','$clienters',
    '$rucdni','$codigounico','$direccion','$textproducto','$contadoefectivo','$dias','$pago')";

    mysqli_query($cn, $sql);

    $rslistar = "select * from productos";
    $listar = mysqli_query($cn,$rslistar);
    while($rslistar=mysqli_fetch_array($listar)){
    
    ?>
    <tr ondblclick="obtenerCodigo(<?php echo $rslistar['id']; ?>)" id="registro_<?php echo $rslistar['id']; ?>">
        <td><?php echo $rslistar["id"]?></td>
        <td><?php echo $rslistar["empresa"]?></td>
        <td><?php echo $rslistar["serie"]?></td>
        <td><?php echo $rslistar["numero"]?></td>
        <td><?php echo $rslistar["fechaemision"]?></td>
        <td><?php echo $rslistar["codigoficha"]?></td>
        <td><?php echo $rslistar["clienters"]?></td>
        <td><?php echo $rslistar["rucdni"]?></td>
        <td><?php echo $rslistar["direccion"]?></td>
        <td><?php echo $rslistar["textproducto"]?></td>
        <td><?php echo $rslistar["contadoefectivo"]?></td>
        <td><?php echo $rslistar["pago"]?></td>
        <td><?php echo $rslistar["dias"]?></td>
        <td><?php echo $rslistar["codigounico"]?></td>
        <!-- <td><?php //echo $rslistar["cantidad"]?></td>
        <td><?php //echo $rslistar["precio"]?></td>
        <td><?php //echo $rslistar["valorNeto"]?></td>
        <td><?php //echo $rslistar["igv"]?></td>
        <td><?php //echo $rslistar["total"]?></td>
        <td><?php //echo $rslistar["estado"]?></td> -->
    </tr>
    <?php
    }
       
    if(isset($_POST["op"])){
        $op=$_POST["op"];
        if($op=="editar"){
            $editar = $_POST['editar'];
            echo mysqli_query($conexion ,$editar);
        }
    }
?>