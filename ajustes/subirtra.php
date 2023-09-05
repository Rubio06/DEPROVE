<?php
require_once(__DIR__."/../coneccion.php");
$cn=Db::conectar();
    $meses=["","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
    if(isset($_POST['query'])){
        $query = $_POST['query'];
        $insertar = mysqli_query($cn,$query);
    }
    else if(isset($_POST["op"])){
        $op=$_POST["op"];
        $ante="";
        if($op=="SubirDatos"){
            $sql = "INSERT IGNORE INTO planes VALUES (null,'".$_POST["Pventa"].
            "','" . strtoupper($_POST["Ptipo"]).
            "', '" . strtoupper($_POST["Pcategoria"]). 
            "', '" . strtoupper($_POST["plan"]).
            "', 'A');";
            echo mysqli_query($cn,$sql);
        }
        else if($op=="SubirPeso"){
            $sql = "INSERT IGNORE INTO pesoventa VALUES (null,'".$_POST["plan"].
            "', '" . ($_POST["pesoVenta"]).
            "', '" . ($_POST["pesoVentaTienda"]).
            "', '" . ($_POST["mes"]).
            "-01');";
            echo mysqli_query($cn,$sql);
        }
        else if($op=="SubirTipoPlan"){
            mysqli_query($cn,"INSERT IGNORE INTO tipoPlan VALUES (null,'".strtoupper($_POST["Nuevo"])."');");
            $m=mysqli_query($cn,"SELECT * from tipoPlan");
            while ($x=mysqli_fetch_array($m)) {
                echo "<option value='".$x["id"]."'>".$x["nombre"]."</option>";
            }
        }
        else if($op=="SubirPro"){
            $sql = "INSERT IGNORE INTO promocion VALUES (null,'".$_POST["plan"].
            "','" . strtoupper($_POST["promocion"]).
            "', '" . strtoupper($_POST["Pfechadesde"]). 
            "', '" . strtoupper($_POST["Pfechahasta"]).
            "');";
            echo mysqli_query($cn,$sql);
        }
        else if($op=="SubirTec"){
            $sql = "INSERT IGNORE INTO tecnica VALUES (null,'".$_POST["plan"].
            "','" . strtoupper($_POST["tecnica"]).
            "', '" . strtoupper($_POST["Tfechadesde"]). 
            "', '" . strtoupper($_POST["Tfechahasta"]).
            "');";
            echo mysqli_query($cn,$sql);
        }
        else if($op=="SubirLoca"){
            $sql = "INSERT IGNORE INTO locacion VALUES (null,'".$_POST["serie"].
            "','" . strtoupper($_POST["razon"]).
            "', '" . strtoupper($_POST["rucdev"]).
            "', '" . strtoupper($_POST["direccion"]).
            "', '" . strtoupper($_POST["distrito"]).
            "', '" . strtoupper($_POST["pais"]).
            "', '" . strtoupper($_POST["departamento"]).
            "', '" . strtoupper($_POST["ciudad"]).
            "', '" . strtoupper($_POST["nom_locacion"]).
            "', '" . strtoupper($_POST["direc_locacion"]).
            "', '" . strtoupper($_POST["numero"]).
            "', '" . strtoupper($_POST["numero2"]).
            "', '" . strtoupper($_POST["numero3"]).
            "', '" . strtoupper($_POST["persona"]).
            "', '" . strtoupper($_POST["num_auto"]).
            "', '" . strtoupper($_POST["num_reg"]).
            "', '" . strtoupper($_POST["anulacion"]).
            "', '" . strtoupper($_POST["compras"]).
            "', '" . strtoupper($_POST["caja"]).
            "', '" . strtoupper($_POST["descuentos"]).
            "', '" . strtoupper($_POST["host"]).
            "', '" . strtoupper($_POST["correo"]).
            "', '" . strtoupper($_POST["contraseña"]).
            "', '" . strtoupper($_POST["boleta"]).
            "', '" . strtoupper($_POST["factura"]).
            "', '" . strtoupper($_POST["ticket"]).
            "', '" . strtoupper($_POST["credito"]).
            "', '" . strtoupper($_POST["debito"]).
            "', '" . strtoupper($_POST["tu"]).
            "', '" . strtoupper($_POST["tipo"]).
            "');";

            echo mysqli_query($cn,$sql);
        }
        else if($op=="BajarDatos"){
            $listar = mysqli_query($cn,"SELECT * from planes inner join tipoPlan on tipoPlan.id=planes.tipo order by nombre, categoria, plan;");
            while($rslistar=mysqli_fetch_array($listar)){
                ?>
                <tr>
                    <td><?php echo $rslistar["modo_venta"];?></td>
                    <td><?php echo $rslistar["nombre"];?></td>
                    <td><?php echo $rslistar["categoria"];?></td>
                    <td><?php echo $rslistar["plan"];?></td>
                    <td><?php if($rslistar["habil_des"]=="A"){echo "HABILITADO";}else{echo "DESHABILTADO";}?></td>
                </tr>
                <?php 
                    }
        }
        else if($op=="BajarTipoPlan"){
            $m=mysqli_query($cn,"SELECT * from tipoPlan");
            while ($x=mysqli_fetch_array($m)) {
                echo "<option value='".$x["id"]."'>".$x["nombre"]."</option>";
            }
        }
        else if($op=="BajarPeso"){
            $listar = mysqli_query($cn,"SELECT planes.plan,tipoPlan.nombre,planes.categoria, pesoventa,tienda,mes from pesoventa inner join planes on pesoventa.plan=planes.id inner join tipoPlan on planes.tipo=tipoPlan.id order by mes,nombre,categoria;");
            while($rslistar=mysqli_fetch_array($listar)){
                ?>
                <tr>
                    <td><?php echo $rslistar["nombre"];?></td>
                    <td style="text-align:center;"><?php echo $rslistar["categoria"];?></td>
                    <td style="text-align:center;"><?php echo $rslistar["plan"];?></td>
                    <td style="text-align:center;"><?php echo $rslistar["pesoventa"];?></td>
                    <td style="text-align:center;"><?php echo $rslistar["tienda"];?></td>
                    <td><?php echo $meses[(int)date("m",strtotime($rslistar["mes"]))].' del '.date("Y",strtotime($rslistar["mes"]));?></td>
                    <td style="display:none"><?php echo $rslistar["mes"];?> </td>
                </tr>
                <?php 
              }
            }
        else if($op=="BajarPro"){
            $listar = mysqli_query($cn,"select * from promocion;");
            while($rslistar=mysqli_fetch_array($listar)){
                ?>
                <tr>
                    <td><?php echo $rslistar["plan"];?></td>
                    <td><?php echo $rslistar["promocion"];?></td>
                    <td><?php echo $rslistar["desde"];?></td>
                    <td><?php echo $rslistar["hasta"];?></td>
                </tr>
                <?php 
                }
        }    
        else if($op=="BajarTec"){
            $listar = mysqli_query($cn,"select * from tecnica;");
            while($rslistar=mysqli_fetch_array($listar)){
                ?>
                <tr>
                    <td><?php echo $rslistar["plan"];?></td>
                    <td><?php echo $rslistar["tecnica"];?></td>
                    <td><?php echo $rslistar["desde"];?></td>
                    <td><?php echo $rslistar["hasta"];?></td>
                </tr>
                <?php 
                }
        }    
        else if($op=="BajarLoca"){
            $listar = mysqli_query($cn,"select * from locacion where tipo='DEPROVE';");
            while($rslistar=mysqli_fetch_array($listar)){
                ?>
                <tr>
                    <td><?php echo $rslistar["serie"];?></td>
                    <td><?php echo $rslistar["razon"];?></td>
                    <td><?php echo $rslistar["rucdev"];?></td>
                    <td><?php echo $rslistar["direccion"];?></td>
                    <td><?php echo $rslistar["distrito"];?></td>
                    <td><?php echo $rslistar["pais"];?></td>
                    <td><?php echo $rslistar["departamento"];?></td>
                    <td><?php echo $rslistar["ciudad"];?></td>
                    <td><?php echo $rslistar["nom_locacion"];?></td>
                    <td><?php echo $rslistar["direc_locacion"];?></td>
                    <td><?php echo $rslistar["numero"];?></td>
                    <td><?php echo $rslistar["numero2"];?></td>
                    <td><?php echo $rslistar["numero3"];?></td>
                    <td><?php echo $rslistar["persona"];?></td>
                    <td><?php echo $rslistar["num_auto"];?></td>
                    <td><?php echo $rslistar["num_reg"];?></td>
                    <td><?php echo $rslistar["anulacion"];?></td>
                    <td><?php echo $rslistar["compras"];?></td>
                    <td><?php echo $rslistar["caja"];?></td>
                    <td><?php echo $rslistar["descuentos"];?></td>
                    <td><?php echo $rslistar["host"];?></td>
                    <td><?php echo $rslistar["correo"];?></td>
                    <td><?php echo $rslistar["contraseña"];?></td>
                    <td><?php echo $rslistar["boleta"];?></td>
                    <td><?php echo $rslistar["factura"];?></td>
                    <td><?php echo $rslistar["ticket"];?></td>
                    <td><?php echo $rslistar["credito"];?></td>
                    <td><?php echo $rslistar["debito"];?></td>
                    <td><?php echo $rslistar["tu"];?></td>    
                </tr>
                <?php 
                }
        } 
        else if($op=="BajarKo"){
            $listar = mysqli_query($cn,"select * from locacion where tipo='KOMUNICATE';");
            while($rslistar=mysqli_fetch_array($listar)){
                ?>
                <tr>
                    <td><?php echo $rslistar["serie"];?></td>
                    <td><?php echo $rslistar["razon"];?></td>
                    <td><?php echo $rslistar["rucdev"];?></td>
                    <td><?php echo $rslistar["direccion"];?></td>
                    <td><?php echo $rslistar["distrito"];?></td>
                    <td><?php echo $rslistar["pais"];?></td>
                    <td><?php echo $rslistar["departamento"];?></td>
                    <td><?php echo $rslistar["ciudad"];?></td>
                    <td><?php echo $rslistar["nom_locacion"];?></td>
                    <td><?php echo $rslistar["direc_locacion"];?></td>
                    <td><?php echo $rslistar["numero"];?></td>
                    <td><?php echo $rslistar["numero2"];?></td>
                    <td><?php echo $rslistar["numero3"];?></td>
                    <td><?php echo $rslistar["persona"];?></td>
                    <td><?php echo $rslistar["num_auto"];?></td>
                    <td><?php echo $rslistar["num_reg"];?></td>
                    <td><?php echo $rslistar["anulacion"];?></td>
                    <td><?php echo $rslistar["compras"];?></td>
                    <td><?php echo $rslistar["caja"];?></td>
                    <td><?php echo $rslistar["descuentos"];?></td>
                    <td><?php echo $rslistar["host"];?></td>
                    <td><?php echo $rslistar["correo"];?></td>
                    <td><?php echo $rslistar["contraseña"];?></td>
                    <td><?php echo $rslistar["boleta"];?></td>
                    <td><?php echo $rslistar["factura"];?></td>
                    <td><?php echo $rslistar["ticket"];?></td>
                    <td><?php echo $rslistar["credito"];?></td>
                    <td><?php echo $rslistar["debito"];?></td>
                    <td><?php echo $rslistar["tu"];?></td>    
                </tr>
                <?php 
                }
        }   
    }
?>