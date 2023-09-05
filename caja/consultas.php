<?php 
    include ("../conexion.php");
    $conexion = Conectarse();
    if(isset($_POST['query'])){
        $query = $_POST['query'];
        $insertar = mysqli_query($conexion,$query);
    }
    if(isset($_POST["op"])){
        $op=$_POST["op"];
        if($op=="codigo"){
            $valor=$_POST["busqueda"];
            if($valor!=""){
                $sql="select * from formulario where codigo = '$valor';";
            }
            else{
                $sql="select * from formulario";
            }
            $insertar = mysqli_query($conexion,$sql);
            while($rslistar=mysqli_fetch_array($insertar)){
                ?>
            <TR>
                <TD class="datos1"><?php echo "EGR " . $rslistar["codigo"];?></TD>
                <TD class="datos"><?php echo $rslistar["nombreusuario"];?></TD>
                <TD class="datos"><?php echo $rslistar["concepto"];?></TD>
                <TD class="datos"><?php echo $rslistar["fecharegistro"];?></TD>
                <TD class="datos1"><?php echo $rslistar["conceptofecha"];?></TD>
                <TD class="datos1"><?php echo $rslistar["monto"];?></TD>
                <TD class="datos1"><?php echo $rslistar["empresa"];?></TD>
                <TD class="datos1"><?php echo $rslistar["cajadestino"];?></TD>
                <TD class="datos1"><?php echo $rslistar["motorizado"];?></TD>
                <TD class="datos1"><?php echo $rslistar["referencia"];?></TD>
                <TD class="datos1"><?php echo $rslistar["nautorizacion"];?></TD>
                <TD class="datos1"><?php echo $rslistar["tipo"];?></TD>
                <TD class="datos1"><?php echo $rslistar["periodo"];?></TD>
                <TD class="datos1"><?php echo $rslistar["trabajador"];?></TD>
                <TD class="datos1"><?php echo $rslistar["opmonto"];?></TD>
                <TD class="datos1"><?php echo $rslistar["montotrabajador"];?></TD>
                <TD class="datos1"><?php echo $rslistar["documento"];?></TD>
                <TD class="datos1"><?php echo $rslistar["serie"];?></TD>
                <TD class="datos1"><?php echo $rslistar["numero"];?></TD>
                <TD class="datos1"><?php echo $rslistar["numerooperacion"];?></TD>
                <TD class="datos1"><?php echo $rslistar["provedor"];?></TD>
                <TD class="datos1"><?php echo $rslistar["slrc"];?></TD>
                <TD class="datos1"><?php echo $rslistar["fechafactura"];?></TD>
                <TD class="datos1"><?php echo $rslistar["direccion"];?></TD>
                <TD class="datos1"><?php echo $rslistar["observacioncompro"];?></TD>
                <TD class="datos1"><?php echo $rslistar["izipay"];?></TD>
                <TD class="datos1"><?php echo $rslistar["banco"];?></TD>
                <TD class="datos1"><?php echo $rslistar["fechavoucher"];?></TD>
                <TD class="datos1"><?php echo $rslistar["horavoucher"];?></TD>
                <TD class="datos1"><?php echo $rslistar["fechaconfirmacion"];?></TD>
                <TD class="datos1"><?php echo $rslistar["deposito"];?></TD>
                <TD class="datos1"><?php echo $rslistar["observacion"];?></TD>


            </TR>

            <?php 
            }
        }
    }
?>