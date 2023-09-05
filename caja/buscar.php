<?php 
   include ("../coneccion.php");
   $conexion = db::conectar();
    if(isset($_POST["op"])){
        $op=$_POST["op"];
        if($op=="buscar"){
            $codigo=$_POST["codigo"];
            $concepto=$_POST["concepto"];
            $banco=$_POST["banco"];
            $filtro=" CONCAT(tipoIE,codigo) like '%$codigo%'";
            if($concepto!=""){
                $filtro=$filtro." and concepto ='$concepto'";
            }
            if($banco!=""){
                $filtro=$filtro." and banco='$banco'";
            }
            $sql="select concat(tipoIE,codigo) as CODIGO ,formulario.* from formulario where id=0 or ($filtro)";
            $insertar = mysqli_query($conexion,$sql);
            $prim=mysqli_fetch_assoc($insertar);
            if($prim!=null){
                unset($prim["id"]);
                unset($prim["tipoIE"]);
                unset($prim["codigo"]);
                // echo json_encode($prim);
                $llaves=array_keys($prim);
                while($rslistar=mysqli_fetch_assoc($insertar)){ ?>
                <tr ondblclick="abrir_deta('<?php echo $rslistar['id'] ?>')">
                    <?php for($i=0;$i<count($llaves);$i++){
                            $d=$llaves[$i];
                            if($d=="CODIGO"){
                                echo "<td id=\"$rslistar[id]\" class=\"datos\"><p>$rslistar[$d]</p> <button onclick=\"Eliminar('$rslistar[id]')\">ELIMINAR</button></td>";
                            }
                            else if($d=="monto"){
                                echo "<td class=\"datos\"> S/.$rslistar[$d] </td>";
                            }
                            else{
                                echo "<td class=\"datos\"> $rslistar[$d] </td>";
                            }
                        } ?>
                </tr>
                <?php }
            }
            else{
                echo "<tr>No Hay datos en la bd</tr>";
            }
        }
        else if($op=="trabajador"){
            $valor=$_POST["busqueda"];
            $sql = "SELECT id, 
              concat(nombre, ' ',
              apellido) as nombre,
              dni,
              empresa
            FROM trabajador
            where nombre like '%".$valor."%' or apellido like '%".$valor."%' or dni like '%".$valor."%' order by dni;";
            $insertar = mysqli_query($conexion,$sql);
            while($listar=mysqli_fetch_array($insertar)){
                ?>
                    <option value='<?php echo json_encode([$listar["dni"],$listar["nombre"],$listar["empresa"]]);?>'  ><?php echo $listar["dni"]." - ".$listar["nombre"];?></option>
                  <?php 
            }  
        }
        else if($op=="subirbanco"){
            $sql = "INSERT INTO banco VALUES (null,'".strtoupper($_POST['banco'])."');";
            mysqli_query($conexion,$sql);
            $resultado = mysqli_query($conexion,"SELECT banco from banco order by banco;");
            while($mostrar = mysqli_fetch_array($resultado)){
            ?>
                <option value="<?php echo $mostrar['banco']; ?>"><?php echo $mostrar['banco']?></option>
                <?php
            }
        }
        else if($op=="SubirPeriodo"){
            $sql = "INSERT INTO periodo VALUES (null,'".strtoupper($_POST['periodo'])."');";
            mysqli_query($conexion,$sql);
            $resultado = mysqli_query($conexion,"SELECT periodo from periodo order by periodo;");
            while($mostrar = mysqli_fetch_array($resultado)){
            ?>
                <option value="<?php echo $mostrar['periodo']; ?>"><?php echo $mostrar['periodo']?></option>
                <?php
            }
        }
        else if($op=="SubirTipo"){
            $sql = "INSERT INTO tipo VALUES (null,'".strtoupper($_POST['tipo'])."');";
            echo $sql;
            mysqli_query($conexion,$sql);
            $resultado = mysqli_query($conexion,"SELECT tipo from tipo order by tipo;");
            while($mostrar = mysqli_fetch_array($resultado)){ ?>
                <option value="<?php echo $mostrar['tipo']; ?>"><?php echo $mostrar['tipo']?></option> <?php
            }
        }
        else if($op=="dnivendedor"){
            $valor=$_POST["busqueda"];
            if($valor != ""){    
                $listar = mysqli_fetch_array(mysqli_query($conexion," SELECT concat (nombre, apellido) as nombre FROM trabajador INNER JOIN cargo ON trabajador.idcargo = cargo.idcargo WHERE cargo = 'ASESOR DE VENTAS' AND dni = '$valor';"));
                if($listar!=null && $listar !=""){
                    echo $listar['nombre'];
                }else{
                    echo "No";
                }
            }else{
                echo "No";      
            }
        }
        else if($op=="eliminar"){
            echo mysqli_query($conexion,"delete from formulario where id=".$_POST["id"]);
        }
        else if($op=="editar"){
            $editar = $_POST['editar'];
            echo mysqli_query($conexion ,$editar);
        }
 
    }
?>

