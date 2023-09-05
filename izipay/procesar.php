<?php

include ("../coneccion.php");
$cn = db::conectar();

 if(isset($_POST["op"])){
     $op=$_POST["op"];
     if($op=="buscar"){
        $valor=$_POST["busqueda"];
        $insertar = mysqli_query($cn,"SELECT id, sec,dni,cliente,direccion,empresa FROM pedido where cliente like '%$valor%' or dni like '%$valor%';");
        try {
            while($listar = mysqli_fetch_assoc($insertar)){ ?>
                <option value='<?php echo json_encode([$listar["id"],$listar["sec"],$listar["dni"],$listar["cliente"],$listar["direccion"],$listar["empresa"]]);?>'><?php echo $listar["sec"]." - ".$listar["cliente"];?></option>
            <?php }
        } catch (\Throwable $th) {
            echo $sql;
        }
    }else if ($op == "buscarCodigo"){
        $valor = $_POST["buscando"];
        $insertar = mysqli_query($cn,"SELECT id, sec,dni,cliente,direccion,empresa FROM pedido where sec like '%$valor%';");
        echo "SELECT id, sec,dni,cliente,direccion,empresa FROM pedido where sec like '%$valor%';";
        try {
            while($listar = mysqli_fetch_assoc($insertar)){ ?>
                <option value='<?php echo json_encode([$listar["id"],$listar["sec"],$listar["dni"],$listar["cliente"],$listar["direccion"],$listar["empresa"]]);?>'><?php echo $listar["sec"]." - ".$listar["cliente"];?></option>
            <?php }
        } catch (\Throwable $th) {
            echo $sql;
        }
    }else if($op=="obtenerCodigo"){
        echo json_encode(mysqli_fetch_assoc(mysqli_query($cn,"select * from productos where id='".$_POST["id"]."'")));
    }else if ($op=="actualizarTabla"){
        $rslistar = "select * from productos";
        $listar = mysqli_query($cn,$rslistar);
        while($rslistar=mysqli_fetch_array($listar)){ ?>
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
        <?php }
    }else if($op == "editar"){

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
        $id = $_POST['id'];
        $estado = $_POST['estado'];

        echo mysqli_query($cn,"UPDATE `productos` SET`serie`=' $serie',`numero`='$numero',
        `empresa`='$empresa',`fechaemision`='$fechaemision',`nombredni`='$nombredni',`codigoficha`='$codigoficha',
        `clienters`='$clienters',`rucdni`='$rucdni ',`codigounico`=' $codigounico',`direccion`='$direccion'
        ,`textproducto`='$textproducto',`contadoefectivo`='$contadoefectivo',`dias`='$dias',`pago`='$pago',`estado`='$estado' WHERE `id`='$id'");

    }else if($op == "eliminar"){
        echo mysqli_query($cn,"delete from productos where id=".$_POST["id"]);
    }
 }

?>