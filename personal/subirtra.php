<?php
require_once(__DIR__."/../coneccion.php");
$conexion=Db::conectar();
    if(isset($_POST['query'])){
        $query = $_POST['query'];
        $insertar = mysqli_query($conexion,$query);
    }
    if(isset($_POST["op"])){
        $op=$_POST["op"];
        $ante="";
        if($op=="buscar"){
            $sql = "SELECT 
              nombre,
              apellido,
              trabajador.id,
              telefono, 
              estado_civil, 
              email,
              direccion,
              banco,
              fecha_naci, 
              numero_cuenta, 
              cci_cuenta ,
              afp_onp, 
              cuota_ojt,
              fecha_c ,
              reclutadora, 
              capacitador, 
              campaña, 
              jefe ,
              empresa, 
              estado, 
              modalidad ,
              turno,
              fecha_in, 
              fecha_ojt, 
              fecha_capa, 
              CUSPP,
              Sueldo, 
              hora_ingre,
              fecha_cese_op, 
              fecha_cese_pla, 
              fecha_VD,
              fecha_VH ,
              fecha_DESD, 
              fecha_DESH, 
              motivo_cese ,sede,area,cargo
            FROM trabajador
            INNER JOIN sede ON trabajador.idsede = sede.idsede
            INNER JOIN area ON trabajador.idarea = area.idarea
            INNER JOIN cargo ON trabajador.idcargo = cargo.idcargo
            where ".$_POST["filtros"].";";
            $insertar = mysqli_query($conexion,$sql);
            // echo $sql;
            while($rslistar=mysqli_fetch_array($insertar)){
              $cuot=mysqli_fetch_array(mysqli_query($conexion,"Select * from historialCuota where trabajador= '".$rslistar["id"]."' and fecha = '".date("Y-m")."-01'"));
              if($cuot==null){$cuot["cantidad"]="";}
              ?>
                <tr ondblclick="actualizarPorId('<?php echo $rslistar['id'];?>')">
                  <td><?php echo $rslistar["nombre"];?></td>
                    <td><?php echo $rslistar["apellido"];?></td>
                    <td><?php echo $rslistar["id"];?></td>
                    <td><?php if(substr($rslistar["telefono"],0,1)!="0"){ echo $rslistar["telefono"];}?></td>
                    <td><?php echo $rslistar["estado_civil"];?></td>
                    <td><?php echo $rslistar["email"];?></td>
                    <td><?php echo $rslistar["direccion"];?></td>
                    <td><?php echo $rslistar["banco"];?></td>
                    <td><?php if(substr($rslistar["fecha_naci"],0,1)!="0"){ echo date("d-m-Y", strtotime($rslistar["fecha_naci"]));}?></td>
                    <td><?php echo $rslistar["numero_cuenta"];?></td>
                    <td><?php echo $rslistar["cci_cuenta"];?></td>
                    <td><?php echo $rslistar["afp_onp"];?></td>
                    <td><?php echo $cuot["cantidad"];?></td>
                    <td><?php if(substr($rslistar["fecha_c"],0,1)!="0"){echo date("d-m-Y", strtotime($rslistar["fecha_c"]));}?></td>
                    <td><?php echo $rslistar["cuota_ojt"];?></td>
                    <td><?php echo $rslistar["reclutadora"];?></td>
                    <td><?php echo $rslistar["capacitador"];?></td>
                    <td><?php echo $rslistar["campaña"];?></td>
                    <td><?php echo $rslistar["jefe"];?></td>
                    <td><?php echo $rslistar["empresa"];?></td>
                    <td><?php echo $rslistar["estado"];?></td>
                    <td><?php echo $rslistar["modalidad"];?></td>
                    <td><?php echo $rslistar["turno"];?></td>
                    <td><?php if(substr($rslistar["fecha_in"],0,1)!="0"){echo date("d/m/Y", strtotime($rslistar["fecha_in"]));}?></td>
                    <td><?php if(substr($rslistar["fecha_ojt"],0,1)!="0"){echo date("d/m/Y", strtotime($rslistar["fecha_ojt"]));}?></td>
                    <td><?php if(substr($rslistar["fecha_capa"],0,1)!="0"){echo date("d/m/Y", strtotime($rslistar["fecha_capa"]));}?></td>
                    <td><?php echo $rslistar["CUSPP"];?></td>
                    <td><?php if(substr($rslistar["Sueldo"],0,1)!="0"){echo "S/.".number_format($rslistar["Sueldo"],2);}?></td>
                    <td><?php if(substr($rslistar["hora_ingre"],0,2)!="00"){echo date("h:i a", strtotime($rslistar["hora_ingre"]));}?></td>
                    <td><?php if(substr($rslistar["fecha_cese_op"],0,1)!="0"){echo date("d/m/Y", strtotime($rslistar["fecha_cese_op"]));}?></td>
                    <td><?php if(substr($rslistar["fecha_cese_pla"],0,1)!="0"){echo date("d/m/Y", strtotime($rslistar["fecha_cese_pla"]));}?></td>
                    <td><?php if(substr($rslistar["fecha_VD"],0,1)!="0"){echo "DESDE: ".date("d/m/Y", strtotime($rslistar["fecha_VD"]))." <br><br> HASTA: ".date("d/m/Y", strtotime($rslistar["fecha_VH"]));}?></td>
                    <td><?php if(substr($rslistar["fecha_DESD"],0,1)!="0"){echo date("d/m/Y", strtotime($rslistar["fecha_DESD"]));}?></td>
                    <td><?php if(substr($rslistar["fecha_DESH"],0,1)!="0"){echo date("d/m/Y", strtotime($rslistar["fecha_DESH"]));}?></td>
                    <td><?php echo $rslistar["motivo_cese"];?></td>
                    <td><?php echo $rslistar["sede"];?></td>
                    <td><?php echo $rslistar["area"];?></td>
                    <td><?php echo $rslistar["cargo"];?></td>
                  </tr>
                  <?php 
            }
        }
        else if($op=="subirsede"){
          $sql="insert into sede values (null,'".strtoupper($_POST["sed"])."')";
          $insertar = mysqli_query($conexion,$sql);
          $con=mysqli_query($conexion, "SELECT * from sede ORDER BY sede ASC");
          while($x=mysqli_fetch_array($con)){
            $s="";
            if($x["sede"]==strtoupper($_POST["sed"])){$s="selected";}
            if($ante!=strtoupper(substr($x["sede"],0,1))){
              $ante=strtoupper(substr($x["sede"],0,1));
              echo '<option disabled>'.$ante.'</option>';
            }
            echo '<option '.$s.' value="'.$x["idsede"].'">'.$x["sede"].'</option>';
            }
        }
        else if($op=="subircargo"){
            $sql="insert ignore into cargo values (null,'".strtoupper($_POST["car"])."')";
            $insertar = mysqli_query($conexion,$sql);
            $con=mysqli_query($conexion, "SELECT * from cargo ORDER BY cargo ASC");
            while($x=mysqli_fetch_array($con)){
              $s="";if($x["cargo"]==strtoupper($_POST["car"])){$s="selected";}
              if($ante!=strtoupper(substr($x["cargo"],0,1))){
                $ante=strtoupper(substr($x["cargo"],0,1));
                echo '<option disabled>'.$ante.'</option>';
              }
              echo '<option value="'.$x["idcargo"].'" '.$s.'>'.$x["cargo"].'</option>';
            }
        }
        else if($op=="subirreclu"){
          $sql="INSERT ignore into medioReclutamiento values (null,'".strtoupper($_POST["reclu"])."')";
          $insertar = mysqli_query($conexion,$sql);
          $con=mysqli_query($conexion, "SELECT * from medioReclutamiento ORDER BY nombre ASC");
          while($x=mysqli_fetch_array($con)){
            $s="";
            if($ante!=strtoupper(substr($x["nombre"],0,1))){
              $ante=strtoupper(substr($x["nombre"],0,1));
              echo '<option disabled>'.$ante.'</option>';
            }
            if($x["nombre"]==strtoupper($_POST["reclu"])){$s="selected";}
            echo '<option '.$s.' value="'.$x["id"].'">'.$x["nombre"].'</option>';
          }
        }  
        else if($op=="subirarea"){
          $sql="insert ignore into area values (null,'".strtoupper($_POST["ar"])."')";
          $insertar = mysqli_query($conexion,$sql);
          $con=mysqli_query($conexion, "SELECT * from area ORDER BY area ASC");
          while($x=mysqli_fetch_array($con)){
            $s="";
            if($ante!=strtoupper(substr($x["area"],0,1))){
              $ante=strtoupper(substr($x["area"],0,1));
              echo '<option disabled>'.$ante.'</option>';
            }
            if($x["area"]==strtoupper($_POST["ar"])){$s="selected";}
            echo '<option '.$s.' value="'.$x["idarea"].'">'.$x["area"].'</option>';
          }
        }  
        else if($op=="subirbanco"){
          $sql="insert ignore into banco values (null,'".strtoupper($_POST["ba"])."')";
          $insertar = mysqli_query($conexion,$sql);
          $con=mysqli_query($conexion, "SELECT * from banco ORDER BY banco ASC");
          while($x=mysqli_fetch_array($con)){
            $s="";
            if($ante!=strtoupper(substr($x["banco"],0,1))){
              $ante=strtoupper(substr($x["banco"],0,1));
              echo '<option disabled>'.$ante.'</option>';
            }
            if($x["banco"]==strtoupper($_POST["ba"])){$s="selected";}
            echo '<option '.$s.' value="'.$x["id"].'">'.$x["banco"].'</option>';
          }
        }  
        else if($op=="bajarCuota"){
          $d=substr($_POST["car"],0,1);
          if($d=="L"){
            echo 0;
          }
          else{
            $con=mysqli_fetch_array(mysqli_query($conexion, "SELECT * from cuotaModalidad where fecha='".$_POST["fecha"]."-01' and modalidad='".$d."'"));
            if($con!=null){
              echo $con["cantidad"];
            }
            else{
              echo 0;
            }
          }
        }
        else if($op=="subirCuota"){
          if($_POST["edita"]=="1"){
            $edita="PERSONALIZADA";
          }
          else{
            $edita="GENERAL";
          }
          $count=mysqli_fetch_array(mysqli_query($conexion, "SELECT count(*) as c, id from historialCuota where trabajador='".($_POST["dni"])."' and fecha='".($_POST["fecha"])."-01';"));
          if($count["c"]!="0"){
            if(mysqli_query($conexion, "UPDATE historialCuota set tipo='".($edita)."', cantidad='".($_POST["cantidad"])."' where id=".$count["id"].";")){
              echo "editado";
            }
            else{
              echo "edita-mal '".$count["c"]."' - '".$count["id"]."'";
            }
          }
          else{
            if(mysqli_query($conexion, "INSERT into historialCuota values(null,'".($_POST["dni"])."','".($_POST["fecha"])."-01','".($edita)."','".($_POST["cantidad"])."');")){
              echo "bien";
            }
            else{
              echo "mal";
            }
          }
        }  
        else if($op=="ListarCuotas"){
          ?>
            <tr style="position:sticky;top:0;">
              <th>FECHA</th>
              <th>TIPO</th>
              <th>CUOTA</th>
            </tr>         
          <?php
          $rs=mysqli_query(Db::conectar(),"SELECT * from historialCuota where trabajador='".$_POST["dni"]."' order by fecha DESC");
          $rand="";
          $meses=["","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
          while($x=mysqli_fetch_array($rs)){
            $Mes= (int) substr($x["fecha"],5,2);
            if(substr($x["fecha"],5,2)==date("m")){
              $rand="style='background:rgb(140 255 68);'";
            }
            else{
              $rand="";
            }
              echo "
              <tr>
                <td ".$rand." >".$meses[$Mes]."/".substr($x["fecha"],0,4)."</td>
                <td ".$rand." >".$x["tipo"]."</td>
                <td ".$rand." >".$x["cantidad"]."</td>
              </tr>";
          }
        }
        else if($op=="SubirDatos"){
            $sql = "INSERT IGNORE INTO trabajador VALUES ('".$_POST["dni"]
            ."','" . strtoupper($_POST["nombre"]).
            "', '" . strtoupper($_POST["apellido"]). 
            "', '" . strtoupper($_POST["telf"]) .
            "', '" . strtoupper($_POST["estado_civil"]). 
            "', '" . strtoupper($_POST["email"]) .
            "', '" . strtoupper($_POST["direccion"]). 
            "', '" . strtoupper($_POST["banco"]). 
            "', '" . strtoupper($_POST["fecha_naci"]) .
            "', '" . strtoupper($_POST["numero_cuenta"]) .
            "', '" . ($_POST["cci_cuenta"]) .
            "', '" . strtoupper($_POST["afp_onp"]). 
            "', '" . strtoupper($_POST["cuota_ojt"]) .
            "', '" . strtoupper($_POST["fecha_c"]) .
            "', '" . strtoupper($_POST["reclutadora"]) .
            "', '" . strtoupper($_POST["capacitador"]) .
            "', '" . strtoupper($_POST["campaña"]). 
            "', '" . strtoupper($_POST["jefe"]). 
            "', '" . strtoupper($_POST["empresa"]). 
            "', '" . strtoupper($_POST["estado"]). 
            "', '" . //strtoupper($_POST["tipoContrato"]). 
            "', '" . strtoupper($_POST["cuota_ojt"]).
            "', '" . strtoupper($_POST["turno"]). 
            "', '" . strtoupper($_POST["fecha_in"]) .
            "', '" . strtoupper($_POST["fecha_ojt"]) .
            "', '" . strtoupper($_POST["fecha_capa"]) .
            "', '" . strtoupper($_POST["CUSPP"]) .
            "', '" . strtoupper($_POST["Sueldo"]) .
            "', '" . strtoupper($_POST["hora_ingre"]) .":00".
            "', '" . strtoupper($_POST["fecha_cese_op"]) .
            "', '" . strtoupper($_POST["fecha_cese_pla"]) .
            "', '" . strtoupper($_POST["fecha_VD"]) .
            "', '" . strtoupper($_POST["fecha_VH"]) .
            "', '" . strtoupper($_POST["fecha_DESD"]) .
            "', '" . strtoupper($_POST["fecha_DESH"]) .
            "', '" . strtoupper($_POST["motivo_cese"]) .
            "', '" . strtoupper($_POST["idcargo"]) .
            "', '" . strtoupper($_POST["idsede"]) .
            "', '" . strtoupper($_POST["idarea"]) .
            "');";
            echo mysqli_query($conexion,$sql);
            echo $sql;
        }
        else if($op=="editarDatos"){
          $sql = "update trabajador set nombre='" . strtoupper($_POST["nombre"]).
          "', apellido='" .strtoupper($_POST["apellido"]). 
          "', id='" .$_POST["dni"]. 
          "', telefono='" .strtoupper($_POST["telf"]) .
          "', estado_civil='" .strtoupper($_POST["estado_civil"]). 
          "', email='" .strtoupper($_POST["email"]) .
          "', direccion='" .strtoupper($_POST["direccion"]). 
          "', banco='" .strtoupper($_POST["banco"]). 
          "', fecha_naci='" .strtoupper($_POST["fecha_naci"]) .
          "', numero_cuenta='" .strtoupper($_POST["numero_cuenta"]) .
          "', cci_cuenta='" .($_POST["cci_cuenta"]) .
          "', afp_onp='" .strtoupper($_POST["afp_onp"]). 
          "', cuota_ojt='" .strtoupper($_POST["cuota_ojt"]) .
          "', fecha_c='" .strtoupper($_POST["fecha_c"]) .
          "', reclutadora='" .strtoupper($_POST["reclutadora"]) .
          "', capacitador='" .strtoupper($_POST["capacitador"]) .
          "', campaña='" .strtoupper($_POST["campaña"]). 
          "', jefe='" .strtoupper($_POST["jefe"]). 
          "', empresa='" .strtoupper($_POST["empresa"]). 
          "', estado='" .strtoupper($_POST["estado"]). 
          "', modalidad='" .strtoupper($_POST["modalidad"]). 
          "', tipoContrato='" .strtoupper($_POST["cuota_ojt"]).
          "', turno='" .strtoupper($_POST["turno"]). 
          "', fecha_in='" .strtoupper($_POST["fecha_in"]) .
          "', fecha_ojt='" .strtoupper($_POST["fecha_ojt"]) .
          "', fecha_capa='" .strtoupper($_POST["fecha_capa"]) .
          "', CUSPP='" .strtoupper($_POST["CUSPP"]) .
          "', Sueldo='" .strtoupper($_POST["Sueldo"]) .
          "', hora_ingre='" .strtoupper($_POST["hora_ingre"]) .":00".
          "', fecha_cese_op='" .strtoupper($_POST["fecha_cese_op"]) .
          "', fecha_cese_pla='" .strtoupper($_POST["fecha_cese_pla"]) .
          "', fecha_VD='" .strtoupper($_POST["fecha_VD"]) .
          "', fecha_VH='" .strtoupper($_POST["fecha_VH"]) .
          "', fecha_DESD='" .strtoupper($_POST["fecha_DESD"]) .
          "', fecha_DESH='" .strtoupper($_POST["fecha_DESH"]) .
          "', motivo_cese='" .strtoupper($_POST["motivo_cese"]) .
          "', idcargo='".strtoupper($_POST["idcargo"]) . 
          "', idsede='" .strtoupper($_POST["idsede"]) .
          "', idarea='" .strtoupper($_POST["idarea"]) .
          "' where id='" . $_POST["id"]."'";
          echo mysqli_query($conexion,$sql);
        }
        // if($op=="subirarchivo"){
        //   try {
        //     $_FILES=$_POST["archivo"];
        //     $_POST["archivo"]["tmp_name"]
        //     move_uploaded_file($_FILES["archivo"]["tmp_name"])
        //   } catch (Exception $e) {
        //     echo "No se pudo subir, pipipi";
        //   }
        //   $con=mysqli_query($conexion, "SELECT * from area ORDER BY idarea DESC");
        //   while($x=mysqli_fetch_array($con)){
        //     echo '<option  value="'.$x["idarea"].'">'.$x["area"].'</option>';
        //     }
        // }
    }
?>