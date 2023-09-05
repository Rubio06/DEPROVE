<?php
  require_once("../coneccion.php");
  $conexion=Db::conectar();
  $nombre="";
  $apellido="";
  $dni="";
  $telefono="";
  $estado_civil="";
  $email="";
  $direccion="";
  $banco="";
  $fecha_naci="";
  $numero_cuenta="";
  $cci_cuenta="";
  $afp_onp="";
  // $cuota="";
  $cuota_ojt="";
  $fecha_c="";
  $reclutadora="";
  $capacitador="";
  $campaña="";
  $jefe="";
  $empresa="";
  $estado="";
  $modalidad="";
  $turno="";
  $fecha_in="";
  $fecha_ojt="";
  $fecha_capa="";
  $CUSPP="";
  $Sueldo="";
  $hora_ingre="";
  $fecha_cese_op="";
  $fecha_cese_pla="";
  $fecha_VD="";
  $fecha_VH="";
  $fecha_DESD="";
  $fecha_DESH="";
  $motivo_cese="";
  $sede="";
  $area="";
  $cargo="";
  $desact=0;
  if(isset($_POST["id_tra"])){
    echo "<script>console.log('".$_POST['id_tra']."')</script>";
    $sql = "SELECT
      nombre,
      apellido,
      id,
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
      motivo_cese ,
      sede,
      area,
      cargo
    FROM trabajador
    INNER JOIN sede ON trabajador.idsede = sede.idsede
    INNER JOIN area ON trabajador.idarea = area.idarea
    INNER JOIN cargo ON trabajador.idcargo = cargo.idcargo
    WHERE trabajador.id=".$_POST['id_tra']."
    ;
    ";
    $rlistar=mysqli_fetch_array(mysqli_query($conexion,$sql));
    if($rlistar!=null){
      $id=$_POST["id_tra"];
      echo "<script>idaeditar='$id';</script>";
      $nombre=$rlistar["nombre"];
      $apellido=$rlistar["apellido"];
      $dni=$rlistar["id"];
      $telefono=$rlistar["telefono"];
      $estado_civil=$rlistar["estado_civil"];
      $email=$rlistar["email"];
      $direccion=$rlistar["direccion"];
      $banco=$rlistar["banco"];
      $fecha_naci=$rlistar["fecha_naci"];
      $numero_cuenta=$rlistar["numero_cuenta"];
      $cci_cuenta=$rlistar["cci_cuenta"];
      $afp_onp=$rlistar["afp_onp"];
      // $cuota=$rlistar["cuota"];
      $cuota_ojt=$rlistar["cuota_ojt"];
      $fecha_c=$rlistar["fecha_c"];
      $reclutadora=$rlistar["reclutadora"];
      $capacitador=$rlistar["capacitador"];
      $campaña=$rlistar["campaña"];
      $jefe=$rlistar["jefe"];
      $empresa=$rlistar["empresa"];
      $estado=$rlistar["estado"];
      $modalidad=$rlistar["modalidad"];
      $turno=$rlistar["turno"];
      $fecha_in=$rlistar["fecha_in"];
      $fecha_ojt=$rlistar["fecha_ojt"];
      $fecha_capa=$rlistar["fecha_capa"];
      $CUSPP=$rlistar["CUSPP"];
      $Sueldo=$rlistar["Sueldo"];
      $hora_ingre=$rlistar["hora_ingre"];
      $fecha_cese_op=$rlistar["fecha_cese_op"];
      $fecha_cese_pla=$rlistar["fecha_cese_pla"];
      $fecha_VD=$rlistar["fecha_VD"];
      $fecha_VH=$rlistar["fecha_VH"];
      $fecha_DESD=$rlistar["fecha_DESD"];
      $fecha_DESH=$rlistar["fecha_DESH"];
      $motivo_cese=$rlistar["motivo_cese"];
      $sede=$rlistar["sede"];
      $area=$rlistar["area"];
      $cargo=$rlistar["cargo"];
    }
    if($nombre=="" &&$apellido=="" &&$dni=="" &&$telefono=="" &&$estado_civil=="" &&$email=="" &&$direccion=="" &&$banco=="" &&$fecha_naci=="" &&$numero_cuenta=="" &&$cci_cuenta=="" &&$afp_onp=="" &&$cuota=="" &&$cuota_ojt=="" &&$fecha_c=="" &&$reclutadora=="" &&$capacitador=="" &&$campaña=="" &&$jefe=="" &&$empresa=="" &&$estado=="" &&$modalidad=="" &&$turno=="" &&$fecha_in=="" &&$fecha_ojt=="" &&$fecha_capa=="" &&$CUSPP=="" &&$Sueldo=="" &&$fecha_cese_op=="" &&$fecha_VD=="" &&$fecha_VH=="" &&$fecha_DESD=="" &&$fecha_DESH=="" &&$motivo_cese=="" &&$sede=="" &&$area=="" &&$cargo==""){$desact=0;}
    else{$desact=1;}
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Insersion Personal</title>
    <link rel="stylesheet" href="./css/normalize.css" />
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./css/trabajador.css" />
    <link rel="stylesheet" href="./css/grid.css" />
    <style>
      .botonModal{
        border-radius:5px;
        border:1px solid #00008B;
        cursor:pointer;
        background-color:rgb(18 255 255);
        padding: 0 5px;
        font-size: 20px;
      }
    </style>
  </head>
  <body>
      <?php include("../header.php") ?>
    <main class="main-trabajador">
      <?php if($desact==0){
        $Titulo="Nuevo trabajador";
        $Boton="Grabar";
        ?>
      <?php }else{
        $Titulo="Editar a ".$nombre." ".$apellido;
        $Boton="Editar";
      } ?>
      <h2 class="title"><?php echo $Titulo ?></h2>
      <button class="btn-grabar" onclick="<?php echo $Boton ?>()"><?php echo $Boton ?></button>
      <form action="#" class="form grid">
        <fieldset class="form__container grid__item-1">
          <div class="form__field">
            <label class="form__label" for="nombre">nombre:</label>
            <input class="form__input" type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>">
          </div>
          <div class="form__columns-2">
            <div class="form__field">
              <label class="form__label" for="apellido">apellido:</label>
              <input
                value="<?php echo $apellido; ?>"
                class="form__input"
                type="text"
                name="apellido"
                id="apellido"
              />
            </div>
            <div class="form__field">
              <label class="form__label" style="margin-left:10px"for="cargo">cargo:</label>
              <select
                class="form__input form__input--bg"
                style="margin-left:-45px"
                name="cargo"
                id="cargo">

              <?php
              $con=mysqli_query($conexion, "SELECT * from cargo ORDER BY cargo ASC");
              $ante="";
              while($x=mysqli_fetch_array($con)){
                $s="";if($x["cargo"]==$cargo){$s="selected";}
                if($ante!=strtoupper(substr($x["cargo"],0,1))){
                  $ante=strtoupper(substr($x["cargo"],0,1));
                  echo '<option disabled>'.$ante.'</option>';
                }
                echo '<option value="'.$x["idcargo"].'" '.$s.'>'.$x["cargo"].'</option>';
              }
              ?>
              </select>
              <input type="button" id="Rcargo" class="botonModal" value="+">
            </div>
          </div>
          <div class="form__columns-2">
            <div class="form__field">
              <label class="form__label" 
                >dni / doc / código:</label
              >
              <input
                value="<?php echo $dni; ?>"
                class="form__input"
                type="text"
                name="dniDoc"
                id="dniDoc"
                requerid
              />
            </div>
            <div class="form__field">
              <label class="form__label" style="margin-left:10px" for="telefono">teléfono:</label>
              <input
                class="form__input"
                type="text"
                onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                name="telefono"
                id="telefono"
                requerid
                maxlength="10"
                style="width:80%"
                value="<?php echo $telefono; ?>"
              />
            </div>
          </div>
          <div class="form__columns-2">
            <div class="form__field">
              <label class="form__label" for="estadoCivil">estado civil:</label>
              <select
                class="form__input form__input--bg"
                name="estadoCivil"
                id="estadoCivil"
              >
                <option <?php $s="";if($estado_civil=="SOLTERO/A"){$s="selected";} echo $s; ?> value="soltero/a">soltero/a</option>
                <option <?php $s="";if($estado_civil=="CASADO/A"){$s="selected";} echo $s; ?> value="casado/a">casado/a</option>
                <option <?php $s="";if($estado_civil=="VIUDO/A"){$s="selected";} echo $s; ?> value="viudo/a">viudo/a</option>
              </select>
            </div>
            <div class="form__field">
              <label class="form__label" for="afpOnp">AFP / ONP:</label>
              <select
                class="form__input form__input--bg"
                name="afpOnp"
                id="afpOnp"
              >
                <option <?php $s="";if($afp_onp=="AFP"){$s="selected";}  echo $s;?> value="AFP">AFP</option>
                <option <?php $s="";if($afp_onp=="PRIMA"){$s="selected";}  echo $s;?> value="PRIMA">PRIMA</option>
                <option <?php $s="";if($afp_onp=="INTEGRA"){$s="selected";}  echo $s;?> value="INTEGRA">INTEGRA</option>
                <option <?php $s="";if($afp_onp=="PROFUTURO"){$s="selected";}  echo $s;?> value="PROFUTURO">PROFUTURO</option>
                <option <?php $s="";if($afp_onp=="PROFUTURO"){$s="selected";}  echo $s;?> value="ONP">ONP</option>
              </select>
            </div>
          </div>
          <div class="form__field">
            <label class="form__label" for="email">email:</label>
            <input class="form__input" type="email" name="email" id="email" value="<?php echo $email; ?>">
          </div>
          <div class="form__columns-2">
            <div class="form__field">
              <label class="form__label" for="sede">sede:</label>
              <select class="form__input form__input--bg" name="sede" id="sede">
                <?php
                $ante="";
                $con=mysqli_query($conexion, "SELECT * from sede ORDER BY sede Asc");
                while($x=mysqli_fetch_array($con)){
                  $s="";
                  if($x["sede"]==$sede){$s="selected";}
                  if($ante!=strtoupper(substr($x["sede"],0,1))){
                    $ante=strtoupper(substr($x["sede"],0,1));
                    echo '<option disabled>'.$ante.'</option>';
                  }
                  echo '<option '.$s.' value="'.$x["idsede"].'">'.$x["sede"].'</option>';
                }
                ?>
              </select>
              <input type="button"  id="Rsede" class="botonModal" value="+">
            </div>
            <div class="form__field">
              <label class="form__label" for="area">área:</label>
              <select class="form__input form__input--bg" name="area" id="area">
                <?php
                $ante="";
                $con=mysqli_query($conexion, "SELECT * from area ORDER BY area Asc");
                while($x=mysqli_fetch_array($con)){
                  $s="";
                  if($ante!=strtoupper(substr($x["area"],0,1))){
                    $ante=strtoupper(substr($x["area"],0,1));
                    echo '<option disabled>'.$ante.'</option>';
                  }
                  if($x["area"]==$area){$s="selected";}
                  echo '<option '.$s.' value="'.$x["idarea"].'">'.$x["area"].'</option>';
                }
                ?>

              </select><input type="button"  id="Rarea" class="botonModal" value="+">
            </div>
          </div>
          <div class="form__field">
            <label class="form__label" for="direccion">dirección:</label>
            <input
              class="form__input"
              type="text"
              name="direccion"
              id="direccion"
              value="<?php echo $direccion; ?>"
            />
          </div>
          <div class="form__columns-2">
            <div class="form__field">
              <label class="form__label" for="banco">Banco:</label>
              <select class="form__input form__input--bg" name="banco" id="banco" value="<?php echo $banco; ?>">
             
              <?php
                $ante="";
                $con=mysqli_query($conexion, "SELECT * from banco ORDER BY banco Asc");
                while($x=mysqli_fetch_array($con)){
                  $s="";
                  if($ante!=strtoupper(substr($x["banco"],0,1))){
                    $ante=strtoupper(substr($x["banco"],0,1));
                    echo '<option disabled>'.$ante.'</option>';
                  }
                  if($x["id"]==$banco){$s="selected";}
                  echo '<option '.$s.' value="'.$x["id"].'">'.$x["banco"].'</option>';
                }
                ?>
              </select><input type="button" id="Rban" class="botonModal" value="+">
            </div>
            <div class="form__field">
              <label class="form__label" for="fechaNacimiento" style="margin-left:18px;"
                >fecha de nacimiento:</label
              >
              <input
                class="form__input"
                type="date"
                name="fechaNacimiento"
                id="fechaNacimiento"
                value="<?php echo $fecha_naci; ?>"
              />
            </div>
          </div>
          <div class="form__field">
            <label class="form__label" for="nroCuenta">nro. cuenta:</label>
            <input
              class="form__input"
              type="text"
              name="nroCuenta"
              id="nroCuenta"
              value="<?php echo $numero_cuenta; ?>"
            />
          </div>
          <div class="form__field">
            <label class="form__label" for="nroCCI">nro. CCI:</label>
            <input class="form__input" type="text" name="nroCCI" id="nroCCI" value="<?php echo $cci_cuenta; ?>">
          </div>
          <table class="table">
            <tr class="table__row">
              <td class="table__data">DNI</td>
              <td class="table-button">
                <button class="table-button__item">subir</button>
                <button class="table-button__item">descargar</button>
              </td>
            </tr>
            <tr class="table__row">
              <td class="table__data">Curriculum (CV)</td>
              <td class="table-button">
                <button class="table-button__item">subir</button>
                <button class="table-button__item">descargar</button>
              </td>
            </tr>
            <tr class="table__row">
              <td class="table__data">Certificado de Trabajo</td>
              <td class="table-button">
                <button class="table-button__item">subir</button>
                <button class="table-button__item">descargar</button>
              </td>
            </tr>
            <tr class="table__row">
              <td class="table__data">Certificado de Estudio</td>
              <td class="table-button">
                <button class="table-button__item">subir</button>
                <button class="table-button__item">descargar</button>
              </td>
            </tr>
            <tr class="table__row">
              <td class="table__data">Antecedentes Policiales</td>
              <td class="table-button">
                <button class="table-button__item">subir</button>
                <button class="table-button__item">descargar</button>
              </td>
            </tr>
            <tr class="table__row">
              <td class="table__data">Brevete</td>
              <td class="table-button">
                <button class="table-button__item">subir</button>
                <button class="table-button__item">descargar</button>
              </td>
            </tr>
            <tr class="table__row">
              <td class="table__data">Recibo de Servicios</td>
              <td class="table-button">
                <button class="table-button__item">subir</button>
                <button class="table-button__item">descargar</button>
              </td>
            </tr>
            <tr class="table__row">
              <td class="table__data">SOAT</td>
              <td class="table-button">
                <button class="table-button__item">subir</button>
                <button class="table-button__item">descargar</button>
              </td>
            </tr>
          </table>
        </fieldset>



        <!-- SEGUNDO GRID -->

        <div class="grid__item-2" style="display:flex;flex-direction: column; ">
        <!-- contenido de 2 cajas de CUOTA Y PLANILLA  -->
        <div style="width: 100%;display:flex;justify-content: space-between;margin-bottom:20px">
          <div style="width:450px; padding:5px 15px;border: 1px solid black; border-radius: 10px;">
  
            <div class="form__field">
              <label class="form__label" for="nroCuenta">FECHA:</label>
              <input
                class="form__input"
                type="month"
                name="fecha_cuota"
                id="fecha_cuota"
                value="<?php echo date("Y-m"); ?>"
                oninput="bajarCuota();"
              />
            </div> 
          <div class="form__field">
            <label class="form__label form__label--large" for="cuota">CUOTA:</label>
            <?php  
              $con=mysqli_fetch_array(mysqli_query($conexion, "SELECT * from cuotaModalidad where fecha='".date("Y-m")."-01' and modalidad like'%".$modalidad."%'"));  
              if($con!=null){
                $cuota=$con["cantidad"];
              }
            ?>
            <input class="form__input form__input--checkbox" type="text"name="cuota"id="cuota"value="<?php echo $cuota; ?>"disabled/> 
            <input type="button" id="cuotaModificar"value="Personalizar"/>
          </div>

          <!-- CUOTA PERSONALIZADA -->
          <!-- <div class="form__field">
          <div style="display:flex;justify-content:space-around;justify-items: center;">  
          <div style="display:flex">
          <label class="form__label form__label--large" for="cuota"
              >CUOTA PERSONALIZADA:</label
            ><input type="radio" name="cuota" id="cuota-per"/>
              </div>
              
             <div><input type="button" id="Bcuota-pe" class="botonModal" value="+"/></div>
              </div>
            <input
              class="form__input form__input--checkbox"
              type="text"
              name="cuotap"
              id="cuotap"
            />
          </div> -->
          <div><input type ="button" id="btnCuota" value="GRABAR CUOTA"></div>
          <div style="overflow: auto;margin-top:15px;max-height: 140px;">
            <table class="table-traba">
              <tbody id="listaCuotas">
                <tr style="position:sticky;top:0;">
                  <th>FECHA</th>
                  <th>TIPO</th>
                  <th>CUOTA</th>
                </tr>
              </tbody>
            </table>
          </div>
              </div>

<!--
              registro de fehca de planilla  -->

              <div style="width:450px; padding:5px 15px;border: 1px solid black; border-radius: 10px;">
          <div class="form__field">
            <label class="form__label form__label--large" for="planillap" name="planillap"
              >PLANILLA PERSONALIZADA:</label
            >
            <input
              type="checkbox"
              name="planilla"
              id="planillap"
              onclick="ActivarPla()"
            />
          </div>


          <div class="form__field">
            <label class="form__label" for="nroCuenta">FECHA:</label>
            <input
              class="form__input"
              type="month"
              name="nroCuenta"
              id="fecha_tradanza"
            />
          </div>
          <div class="conte-tabla" id="tabla">
          <table class="table-traba">
            <thead>
              <tr>
                <th rowspan="2">MES</th>
                <th rowspan="2">AÑO</th>
                <th colspan="2">¿DESEA DESCONTAR?</th>
              </tr>
              <tr>
                <th>FALTA</th>
                <th>TARDANZA</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>ENERO</td>
                <td>2022</td>
                <td><input  type="checkbox"/></td>
                <td><input type="checkbox"/></td>
              </tr>
              <tr>
                <td>ENERO</td>
                <td>2022</td>
                <td><input type="checkbox"/></td>
                <td><input type="checkbox"/></td>
              </tr>
              <tr>
                <td>ENERO</td>
                <td>2022</td>
                <td><input type="checkbox"/></td>
                <td><input type="checkbox"/></td>
              </tr>
            </tbody>
          </table>

              </div>
          </div>

          </div>


          <!-- TABLA COMISIÓNES -->

        <div style="width: 100%; padding:5px; border:1px solid black;border-radius:10px;">
    <table class="table-traba">
        <thead>
          <tr>
            <th rowspan="2">AFP</th>
            <th rowspan="2">COMISIÓN FIJA<sup>2/</sup></th>
            <th rowspan="2">COMISIÓN SOBRE FLUJO<br><span>( % Remuneración bruta Mensual)</span></th>
            <th colspan="2">COMISIÓN MIXTA<sup>5/</sup> </th>
            <th rowspan="2">PRIMA DE SEGUROS(%)<sup>4/</sup><br><span>( % Remuneración bruta Mensual)</span> </th>
            <th rowspan="2">PORTE OBLIGATORIO AL FONDO DE PENSIONES<br><span>( % Remuneración bruta Mensual)</span></th>
          <th rowspan="2">REMUNERACIÓN MAXIMA ASEGURABLE</th>

          </tr>
          <tr>
            <th >COMISIÓN SOBRE FLUJO<br><span>( % Remuneración bruta Mensual)</span></th>
            <th >COMUNISIÓN ANUAL SOBRE SALDO<sup>3/</sup></th>

          </tr>

        </thead>

        <tbody>
          <tr>
          <td>APF</td>
          <td></td>
          <td>1.47%</td>
          <td>0.23%</td>
          <td>1.25%</td>
          <td>1.74%</td>
          <td>10.00%</td>
          <td>11,002.84</td>


          </tr>
          <tr>
            <td></td>
            <td></td>
            <td><input type="radio" id="" name="tabla-radio" class="tabla-radio"/></td>
            <td><input type="radio"  id="" name="tabla-radio"class="tabla-radio"/></td>
            <td><input type="radio" id="" name="tabla-radio" class="tabla-radio"/></td>
            <td></td>
            <td></td>
            <td></td>


            </tr>

        </tbody>
      </table>



    </div>
        </div>
        <fieldset class="form__container grid__item-3" style="width:750px;">
          <div class="form__field">
            <label class="form__label" for="reclutadora">reclutadora:</label>
            <select name="reclutadora" id="reclutadora" class="form__input">
              <option value=""></option>
              <?php
                $ante="";
                $con=mysqli_query($conexion, "SELECT concat(nombre, ' ' ,apellido) as nombre,id from trabajador where idcargo = (select idcargo from cargo where cargo='RECLUTADOR')");
                while($x=mysqli_fetch_array($con)){
                  $s="";
                  if($ante!=strtoupper(substr($x["nombre"],0,1))){
                    $ante=strtoupper(substr($x["nombre"],0,1));
                    echo '<option disabled>'.$ante.'</option>';
                  }
                  if($x["nombre"]==$reclutadora){$s="selected";}
                  echo '<option '.$s.' value="'.$x["nombre"].'">'.$x["nombre"].'</option>';
                }
                ?>
            </select>
          </div>
          <div class="form__field">
            <label class="form__label" for="capacitador">capacitador:</label>
            <select name="capacitador" id="capacitador" class="form__input">
              <option value=""></option>
              <?php
                $ante="";
                $con=mysqli_query($conexion, "SELECT concat(nombre, ' ' ,apellido) as nombre,id from trabajador where idcargo = (select idcargo from cargo where cargo='CAPACITADOR')");
                while($x=mysqli_fetch_array($con)){
                  $s="";
                  if($ante!=strtoupper(substr($x["nombre"],0,1))){
                    $ante=strtoupper(substr($x["nombre"],0,1));
                    echo '<option disabled>'.$ante.'</option>';
                  }
                  if($x["nombre"]==$capacitador){$s="selected";}
                  echo '<option '.$s.' value="'.$x["nombre"].'">'.$x["nombre"].'</option>';
                }
                ?>
            </select>
          </div>
          <div class="form__field">
            <label class="form__label" for="tipo">Modalidad:</label>
            <select onchange="bajarCuota();" class="form__input form__input--bg" name="tipo" onchange="" id="modalidad">
              <option <?php if($modalidad=="PART-TIME"||$modalidad=="PART TIME"){echo "selected";} ?> value="Part time">Part-time</option>
              <option <?php if($modalidad=="MINI-FULL"||$modalidad=="MINI FULL"){echo "selected";} ?> value="Mini full">Mini-full</option>
              <option <?php if($modalidad=="FULL-TIME"||$modalidad=="FULL TIME"){echo "selected";} ?> value="Full time">Full-time</option>
              <option <?php if($modalidad=="LIBRE"){echo "selected";} ?> value="Libre">Libre</option>
            </select>
          </div>
          <div class="form__field">
            <label class="form__label" for="turno">turno:</label>
            <select class="form__input form__input--bg" name="turno" id="turno">
              <option <?php if($turno=="MAÑANA"){echo "selected";} ?> value="MAÑANA">MAÑANA</option>
              <option <?php if($turno=="TARDE"){echo "selected";} ?> value="TARDE">TARDE</option>
              <option <?php if($turno=="COMPLETO"){echo "selected";} ?> value="COMPLETO">COMPLETO</option>
            </select>
          </div>
          <div class="flex" style="height:fit-content;">
            <div style="width:48%;">
              <div class="form__field">
                <label class="form__label" for="campaña">Medio de reclutamiento:</label>
                <select name="campaña" id="campaña" class="form__input">
                </select>
                <input type="button" id="Rreclu" class="botonModal" value="+">
              </div>
              <div class="form__field">
                <label class="form__label" for="coordinador">1er coord:</label>
                <select name="coordinador" id="coordinador" class="form__input" style="width:100%;">
                  <option value=""></option>
                <?php
                    $ante="";
                    $con=mysqli_query($conexion, "SELECT concat(nombre, ' ' ,apellido) as nombre,id from trabajador where idcargo = (select idcargo from cargo where cargo='COORDINADOR')");
                    while($x=mysqli_fetch_array($con)){
                      $s="";
                      if($ante!=strtoupper(substr($x["nombre"],0,1))){
                        $ante=strtoupper(substr($x["nombre"],0,1));
                        echo '<option disabled>'.$ante.'</option>';
                      }
                      if($x["nombre"]==$jefe){$s="selected";}
                      echo '<option '.$s.' value="'.$x["nombre"].'">'.$x["nombre"].'</option>';
                    }
                    ?>
                </select>
              </div>
            </div>
  
            <div style="width:48%;">
              <div class="form__field">
                <label class="form__label">Cuota OJT:</label>
                <input
                  class="form__input"
                  type="number"
                  name="cuotap"
                  id="cuotap"
                  value="<?php echo $cuota_ojt; ?>"
                />
              </div>
              <div class="form__field">
                <label class="form__label"
                  >fecha limite OJT:</label
                >
                <input
                  class="form__input"
                  type="date"
                  name="fechaLimiteOJT"
                  id="fechaLimiteOJT"
                  value="<?php echo $fecha_c; ?>"
                />
              </div>
          </div>
          </div>

          <div class="form__field">
            <label class="form__label" for="fechaInicioCapacitacion">fecha inicio capacitacion:</label>
            <input 
              class="form__input"
              type="date"
              name="fechaInicioCapacitacion"
              id="fechaInicioCapacitacion"
              value="<?php echo $fecha_capa; ?>"
            />
          </div>
          <div class="form__field">
            <label class="form__label" for="fechaInicioOJT"
              >fecha inicio OJT:</label
            >
            <input
              class="form__input"
              type="date"
              name="fechaInicioOJT"
              id="fechaInicioOJT"
              value="<?php echo $fecha_ojt; ?>"
            />
          </div>

        </fieldset>


        <fieldset class="form__container grid__item-4" style="width:750px;">
          <div class="form__field">
            <label class="form__label" for="empresa">empresa:</label>
            <select
              class="form__input form__input--bg"
              name="empresa"
              id="empresa"
            >
              <option <?php if($empresa=="EXTERNO"){echo "selected";} ?> value="Externo">Externo</option>
              <option <?php if($empresa=="KOMUNICATE"){echo "selected";} ?> value="KOMUNICATE">Komunicate</option>
              <option <?php if($empresa=="DEPROVE"){echo "selected";} ?> value="Deprove">Deprove</option>
            </select>
          </div>
          <div class="form__field">
            <label class="form__label" for="estado">estado:</label>
            <select
              class="form__input form__input--bg"
              name="estado"
              id="estado"
            >
              <option <?php if($estado=="ACTIVO"){echo "selected";} ?> value="Activo">Activo</option>
              <option <?php if($estado=="CESADO"){echo "selected";} ?> value="Cesado">Cesado</option>
              <option <?php if($estado=="DESCANSO MEDICO"){echo "selected";} ?> value="Descanso medico">Descanso medico</option>
              <option <?php if($estado=="VACACIONES"){echo "selected";} ?> value="Vacaciones">Vacaccions</option>

            </select>
          </div>
          <div class="form__field">
            <label class="form__label" for="fechaInicioPlanilla"
              >fecha inicio planilla:</label
            >
            <input
              class="form__input"
              type="date"
              name="fechaInicioPlanilla"
              id="fechaInicioPlanilla"
              value="<?php echo $fecha_in; ?>"
            />
          </div>
          <div class="form__columns-2" style="display:flex;flex-direction:column;">
            <div class="form__field" >

            <label class="form__label form__label--small" for="CUSPP"
                >CUSPP:</label
              >
              <input class="form__input" type="text" value="<?php echo $CUSPP; ?>" name="CUSPP" id="CUSPP" />
            </div>
            <div class="form__field">
              <label class="form__label form__label--small" for="sueldo"
                >Sueldo:</label
              >
              <input
                class="form__input"
                type="text"
                name="sueldo"
                id="sueldo"
                value="<?php echo $Sueldo; ?>"
              />
              <label class="form__label form__label--small" for="sueldo"
                >Hora de ingreso:</label
              >
              <input
                class="form__input"
                type="time"
                name="hora_ingre"
                id="hora_ingre"
                value="<?php echo $hora_ingre; ?>"
              />
            </div>


          </div>
        </fieldset>
        <fieldset class="form__container grid__item-5" style="width:750px;">
          <div class="form__columns-2 margin-bottom">

            <div class="form__field">
              <label class="form__label" for="fechaCese">fecha cese operación:</label>
              <input
                class="form__input"
                type="date"
                name="fechaCese"
                id="fechaCese"
                value="<?php echo $fecha_cese_op; ?>"
              />
            </div>
            <div class="form__field">
                <label class="form__label" for="fechaCese">fecha cese planilla:</label>
                <input
                  class="form__input"
                  type="date"
                  name="fechaCesePla"
                  id="fechaCesePla"
                  value="<?php echo $fecha_cese_pla; ?>"
                />
              </div>
          </div>
          </div>
          <div class="form__columns-3 margin-bottom">
            <div class="form__field">

              <label class="form__label" for="vacaciones">vacaciones:</label>
            </div>
            <div class="form__field">
              <label
                class="form__label form__label--small"
                for="fechaInicioVacaciones"
                >Desde:</label
              >
              <input
                class="form__input"
                type="date"
                name="fechaInicioVacaciones"
                id="fechaInicioVacaciones"
                value="<?php echo $fecha_VD; ?>"
              />
            </div>
            <div class="form__field">
              <label
                class="form__label form__label--small"
                for="fechaFinVacaciones"
                >Hasta:</label
              >
              <input
                class="form__input"
                type="date"
                name="fechaFinVacaciones"
                id="fechaFinVacaciones"
                value="<?php echo $fecha_VH; ?>"
              />
            </div>
          </div>
          <div class="form__columns-3">
            <div class="form__field">

              <label class="form__label" for="descMedico"
                >descanso médico:</label
              >
            </div>
            <div class="form__field">
              <label
                class="form__label form__label--small"
                for="fechaInicioDescMed"
                >desde:</label
                >
              <input
                class="form__input"
                type="date"
                name="fechaInicioDescMed"
                id="fechaInicioDescMed"
                value="<?php echo $fecha_DESD; ?>"
                />
              </div>
            <div class="form__field">
              <label
                class="form__label form__label--small"
                for="fechaFinDescMed"
                >hasta:</label
              >
              <input
                class="form__input"
                type="date"
                name="fechaFinDescMed"
                id="fechaFinDescMed"
                value="<?php echo $fecha_DESH; ?>"
              />
            </div>
          </div>


          <!-- MODIFICAR LA TABLA  -->


           <table class="table">
            <tr class="table__row">
              <td class="table__data">INDICACIONES MEDICAS</td>
              <td class="table-button">
                <button class="table-button__item">subir</button>
                <button class="table-button__item">descargar</button>
              </td>
            </tr>
            <tr class="table__row">
              <td class="table__data">RECIBO POR HONORARIO</td>
              <td class="table-button">
                <button class="table-button__item">subir</button>
                <button class="table-button__item">descargar</button>
              </td>
            </tr>
            <tr class="table__row">
              <td class="table__data">CERTIFICADO MEDICO</td>
              <td class="table-button">
                <button class="table-button__item">subir</button>
                <button class="table-button__item">descargar</button>
              </td>
            </tr>

          </table>
 

        </fieldset>
        <fieldset class="form__container grid__item-6" style="width:750px;">
          <div  style="display:flex;flex-direction:column;">



          <div>
          <select style="margin-bottom:15px;"name="" id="">
              <option value=""></option>
              <option value="RENUNCIA">RENUNCIA</option>
              <option value="DESPIDO O DISTITUCIÓN">DESPIDO O DISTITUCIÓN</option>
              <option value="TERMINACIÓN DE LA OBRA O SERVICIO O VENCIMIENTO DEL PLAZO">TERMINACIÓN DE LA OBRA O SERVICIO O VENCIMIENTO DEL PLAZO</option>
              <option value=""></option>
            </select>

            <div>


            <div style="display:flex;align-items:center;">
          <label for="nota" class="form__label">Descripción del cese:</label>
            <textarea
              name="nota"
              id="nota"
              class="form__input form__input--textarea"
            ></textarea>
              </div>






          </div>
        </fieldset>
      </form>
    </main>


 <!-- MODAL CARGO -->
 <div id="miModal" class="modal">
            <div class="flex" id="flex">
                <div class="contenido-modal">
                    <div class="modal-header flex">
                        <h2>INGRESAR CARGO</h2>
                        <span class="close" id="close">&times;</span>
                    </div>
                    <div class="modal-body">

                    <label >INGRESAR CARGO: </label>
                    <input type="text" id="IngreCargo"/>
                    <br>
                    <br>

                     <input type="button" onclick="botonCargo()"  class="button" value="GUARDAR CARGO">

                    </div>

                </div>
            </div>
        </div>

 <!-- MODAL SEDE -->
 <div id="miModalse" class="modal">
            <div class="flex" id="flexse">
                <div class="contenido-modal">
                    <div class="modal-header flex">
                        <h2>INGRESAR SEDE</h2>
                        <span class="close" id="closese">&times;</span>
                    </div>
                    <div class="modal-body">

                    <label >INGRESAR SEDE: </label>
                    <input type="text" id="IngreSede"/>
                    <br>
                    <br>

                     <input type="button" onclick="botonSede()"  class="button" value="GUARDAR SEDE">

                    </div>

                </div>
            </div>
        </div>

        <!-- MODAL DE BANCO -->
         <!-- MODAL SEDE -->
        <div id="miModalban" class="modal">
            <div class="flex" id="flexban">
                <div class="contenido-modal">
                    <div class="modal-header flex">
                        <h2>BANCO</h2>
                        <span class="close" id="closeban">&times;</span>
                    </div>
                    <div class="modal-body">

                    <label >INGRESAR BANCO: </label>
                    <input type="text" id="IngreBanco"/>
                    <br>
                    <br>
                     <input type="button" onclick="botonBan()"  class="button" value="GUARDAR BANCO">

                    </div>

                </div>
            </div>
        </div>

 <!-- MODAL AREA -->
 <div id="miModalarea" class="modal">
            <div class="flex" id="flexarea">
                <div class="contenido-modal">
                    <div class="modal-header flex">
                        <h2>INGRESAR AREA</h2>
                        <span class="close" id="closearea">&times;</span>
                    </div>
                    <div class="modal-body">

                    <label >INGRESAR AREA: </label>
                    <input type="text" id="IngreArea"/>
                    <br>
                    <br>

                     <input type="button" onclick="botonArea()"  class="button" value="GUARDAR AREA">

                    </div>

                </div>
            </div>
        </div>
<!-- MODAL RECLUTAMIENTO -->
 <div id="miModalreclu" class="modal">
            <div class="flex"  id="flexreclu">
                <div class="contenido-modal">
                    <div class="modal-header flex">
                      <h2>INGRESAR MEDIO DE RECLUTAMIENTO</h2>
                      <span class="close" id="closereclu">&times;</span>
                    </div>
                    <div class="modal-body">
                      <label >INGRESAR MEDIO DE RECLUTAMIENTO: </label>
                      <input type="text" id="IngreReclu"/><br><br>
                      <input type="button" onclick="botonReclu()" class="button" value="GUARDAR MEDIO DE RECLUTACION">
                    </div>

                </div>
            </div>
        </div>
    <script src="RegistroTrabajador.js"></script>
    <script src="Modal.js"></script>

  </body>
    <script src="RegistroTrabajador.js"></script>
    <script src="Modal.js"></script>

    <script>
    <?php if(isset($_POST["id_tra"])){ ?>ListarCuotas();<?php } ?>
      setTimeout(() =>{if(document.getElementById("cuota").value==""){bajarCuota();}},1000)
    </script>
  </body>
</html>